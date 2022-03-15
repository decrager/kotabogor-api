<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Foto;
use App\Models\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FotoController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Foto')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Foto')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Foto';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Foto')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Foto';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $foto = Foto::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data photo Loaded Successfully',
            'photo' => $foto
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $foto = Foto::find($id);
        return response()->json([
            'message' => 'Data photo Loaded Successfully',
            'photo' => $foto
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'album_id' => 'required|max:11',
                'judul' => 'required|max:100',
                'foto' => 'required|mimes:jpeg,jpg,png|max:3072',
                'keterangan' => 'required|max:100'
            ]);

            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/foto', $fileName);

            $foto = new Foto;
            $foto->album_id = $request->album_id;
            $foto->judul = $request->judul;
            $foto->foto = $fileName;
            $foto->keterangan = $request->keterangan;
            $foto->save();

            return response()->json([
                'message' => 'Data photo Added Successfully!',
                'Added photo' => $foto
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'album_id' => 'required|max:11',
                'judul' => 'required|max:100',
                'foto' => 'required|mimes:jpeg,jpg,png|max:3072',
                'keterangan' => 'required|max:100'
            ]);

            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/foto', $fileName);

            $destination = 'images/foto/' . $foto->foto;
            if ($destination) {
                Storage::delete($destination);
            }

            $foto->update([
                'album_id' => $request->album_id,
                'judul' => $request->judul,
                'foto' => $fileName,
                'keterangan' => $request->keterangan
            ]);

            return response()->json([
                'message' => 'Data photo Updated Success',
                'Updated photo' => $foto
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $foto = Foto::find($id);
        $destination = 'images/foto/' . $foto->foto;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Foto::find($id)->delete();
            return response()->json([
                'message' => 'Data photo Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

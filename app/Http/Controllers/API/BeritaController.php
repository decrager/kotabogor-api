<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Berita;
use App\Models\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BeritaController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Berita')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Berita')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Berita';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Berita')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Berita';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $berita = Berita::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data berita Loaded Successfully',
            'berita' => $berita
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $berita = Berita::find($id);
        return response()->json([
            'message' => 'Data berita Loaded Successfully',
            'berita' => $berita
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:100',
                'kategori_id' => 'required|max:11',
                'isi' => 'required',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'tgl' => 'required|date',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/berita', $fileName);

            $berita = new Berita;
            $berita->judul = $request->judul;
            $berita->kategori_id = $request->kategori_id;
            $berita->isi = $request->isi;
            $berita->gambar = $fileName;
            $berita->tgl = $request->tgl;
            $berita->user_id = $request->user_id;
            $berita->save();

            return response()->json([
                'message' => 'Data berita Added Successfully!',
                'Added berita' => $berita
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:100',
                'kategori_id' => 'required|max:11',
                'isi' => 'required',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'tgl' => 'required|date',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/berita', $fileName);

            $destination = 'images/berita/' . $berita->gambar;
            if ($destination) {
                Storage::delete($destination);
            }

            $berita->update([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'isi' => $request->isi,
                'gambar' => $fileName,
                'tgl' => $request->tgl,
                'user_id' => $request->user_id
            ]);

            return response()->json([
                'message' => 'Data berita Updated Success',
                'Updated berita' => $berita
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
        $berita = Berita::find($id);
        $destination = 'images/berita/' . $berita->gambar;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Berita::find($id)->delete();
            return response()->json([
                'message' => 'Data berita Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

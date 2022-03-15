<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DokumenController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Dokumen')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Dokumen')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Dokumen';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Dokumen')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Dokumen';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $dokumen = Dokumen::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data dokumen Loaded Successfully',
            'dokumen' => $dokumen
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $dokumen = Dokumen::find($id);
        return response()->json([
            'message' => 'Data dokumen Loaded Successfully',
            'dokumen' => $dokumen
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama_doc' => 'required|max:50',
                'link' => 'nullable|max:100',
                'file' => 'nullable|mimes:pdf|max:5120',
                'keterangan' => 'required|max:200'
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('files/dokumen', $fileName);

            $dokumen = new Dokumen;
            $dokumen->nama_doc = $request->nama_doc;
            $dokumen->link = $request->link;
            $dokumen->file = $fileName;
            $dokumen->keterangan = $request->keterangan;
            $dokumen->save();

            return response()->json([
                'message' => 'Data dokumen Added Successfully!',
                'Added dokumen' => $dokumen
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama_doc' => 'required|max:50',
                'link' => 'nullable|max:100',
                'file' => 'nullable|mimes:pdf|max:5120',
                'keterangan' => 'required|max:200'
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('files/dokumen', $fileName);

            $destination = 'files/dokumen/' . $dokumen->file;
            if ($destination) {
                Storage::delete($destination);
            }

            $dokumen->update([
                'nama_doc' => $request->nama_doc,
                'link' => $request->link,
                'file' => $fileName,
                'keterangan' => $request->keterangan
            ]);

            return response()->json([
                'message' => 'Data dokumen Updated Success',
                'Updated dokumen' => $dokumen
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
        $dokumen = Dokumen::find($id);
        $destination = 'files/dokumen/' . $dokumen->file;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Dokumen::find($id)->delete();
            return response()->json([
                'message' => 'Data dokumen Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

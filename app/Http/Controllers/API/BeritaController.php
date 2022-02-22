<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function view()
    {
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
                'gambar' => 'required|mimes:jpeg,jpg,png|max:5000',
                'tgl' => 'required|date',
                'user_id' => 'required|max:11'
            ]);

            $berita = new Berita;
            $berita->judul = $request->judul;
            $berita->kategori_id = $request->kategori_id;
            $berita->isi = $request->isi;
            $berita->gambar = $request->file('gambar')->store('images');
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
                'gambar' => 'required|mimes:jpeg,jpg,png|max:5000',
                'tgl' => 'required|date',
                'user_id' => 'required|max:11'
            ]);

            $berita->update([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'isi' => $request->isi,
                'gambar' => $request->file('gambar')->store('images'),
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

        if ($user->role == 'admin') {
            $berita = Berita::find($id)->delete();
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

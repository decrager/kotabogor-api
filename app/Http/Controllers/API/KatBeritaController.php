<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Kat_Berita;

class KatBeritaController extends Controller
{
    public function view()
    {
        $katberita = Kat_Berita::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data kat_berita Loaded Successfully',
            'kat_berita' => $katberita
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $katberita = Kat_Berita::find($id);
        return response()->json([
            'message' => 'Data kat_berita Loaded Successfully',
            'kat_berita' => $katberita
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'kategori' => 'required|max:50',
                'keterangan' => 'required|max:50'
            ]);

            $katberita = new Kat_Berita;
            $katberita->kategori = $request->kategori;
            $katberita->keterangan = $request->keterangan;
            $katberita->save();

            return response()->json([
                'message' => 'Data kat_berita Added Successfully!',
                'Added kat_berita' => $katberita
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $katberita = Kat_Berita::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'kategori' => 'required|max:50',
                'keterangan' => 'required|max:50'
            ]);

            $katberita->update([
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan
            ]);

            return response()->json([
                'message' => 'Data kat_berita Updated Success',
                'Updated kat_berita' => $katberita
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
            $katberita = Kat_Berita::find($id)->delete();
            return response()->json([
                'message' => 'Data kat_berita Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

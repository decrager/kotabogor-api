<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Foto;

class FotoController extends Controller
{
    public function view()
    {
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
                'foto' => 'required|mimes:jpeg,jpg,png|max:5000',
                'keterangan' => 'required|max:100'
            ]);

            $foto = new Foto;
            $foto->album_id = $request->album_id;
            $foto->judul = $request->judul;
            $foto->foto = $request->foto;
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
                'foto' => 'required|mimes:jpeg,jpg,png|max:5000',
                'keterangan' => 'required|max:100'
            ]);

            $foto->update([
                'album_id' => $request->album_id,
                'judul' => $request->judul,
                'foto' => $request->foto,
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

        if ($user->role == 'admin') {
            $foto = Foto::find($id)->delete();
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

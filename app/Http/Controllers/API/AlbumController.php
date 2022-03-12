<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function view()
    {
        $album = Album::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data album Loaded Successfully',
            'album' => $album
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $album = Album::find($id);
        return response()->json([
            'message' => 'Data album Loaded Successfully',
            'album' => $album
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:100',
                'tgl' => 'required|date',
                'cover' => 'required|mimes:jpeg,jpg,png|max:3072',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/album', $fileName);

            $album = new Album;
            $album->judul = $request->judul;
            $album->tgl = $request->tgl;
            $album->cover = $fileName;
            $album->user_id = $request->user_id;
            $album->save();

            return response()->json([
                'message' => 'Data album Added Successfully!',
                'Added album' => $album
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $album = Album::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:100',
                'tgl' => 'required|date',
                'cover' => 'required|mimes:jpeg,jpg,png|max:3072',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/album', $fileName);

            $destination = 'images/album/' . $album->cover;
            if ($destination) {
                Storage::delete($destination);
            }

            $album->update([
                'judul' => $request->judul,
                'tgl' => $request->tgl,
                'cover' => $fileName,
                'user_id' => $request->user_id
            ]);

            return response()->json([
                'message' => 'Data album Updated Success',
                'Updated album' => $album
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
        $album = Album::find($id);
        $destination = 'images/album/' . $album->cover;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Album::find($id)->delete();
            return response()->json([
                'message' => 'Data album Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

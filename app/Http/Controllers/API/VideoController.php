<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function view()
    {
        $video = Video::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data video Loaded Successfully',
            'video' => $video
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $video = Video::find($id);
        return response()->json([
            'message' => 'Data video Loaded Successfully',
            'video' => $video
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:85',
                'cover' => 'required|mimes:jpeg,jpg,png|max:3072',
                'link' => 'required|max:100',
                'keterangan' => 'required|max:200',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('cover');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('images/video', $fileName);

            $video = new Video;
            $video->judul = $request->judul;
            $video->cover = $request->file('cover')->getClientOriginalName();
            $video->link = $request->link;
            $video->keterangan = $request->keterangan;
            $video->user_id = $request->user_id;
            $video->save();

            return response()->json([
                'message' => 'Data video Added Successfully!',
                'Added video' => $video
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:85',
                'cover' => 'required|mimes:jpeg,jpg,png|max:3072',
                'link' => 'required|max:100',
                'keterangan' => 'required|max:200',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('cover');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('images/video', $fileName);

            $destination = 'images/video/' . $video->cover;
            if ($destination) {
                Storage::delete($destination);
            }

            $video->update([
                'judul' => $request->judul,
                'cover' => $request->file('cover')->getClientOriginalName(),
                'link' => $request->link,
                'keterangan' => $request->keterangan,
                'user_id' => $request->user_id
            ]);

            return response()->json([
                'message' => 'Data video Updated Success',
                'Updated video' => $video
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
        $video = Video::find($id);
        $destination = 'images/video/' . $video->cover;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Video::find($id)->delete();
            return response()->json([
                'message' => 'Data video Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

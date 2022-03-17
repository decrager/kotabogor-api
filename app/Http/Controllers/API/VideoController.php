<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Video;
use App\Models\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends Controller
{
    public function counter($API)
    {
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', $API)->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', $API)->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = $API;
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', $API)->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = $API;
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
    }
    
    public function view()
    {
        $this->counter('Video');
        
        $video = Video::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data video Loaded Successfully',
            'video' => $video
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $this->counter('Video');

        $video = Video::find($id);
        return response()->json([
            'message' => 'Data video Loaded Successfully',
            'video' => $video
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $this->counter('Video');

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
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/video', $fileName);

            $video = new Video;
            $video->judul = $request->judul;
            $video->cover = $fileName;
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
        $this->counter('Video');

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
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/video', $fileName);

            $destination = 'images/video/' . $video->cover;
            if ($destination) {
                Storage::delete($destination);
            }

            $video->update([
                'judul' => $request->judul,
                'cover' => $fileName,
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
        $this->counter('Video');
        
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

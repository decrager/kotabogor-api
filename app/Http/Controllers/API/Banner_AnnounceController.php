<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use Illuminate\Http\Request;
use App\Models\Banner_Announce;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class Banner_AnnounceController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Banner Announcement')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Banner Announcement')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Banner Announcement';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Banner Announcement')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Banner Announcement';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter

        $announce = Banner_Announce::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data banner_announce Loaded Successfully',
            'banner_announce' => $announce
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $announce = Banner_Announce::find($id);
        return response()->json([
            'message' => 'Data banner_announce Loaded Successfully',
            'banner_announce' => $announce
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'keterangan' => 'required|max:250',
                'status' => 'required|in:0,1',
                'link' => 'required|max:100',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/banner_announce', $fileName);

            $announce = new Banner_Announce;
            $announce->judul = $request->judul;
            $announce->gambar = $fileName;
            $announce->keterangan = $request->keterangan;
            $announce->status = $request->status;
            $announce->link = $request->link;
            $announce->user_id = $request->user_id;
            $announce->save();

            return response()->json([
                'message' => 'Data banner_announce Added Successfully!',
                'Added banner_announce' => $announce
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $announce = Banner_Announce::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'keterangan' => 'required|max:250',
                'status' => 'required|in:0,1',
                'link' => 'required|max:100',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/banner_announce', $fileName);

            $destination = 'images/banner_announce/' . $announce->gambar;
            if ($destination) {
                Storage::delete($destination);
            }

            $announce->update([
                'judul' => $request->judul,
                'gambar' => $fileName,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
                'link' => $request->link,
                'user_id' => $request->user_id
            ]);

            return response()->json([
                'message' => 'Data banner_announce Updated Success',
                'Updated banner_announce' => $announce
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
        $announce = Banner_Announce::find($id);
        $destination = 'images/banner_announce/' . $announce->gambar;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Banner_Announce::find($id)->delete();
            return response()->json([
                'message' => 'Data banner_announce Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

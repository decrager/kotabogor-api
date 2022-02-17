<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner_Announce;

class Banner_AnnounceController extends Controller
{
    public function view()
    {
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
                'gambar' => 'required|mimes:jpeg,jpg,png|max:5000',
                'keterangan' => 'required|max:250',
                'status' => 'required|in:0,1',
                'link' => 'required|max:100',
                'user_id' => 'required|max:11'
            ]);

            $announce = new Banner_Announce;
            $announce->judul = $request->judul;
            $announce->gambar = $request->gambar;
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
                'gambar' => 'required|mimes:jpeg,jpg,png|max:5000',
                'keterangan' => 'required|max:250',
                'status' => 'required|in:0,1',
                'link' => 'required|max:100',
                'user_id' => 'required|max:11'
            ]);

            $announce->update([
                'judul' => $request->judul,
                'gambar' => $request->gambar,
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

        if ($user->role == 'admin') {
            $announce = Banner_Announce::find($id)->delete();
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

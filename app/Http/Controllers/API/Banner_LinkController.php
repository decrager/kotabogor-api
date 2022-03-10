<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner_Link;
use Illuminate\Support\Facades\Storage;

class Banner_LinkController extends Controller
{
    public function view()
    {
        $link = Banner_Link::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data banner_link Loaded Successfully',
            'banner_link' => $link
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $link = Banner_Link::find($id);
        return response()->json([
            'message' => 'Data banner_link Loaded Successfully',
            'banner_link' => $link
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:85',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'link' => 'required|max:100',
                'status' => 'required|in:0.1',
            ]);

            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('images/banner_link', $fileName);

            $link = new Banner_Link;
            $link->judul = $request->judul;
            $link->gambar = $request->file('gambar')->getClientOriginalName();
            $link->link = $request->link;
            $link->status = $request->status;
            $link->save();

            return response()->json([
                'message' => 'Data banner_link Added Successfully!',
                'Added banner_link' => $link
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $link = Banner_Link::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:85',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'link' => 'required|max:100',
                'status' => 'required|in:0.1',
            ]);

            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('images/banner_link', $fileName);

            $destination = 'images/banner_link/' . $link->gambar;
            if ($destination) {
                Storage::delete($destination);
            }

            $link->update([
                'judul' => $request->judul,
                'gambar' => $request->file('gambar')->getClientOriginalName(),
                'link' => $request->link,
                'status' => $request->status
            ]);

            return response()->json([
                'message' => 'Data banner_link Updated Success',
                'Updated banner_link' => $link
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
        $link = Banner_Link::find($id);
        $destination = 'images/banner_link/' . $link->gambar;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Banner_Link::find($id)->delete();
            return response()->json([
                'message' => 'Data banner_link Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

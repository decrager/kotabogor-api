<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Link_Info;
use Illuminate\Support\Facades\Storage;

class LinkInfoController extends Controller
{
    public function view()
    {
        $info = Link_Info::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data link_info Loaded Successfully',
            'link_info' => $info
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $info = Link_Info::find($id);
        return response()->json([
            'message' => 'Data link_info Loaded Successfully',
            'link_info' => $info
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:50',
                'keterangan' => 'required|max:200',
                'link' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/linkinfo', $fileName);

            $info = new Link_Info;
            $info->judul = $request->judul;
            $info->keterangan = $request->keterangan;
            $info->link = $request->link;
            $info->gambar = $fileName;
            $info->save();

            return response()->json([
                'message' => 'Data link_info Added Successfully!',
                'Added link_info' => $info
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $info = Link_Info::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:50',
                'keterangan' => 'required|max:200',
                'link' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/linkinfo', $fileName);

            $destination = 'images/linkinfo/' . $info->gambar;
            if ($destination) {
                Storage::delete($destination);
            }

            $info->update([
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'link' => $request->link,
                'gambar' => $fileName
            ]);

            return response()->json([
                'message' => 'Data link_info Updated Success',
                'Updated link_info' => $info
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
        $info = Link_Info::find($id);
        $destination = 'images/linkinfo/' . $info->gambar;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Link_Info::find($id)->delete();
            return response()->json([
                'message' => 'Data link_info Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

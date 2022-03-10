<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Statis;
use Illuminate\Support\Facades\Storage;

class StatisController extends Controller
{
    public function view()
    {
        $statis = Statis::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data statis Loaded Successfully',
            'statis' => $statis
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $statis = Statis::find($id);
        return response()->json([
            'message' => 'Data statis Loaded Successfully',
            'statis' => $statis
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
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072',
                'tgl' => 'required|date',
                'status' => 'required|in:0,1',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('images/statis', $fileName);

            $statis = new Statis;
            $statis->judul = $request->judul;
            $statis->kategori_id = $request->kategori_id;
            $statis->isi = $request->isi;
            $statis->file = $request->file('file')->getClientOriginalName();
            $statis->tgl = $request->tgl;
            $statis->status = $request->status;
            $statis->user_id = $request->user_id;
            $statis->save();

            return response()->json([
                'message' => 'Data statis Added Successfully!',
                'Added statis' => $statis
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $statis = Statis::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:100',
                'kategori_id' => 'required|max:11',
                'isi' => 'required',
                'file' => 'nullable|mimes:jpeg,jpg,png|max:3072',
                'tgl' => 'required|date',
                'status' => 'required|in:0,1',
                'user_id' => 'required|max:11'
            ]);

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('images/statis', $fileName);

            $destination = 'images/statis/' . $statis->file;
            if ($destination) {
                Storage::delete($destination);
            }

            $statis->update([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'isi' => $request->isi,
                'file' => $request->file('file')->getClientOriginalName(),
                'tgl' => $request->tgl,
                'status' => $request->status,
                'user_id' => $request->user_id
            ]);

            return response()->json([
                'message' => 'Data statis Updated Success',
                'Updated statis' => $statis
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
        $statis = Statis::find($id);
        $destination = 'images/statis/' . $statis->file;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Statis::find($id)->delete();
            return response()->json([
                'message' => 'Data statis Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

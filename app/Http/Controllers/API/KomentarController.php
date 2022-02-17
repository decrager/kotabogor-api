<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Komentar;

class KomentarController extends Controller
{
    public function view()
    {
        $komentar = Komentar::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data komentar Loaded Successfully',
            'komentar' => $komentar
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $komentar = Komentar::find($id);
        return response()->json([
            'message' => 'Data komentar Loaded Successfully',
            'komentar' => $komentar
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'berita_id' => 'required',
                'nama' => 'required',
                'email' => 'required',
                'komentar' => 'required'
            ]);

            $komentar = new Komentar;
            $komentar->berita_id = $request->berita_id;
            $komentar->nama = $request->nama;
            $komentar->email = $request->email;
            $komentar->komentar = $request->komentar;
            $komentar->save();

            return response()->json([
                'message' => 'Data komentar Added Successfully!',
                'Added komentar' => $komentar
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $komentar = Komentar::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'berita_id' => 'required',
                'nama' => 'required',
                'email' => 'required',
                'komentar' => 'required'
            ]);

            $komentar->update([
                'berita_id' => $request->berita_id,
                'nama' => $request->nama,
                'email' => $request->email,
                'komentar' => $request->komentar
            ]);

            return response()->json([
                'message' => 'Data komentar Updated Success',
                'Updated komentar' => $komentar
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
            $komentar = Komentar::find($id)->delete();
            return response()->json([
                'message' => 'Data komentar Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

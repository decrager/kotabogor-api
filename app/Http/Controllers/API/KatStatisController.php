<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Kat_Statis;

class KatStatisController extends Controller
{
    public function view()
    {
        $katstatis = Kat_Statis::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data kat_statis Loaded Successfully',
            'kat_statis' => $katstatis
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $katstatis = Kat_Statis::find($id);
        return response()->json([
            'message' => 'Data kat_statis Loaded Successfully',
            'kat_statis' => $katstatis
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'kategori' => 'required',
                'keterangan' => 'required'
            ]);

            $katstatis = new Kat_Statis;
            $katstatis->kategori = $request->kategori;
            $katstatis->keterangan = $request->keterangan;
            $katstatis->save();

            return response()->json([
                'message' => 'Data kat_statis Added Successfully!',
                'Added kat_statis' => $katstatis
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $katstatis = Kat_Statis::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'kategori' => 'required',
                'keterangan' => 'required'
            ]);

            $katstatis->update([
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan
            ]);

            return response()->json([
                'message' => 'Data kat_statis Updated Success',
                'Updated kat_statis' => $katstatis
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
            $katstatis = Kat_Statis::find($id)->delete();
            return response()->json([
                'message' => 'Data kat_statis Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

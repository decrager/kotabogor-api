<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Data_opd;

class DataOPDController extends Controller
{
    public function view()
    {
        $opd = Data_opd::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data data_opd Loaded Successfully',
            'data_opd' => $opd
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $opd = Data_opd::find($id);
        return response()->json([
            'message' => 'Data data_opd Loaded Successfully',
            'data_opd' => $opd
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama_opd' => 'required|max:50',
                'foto_kantor' => 'required|mimes:jpeg,jpg,png|max:5000',
                'nama_kepalaopd' => 'required|max:50',
                'foto_kepalaopd' => 'required|mimes:jpeg,jpg,png|max:5000',
                'alamat' => 'required|max:100',
                'telp' => 'required|max:15',
                'email' => 'required|max:50',
                'website' => 'required|max:50',
                'twitter_alamat' => 'nullable|max:50',
                'twitter_link' => 'nullable|max:100',
                'ig_alamat' => 'nullable|max:50',
                'ig_link' => 'nullable|max:100',
                'facebook_alamat' => 'nullable|max:50',
                'facebook_link' => 'nullable|max:100'
            ]);

            $opd = new Data_opd;
            $opd->nama_opd = $request->nama_opd;
            $opd->foto_kantor = $request->foto_kantor;
            $opd->nama_kepalaopd = $request->nama_kepalaopd;
            $opd->foto_kepalaopd = $request->foto_kepalaopd;
            $opd->alamat = $request->alamat;
            $opd->telp = $request->telp;
            $opd->email = $request->email;
            $opd->website = $request->website;
            $opd->twitter_alamat = $request->twitter_alamat;
            $opd->twitter_link = $request->twitter_link;
            $opd->ig_alamat = $request->ig_alamat;
            $opd->ig_link = $request->ig_link;
            $opd->facebook_alamat = $request->facebook_alamat;
            $opd->facebook_link = $request->facebook_link;
            $opd->save();

            return response()->json([
                'message' => 'Data data_opd Added Successfully!',
                'Added data_opd' => $opd
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $opd = Data_opd::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama_opd' => 'required|max:50',
                'foto_kantor' => 'required|mimes:jpeg,jpg,png|max:5000',
                'nama_kepalaopd' => 'required|max:50',
                'foto_kepalaopd' => 'required|mimes:jpeg,jpg,png|max:5000',
                'alamat' => 'required|max:100',
                'telp' => 'required|max:15',
                'email' => 'required|max:50',
                'website' => 'required|max:50',
                'twitter_alamat' => 'nullable|max:50',
                'twitter_link' => 'nullable|max:100',
                'ig_alamat' => 'nullable|max:50',
                'ig_link' => 'nullable|max:100',
                'facebook_alamat' => 'nullable|max:50',
                'facebook_link' => 'nullable|max:100'
            ]);

            $opd->update([
                'nama_opd' => $request->nama_opd,
                'foto_kantor' => $request->foto_kantor,
                'nama_kepalaopd' => $request->nama_kepalaopd,
                'foto_kepalaopd' => $request->foto_kepalaopd,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'website' => $request->website,
                'twitter_alamat' => $request->twitter_alamat,
                'twitter_link' => $request->twitter_link,
                'ig_alamat' => $request->ig_alamat,
                'ig_link' => $request->ig_link,
                'facebook_alamat' => $request->facebook_alamat,
                'facebook_link' => $request->facebook_link,
            ]);

            return response()->json([
                'message' => 'Data data_opd Updated Success',
                'Updated data_opd' => $opd
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
            $opd = Data_opd::find($id)->delete();
            return response()->json([
                'message' => 'Data data_opd Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

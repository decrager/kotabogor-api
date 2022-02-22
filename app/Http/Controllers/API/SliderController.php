<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;

class SliderController extends Controller
{
    public function view()
    {
        $slider = Slider::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data slider Loaded Successfully',
            'slider' => $slider
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $slider = Slider::find($id);
        return response()->json([
            'message' => 'Data slider Loaded Successfully',
            'slider' => $slider
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:50',
                'keterangan' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:5000',
                'status' => 'required|in:0,1'
            ]);

            $slider = new Slider;
            $slider->judul = $request->judul;
            $slider->keterangan = $request->keterangan;
            $slider->gambar = $request->file('gambar')->store('images');
            $slider->status = $request->status;
            $slider->save();

            return response()->json([
                'message' => 'Data slider Added Successfully!',
                'Added slider' => $slider
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:50',
                'keterangan' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:5000',
                'status' => 'required|in:0,1'
            ]);

            $slider->update([
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'gambar' => $request->file('gambar')->store('images'),
                'status' => $request->status
            ]);

            return response()->json([
                'message' => 'Data slider Updated Success',
                'Updated slider' => $slider
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
            $slider = Slider::find($id)->delete();
            return response()->json([
                'message' => 'Data slider Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

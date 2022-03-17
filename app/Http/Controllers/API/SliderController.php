<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Slider;
use App\Models\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
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

    public function view(Request $request)
    {
        $this->counter('Slider');

        if ($request->order == 'DESC' or $request->order == 'ASC') {
            $slider = Slider::orderBy('id', 'ASC')->get();
        } else {
            $slider = Slider::orderBy('id', 'ASC')->get();
        }
        
        return response()->json([
            'message' => 'Data slider Loaded Successfully',
            'slider' => $slider
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $this->counter('Slider');

        $slider = Slider::find($id);
        return response()->json([
            'message' => 'Data slider Loaded Successfully',
            'slider' => $slider
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $this->counter('Slider');

        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:50',
                'keterangan' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'status' => 'required|in:0,1'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/slider', $fileName);

            $slider = new Slider;
            $slider->judul = $request->judul;
            $slider->keterangan = $request->keterangan;
            $slider->gambar = $fileName;
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
        $this->counter('Slider');

        $slider = Slider::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'judul' => 'required|max:50',
                'keterangan' => 'required|max:100',
                'gambar' => 'required|mimes:jpeg,jpg,png|max:3072',
                'status' => 'required|in:0,1'
            ]);

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/slider', $fileName);

            $destination = 'images/slider/' . $slider->gambar;
            if ($destination) {
                Storage::delete($destination);
            }

            $slider->update([
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'gambar' => $fileName,
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
        $this->counter('Slider');

        $user = Auth::user();
        $slider = Slider::find($id);
        $destination = 'images/slider/' . $slider->gambar;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Slider::find($id)->delete();
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

<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Kat_Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KatBeritaController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Kategori Berita')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Kategori Berita')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Kategori Berita';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Kategori Berita')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Kategori Berita';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $katberita = Kat_Berita::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data kat_berita Loaded Successfully',
            'kat_berita' => $katberita
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $katberita = Kat_Berita::find($id);
        return response()->json([
            'message' => 'Data kat_berita Loaded Successfully',
            'kat_berita' => $katberita
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'kategori' => 'required|max:50',
                'keterangan' => 'required|max:50'
            ]);

            $katberita = new Kat_Berita;
            $katberita->kategori = $request->kategori;
            $katberita->keterangan = $request->keterangan;
            $katberita->save();

            return response()->json([
                'message' => 'Data kat_berita Added Successfully!',
                'Added kat_berita' => $katberita
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $katberita = Kat_Berita::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'kategori' => 'required|max:50',
                'keterangan' => 'required|max:50'
            ]);

            $katberita->update([
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan
            ]);

            return response()->json([
                'message' => 'Data kat_berita Updated Success',
                'Updated kat_berita' => $katberita
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
            $katberita = Kat_Berita::find($id)->delete();
            return response()->json([
                'message' => 'Data kat_berita Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

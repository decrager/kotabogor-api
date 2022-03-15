<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KomentarController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Komentar')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Komentar')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Komentar';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Komentar')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Komentar';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
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

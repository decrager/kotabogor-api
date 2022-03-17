<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Kat_Statis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KatStatisController extends Controller
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

    public function view()
    {
        $this->counter('Kategori Statis');
        
        $katstatis = Kat_Statis::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data kat_statis Loaded Successfully',
            'kat_statis' => $katstatis
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $this->counter('Kategori Statis');

        $katstatis = Kat_Statis::find($id);
        return response()->json([
            'message' => 'Data kat_statis Loaded Successfully',
            'kat_statis' => $katstatis
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $this->counter('Kategori Statis');

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
        $this->counter('Kategori Statis');

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
        $this->counter('Kategori Statis');
        
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

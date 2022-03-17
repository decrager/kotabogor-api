<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Statis;
use App\Models\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class StatisController extends Controller
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
        $this->counter('Statis');
        
        $statis = Statis::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data statis Loaded Successfully',
            'statis' => $statis
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $this->counter('Statis');

        $statis = Statis::find($id);
        return response()->json([
            'message' => 'Data statis Loaded Successfully',
            'statis' => $statis
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $this->counter('Statis');

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
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/statis', $fileName);

            $statis = new Statis;
            $statis->judul = $request->judul;
            $statis->kategori_id = $request->kategori_id;
            $statis->isi = $request->isi;
            $statis->file = $fileName;
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
        $this->counter('Statis');

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
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/statis', $fileName);

            $destination = 'images/statis/' . $statis->file;
            if ($destination) {
                Storage::delete($destination);
            }

            $statis->update([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'isi' => $request->isi,
                'file' => $fileName,
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
        $this->counter('Statis');
        
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

<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Data_opd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DataOPDController extends Controller
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
        $this->counter('Data OPD');
        
        $opd = Data_opd::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data data_opd Loaded Successfully',
            'data_opd' => $opd
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $this->counter('Data OPD');

        $opd = Data_opd::find($id);
        return response()->json([
            'message' => 'Data data_opd Loaded Successfully',
            'data_opd' => $opd
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $this->counter('Data OPD');

        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama_opd' => 'required|max:50',
                'foto_kantor' => 'required|mimes:jpeg,jpg,png|max:3072',
                'alamat' => 'required|max:100',
                'telp' => 'required|max:15',
                'email' => 'required|max:50',
                'website' => 'required|max:50',
                'twitter_link' => 'nullable|max:100',
                'ig_link' => 'nullable|max:100',
                'facebook_link' => 'nullable|max:100'
            ]);

            $file = $request->file('foto_kantor');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/opd', $fileName);

            $opd = new Data_opd;
            $opd->nama_opd = $request->nama_opd;
            $opd->foto_kantor = $fileName;
            $opd->alamat = $request->alamat;
            $opd->telp = $request->telp;
            $opd->email = $request->email;
            $opd->website = $request->website;
            $opd->twitter_link = $request->twitter_link;
            $opd->ig_link = $request->ig_link;
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
        $this->counter('Data OPD');

        $opd = Data_opd::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama_opd' => 'required|max:50',
                'foto_kantor' => 'required|mimes:jpeg,jpg,png|max:3072',
                'alamat' => 'required|max:100',
                'telp' => 'required|max:15',
                'email' => 'required|max:50',
                'website' => 'required|max:50',
                'twitter_link' => 'nullable|max:100',
                'ig_link' => 'nullable|max:100',
                'facebook_link' => 'nullable|max:100'
            ]);

            $file = $request->file('foto_kantor');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/opd', $fileName);

            $destination = 'images/opd/' . $opd->foto_kantor;
            if ($destination) {
                Storage::delete($destination);
            }

            $opd->update([
                'nama_opd' => $request->nama_opd,
                'foto_kantor' => $fileName,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'website' => $request->website,
                'twitter_link' => $request->twitter_link,
                'ig_link' => $request->ig_link,
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
        $this->counter('Data OPD');
        
        $user = Auth::user();
        $opd = Data_opd::find($id);
        $destination = 'images/opd/' . $opd->foto_kantor;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Data_opd::find($id)->delete();
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

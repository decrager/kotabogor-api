<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PenggunaController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Pengguna')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Pengguna')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Pengguna';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Pengguna')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Pengguna';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $pengguna = Pengguna::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data pengguna Loaded Successfully',
            'pengguna' => $pengguna
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $pengguna = Pengguna::find($id);
        return response()->json([
            'message' => 'Data pengguna Loaded Successfully',
            'pengguna' => $pengguna
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama' => 'required|max:50',
                'email' => 'required|max:50',
                'telp' => 'required|max:15',
                'username' => 'required|max:25',
                'password' => 'required|max:100',
                'role' => 'required|max:25',
                'foto' => 'required|mimes:jpeg,jpg,png|max:3072'
            ]);

            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/pengguna', $fileName);

            $pengguna = new Pengguna;
            $pengguna->nama = $request->nama;
            $pengguna->email = $request->email;
            $pengguna->telp = $request->telp;
            $pengguna->username = $request->username;
            $pengguna->password = Hash::make($request->password);
            $pengguna->role = $request->role;
            $pengguna->foto = $fileName;
            $pengguna->save();

            return response()->json([
                'message' => 'Data pengguna Added Successfully!',
                'Addedd pengguna' => $pengguna
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'nama' => 'required|max:50',
                'email' => 'required|max:50',
                'telp' => 'required|max:15',
                'username' => 'required|max:25',
                'password' => 'required|max:100',
                'role' => 'required|max:25',
                'foto' => 'required|mimes:jpeg,jpg,png|max:3072'
            ]);

            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/pengguna', $fileName);

            $destination = 'images/pengguna/' . $pengguna->foto;
            if ($destination) {
                Storage::delete($destination);
            }

            $pengguna->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telp' => $request->telp,
                'username' => $request->username,
                'password' => $request->password,
                'role' => $request->role,
                'foto' => $fileName
            ]);

            return response()->json([
                'message' => 'Data pengguna Updated Success',
                'Updated pengguna' => $pengguna
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
        $pengguna = Pengguna::find($id);
        $destination = 'images/pengguna/' . $pengguna->foto;

        if ($user->role == 'admin') {
            if ($destination) {
                Storage::delete($destination);
            }
            Pengguna::find($id)->delete();
            return response()->json([
                'message' => 'Data pengguna Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

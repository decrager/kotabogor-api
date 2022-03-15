<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FaqController extends Controller
{
    public function view()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'FAQ')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'FAQ')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'FAQ';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'FAQ')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'FAQ';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $faq = Faq::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data faq Loaded Successfully',
            'faq' => $faq
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $faq = Faq::find($id);
        return response()->json([
            'message' => 'Data faq Loaded Successfully',
            'faq' => $faq
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'pertanyaan' => 'required',
                'jawaban' => 'required'
            ]);

            $faq = new Faq;
            $faq->pertanyaan = $request->pertanyaan;
            $faq->jawaban = $request->jawaban;
            $faq->save();

            return response()->json([
                'message' => 'Data faq Added Successfully!',
                'Added faq' => $faq
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'pertanyaan' => 'required',
                'jawaban' => 'required'
            ]);

            $faq->update([
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban
            ]);

            return response()->json([
                'message' => 'Data faq Updated Success',
                'Updated faq' => $faq
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
            $faq = Faq::find($id)->delete();
            return response()->json([
                'message' => 'Data faq Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

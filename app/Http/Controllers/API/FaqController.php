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
        $this->counter('FAQ');
        
        $faq = Faq::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data faq Loaded Successfully',
            'faq' => $faq
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $this->counter('FAQ');

        $faq = Faq::find($id);
        return response()->json([
            'message' => 'Data faq Loaded Successfully',
            'faq' => $faq
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $this->counter('FAQ');

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
        $this->counter('FAQ');

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
        $this->counter('FAQ');
        
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

<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Counter;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VisitorController extends Controller
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
        $this->counter('Visitor');

        if ($request->total) {
            $visitor = Visitor::select('total_visit')->sum('total_visit');
        } elseif ($request->limit) {
            $visitor = Visitor::orderBy('id', 'DESC')->take($request->limit)->get();
        } else {
            $visitor = Visitor::orderBy('id', 'ASC')->get();
        }

        return response()->json([
            'message' => 'Data visitor Loaded Successfully',
            'visitor' => $visitor
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $this->counter('Visitor');

        $visitor = Visitor::find($id);
        return response()->json([
            'message' => 'Data visitor Loaded Successfully',
            'visitor' => $visitor
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $this->counter('Visitor');

        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'tgl' => 'required|date',
                'total_visit' => 'required|numeric'
            ]);

            $visitor = new Visitor;
            $visitor->tgl = $request->tgl;
            $visitor->total_visit = $request->total_visit;
            $visitor->save();

            return response()->json([
                'message' => 'Data visitor Added Successfully!',
                'Added visitor' => $visitor
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(Request $request, $id)
    {
        $this->counter('Visitor');

        $visitor = Visitor::find($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $request->validate([
                'tgl' => 'required|date',
                'total_visit' => 'required|numeric'
            ]);

            $visitor->update([
                'tgl' => $request->tgl,
                'total_visit' => $request->total_visit
            ]);

            return response()->json([
                'message' => 'Data visitor Updated Success',
                'Updated visitor' => $visitor
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function destroy($id)
    {
        $this->counter('Visitor');
        
        $user = Auth::user();

        if ($user->role == 'admin') {
            $visitor = Visitor::find($id)->delete();
            return response()->json([
                'message' => 'Data visitor Deleted Successfully!'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => "Unauthorized"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

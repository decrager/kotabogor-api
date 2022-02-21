<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function view()
    {
        $visitor = Visitor::orderBy('id', 'ASC')->get();
        return response()->json([
            'message' => 'Data visitor Loaded Successfully',
            'visitor' => $visitor
        ], Response::HTTP_OK);
    }

    public function viewById($id)
    {
        $visitor = Visitor::find($id);
        return response()->json([
            'message' => 'Data visitor Loaded Successfully',
            'visitor' => $visitor
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;

class FaqController extends Controller
{
    public function view()
    {
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Counter;

class StatisticController extends Controller
{
    public function index()
    {
        $statistic = Counter::select('api', 'tanggal', 'visit');

        if (request('date')) {
            $date = request('date');
            $statistic->where('tanggal', $date);
        }

        if (request('api')) {
            $statistic->where('api', 'like', '%' . request('api') . '%');
        }

        return view('statistic', ['data' => $statistic->paginate(15)]);
    }

    public function chart()
    {
        $statistic = Counter::selectRaw('api, SUM(visit) AS visit')
            ->groupBy('api')
            ->get();

        return $statistic;
    }
}

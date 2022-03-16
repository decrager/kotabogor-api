<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Counter;

class StatisticController extends Controller
{
    public function index()
    {
        $statistic = Counter::select('api', 'tanggal', 'visit')
            ->orderBy('tanggal', 'DESC')
            ->orderBy('api', 'ASC');

        if (request('date')) {
            $date = request('date');
            $statistic->where('tanggal', $date);
        }

        if (request('api')) {
            $statistic->where('api', 'like', '%' . request('api') . '%');
        }

        $chart = Counter::selectRaw('api, SUM(visit) AS visit')
            ->groupBy('api')
            ->get()->toArray();

        $api = array_column($chart, 'api');
        $visit = array_column($chart, 'visit');

        return view('statistic', ['data' => $statistic->paginate(20)])
            ->with('api', json_encode($api))
            ->with('visit', json_encode($visit, JSON_NUMERIC_CHECK));
    }
}

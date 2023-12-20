<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->format('Y-m');

        $data = Penjualan::select(DB::raw('DATE(tanggal) as date'), DB::raw('SUM(grantotal) as total'))
            ->where(DB::raw('DATE_FORMAT(tanggal, "%Y-%m")'), '=', $currentMonth)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return ['data' => $data];
    }
}

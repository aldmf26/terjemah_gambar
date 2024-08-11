<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BookStock;
use App\Models\Terjemahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'countTerjemah' => Terjemahan::count()

        ];
        return view('dashboard', $data);
    }
}

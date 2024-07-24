<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BookStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'books' => DB::table('books')->get(),
            'raks' => DB::table('raks')->get(),
            'categories' => DB::table('categories')->get(),
            'members' => DB::table('members')->get(),
            'loans' => DB::table('loans')->get(),
            'totalBookStock' => BookStock::sum('quantity'),

        ];
        return view('dashboard', $data);
    }
}

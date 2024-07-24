<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RaksController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Raks'
        ];
        return view('admin.raks.index',$data);
    }
}

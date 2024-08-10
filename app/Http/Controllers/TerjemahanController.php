<?php

namespace App\Http\Controllers;

use App\Models\Terjemahan;
use Illuminate\Http\Request;

class TerjemahanController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Terjemahan',
            'terjemahans' => Terjemahan::paginate(10)
        ];
        return view('admin.terjemahan.index',$data);
    }
}

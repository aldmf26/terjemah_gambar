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

    public function create()
    {
        $data = [
            'title' => 'Tambah Terjemahan'
        ];
        return view('admin.terjemahan.create',$data);
    }

    public function store(Request $r)
    {
        $r->validate([
            'ind' => 'required',
            'en' => 'required',
            'image' => 'required'
        ]);


        if ($r->hasFile('image')) {
            $imageName = time().'.'.$r->image->extension();
            $r->image->move(public_path('uploads'), $imageName);
        } else {
            $imageName = $r->image;
        }

        Terjemahan::create([
            'ind' => $r->ind,
            'en' => $r->en,
            'image' => $imageName,
        ]);
        return redirect()->route('admin.terjemahan.index')->with('sukses', 'berhasil tambah data');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Terjemahan',
            'terjemahan' => Terjemahan::find($id)
        ];
        return view('admin.terjemahan.edit',$data);
    }

    public function update($id, Request $r)
    {
        $get = Terjemahan::find($id);
        $r->validate([
            'ind' => 'required',
            'en' => 'required',
        ]);


        if ($r->hasFile('image')) {
            $imageName = time().'.'.$r->image->extension();
            $r->image->move(public_path('uploads'), $imageName);
        } else {
            $imageName = $r->image ?? $get->image;
        }
        
        $get->update([
            'ind' => $r->ind,
            'en' => $r->en,
            'image' => $imageName,
        ]);
        return redirect()->route('admin.terjemahan.index')->with('sukses', 'berhasil ubah data');

    }

    public function destroy($id)
    {
        $terjemahan = Terjemahan::find($id)->delete();
        return redirect()->route('admin.terjemahan.index')->with('sukses', 'Berhasil hapus data');
    }

}

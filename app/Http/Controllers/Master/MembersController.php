<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Anggota',
            'members' => Member::orderBy('id', 'desc')->paginate(10),
        ];
        return view('admin.members.index',$data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Anggota',
        ];
        return view('admin.members.create',$data);
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Anggota',
            'member' => Member::where('uuid', $id)->first(),
        ];
        return view('admin.members.edit',$data);
    }

    public function store(Request $r)
    {
        $r->merge(['uuid' => \Illuminate\Support\Str::uuid()]);
        Member::create($r->input());
        return redirect()->route('admin.members.index')->with('sukses', "Angota baru ditambahkan");
    }
    public function update($id,Request $r)
    {
        Member::where('uuid', $id)->first()->update($r->input());
        return redirect()->route('admin.members.index')->with('sukses', "Angota berhasil diupdate");
    }
    public function destroy($id)
    {
        Member::where('uuid', $id)->first()->delete();
        return redirect()->route('admin.members.index')->with('sukses', "Angota berhasil dihapus");
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Users',
            'users' => User::orderBy('id', 'desc')->paginate(10),
        ];
        return view('admin.users.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Manajemen Users',
            'user' => User::find($id),
        ];
        return view('admin.users.edit', $data);
    }

    public function update($id, Request $r)
    {
        $user = User::find($id);
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = bcrypt($r->password);
        $user->save();

        $user->assignRole($r->role);
        return redirect()->route('admin.users.index')->with('sukses', 'Berhasil ubah user');
    }

    public function store(Request $r)
    {
        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
        ]);

        $user->assignRole($r->role);
        return redirect()->route('admin.users.index')->with('sukses', 'Berhasil tambah user');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('sukses', 'Berhasil hapus user');
    }
}

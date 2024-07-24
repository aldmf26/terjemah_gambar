<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'categories' => Categories::orderBy('id', 'desc')->paginate(20),
        ];
        return view('admin.categories.index',$data);
    }

    public function store(Request $r)
    {
        DB::table('categories')->insert(['name' => $r->name]);
        return redirect()->route('admin.categories.index')->with('sukses', "Kategori baru ditambahkan");
    }
    public function update(Request $r)
    {
        DB::table('categories')->where('id',$r->id)->update(['name' => $r->name]);
        return redirect()->route('admin.categories.index')->with('sukses', "Kategori berhasil diupdate");
    }
    public function destroy($id)
    {
        Categories::find($id)->delete();
        return redirect()->route('admin.categories.index')->with('sukses', "Kategori berhasil dihapus");
    }
}

<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookStock;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BooksController extends Controller
{
    public function index()
    {
        $itemPerPage = request('itemPerPage', 20);
        
        // $booksQuery = DB::table('books as a')
        //     ->select('a.*, b.quantity, d.name as category, c.name as rack, c.floor')
        //     ->join('book_stocks as b', 'a.id = b.book_id')
        //     ->join('categories as d', 'a.category_id = d.id')
        //     ->join('raks as c', 'a.rack_id = c.id')->get();
        $booksQuery = DB::table('books as a')
    ->leftJoin('book_stocks as b', 'a.id', '=', 'b.book_id')
    ->leftJoin('categories as c', 'a.category_id', '=', 'c.id')
    ->leftJoin('raks as d', 'a.rack_id', '=', 'd.id')
    ->select('a.*', 'b.quantity', 'c.name as category', 'd.name as rack', 'd.floor');

        if (request()->get('search')) {
            $keyword = request()->get('search');
            $booksQuery->where(function ($query) use ($keyword) {
                $query
                    ->where('books.title', 'LIKE', "%{$keyword}%")
                    ->orWhere('books.slug', 'LIKE', "%{$keyword}%")
                    ->orWhere('books.author', 'LIKE', "%{$keyword}%")
                    ->orWhere('books.publisher', 'LIKE', "%{$keyword}%");
            });
        }

        $books = $booksQuery->paginate($itemPerPage);

        $data = [
            'title' => 'Buku',
            'books' => $books,
            'pager' => $books->appends(request()->query()),
            'currentPage' => $books->currentPage(),
            'itemPerPage' => $itemPerPage,
            'search' => request()->get('search'),
        ];

        return view('admin.books.index',$data);
    }

    public function create()
    {
        $data = [
            'title' => 'Buku',
            'racks' => DB::table('raks')->get(),
            'categories' => DB::table('categories')->get(),
        ];
        return view('admin.books.create',$data);
    }

    public function store(Request $r)
    {
        $coverImageFileName = null;
        if ($r->hasFile('cover')) {
            $file = $r->file('cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/book_cover', $filename, 'public');
        }

        $slug = Str::slug($r->title . ' ' . rand(0, 1000));

        $book = Book::create([
            'slug' => $slug,
            'title' => $r->title,
            'author' => $r->author,
            'publisher' => $r->publisher,
            'isbn' => $r->isbn,
            'year' => $r->year,
            'rack_id' => $r->rack,
            'category_id' => $r->category,
            'book_cover' => $filename,
        ]);

        BookStock::create([
            'book_id' => $book->id,
            'quantity' => $r->stock,
        ]);

        return redirect()->route('admin.books.index')->with('sukses', 'Berhasil tambah buku');
    }
}

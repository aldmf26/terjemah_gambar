<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoansController extends Controller
{

    public function getDataMaster($param)
    {
        $user = auth()->user();

        $booksQuery = DB::table('books as a')
            ->leftJoin('book_stocks as b', 'a.id', '=', 'b.book_id')
            ->leftJoin('categories as c', 'a.category_id', '=', 'c.id')
            ->leftJoin('raks as d', 'a.rack_id', '=', 'd.id')
            ->select('a.*', DB::raw('SUM(b.quantity) as stock'), 'b.book_id', 'c.name as category', 'd.name as rack', 'd.floor')
            ->groupBy('b.book_id');

        if ($user->hasRole('superadmin') || $user->hasRole('admin') || $user->hasRole('kepala')) {
            $member = DB::table('loans as a')
                ->join('books as b', 'a.book_id', '=', 'b.id')
                ->join('members as c', 'a.member_id', '=', 'c.user_id')
                ->select('a.*', 'c.first_name', 'c.last_name', 'b.title', 'b.slug', 'b.year', 'b.title', 'b.author')
                ->paginate(10);
        } else {
            $id_user = $user->id;
            $member = DB::table('loans as a')
                ->join('books as b', 'a.book_id', '=', 'b.id')
                ->select('a.*', 'b.title', 'b.slug', 'b.year', 'b.title', 'b.author')
                ->where('member_id', $id_user)
                ->paginate(10);
        }
        $data = [
            'books' => $booksQuery,
            'members' => $member,
        ];
        return $data[$param];
    }
    public function index()
    {

        $data = [
            'title' => 'Peminjaman Buku',
            'members' => $this->getDataMaster('members'),
        ];
        return view('admin.loans.index', $data);
    }

    public function create()
    {
        $id_user = auth()->user()->id;
        $data = [
            'title' => 'Tambah Peminjaman Buku',
            'users' => Member::with('user')->where('user_id', $id_user)->first(),
        ];
        return view('admin.loans.create', $data);
    }

    public function search(Request $r)
    {
        $keyword = $r->search;
        $booksQuery = $this->getDataMaster('books');
        $booksQuery->where(function ($query) use ($keyword) {
            $query
                ->where('a.title', 'LIKE', "%{$keyword}%")
                ->orWhere('a.slug', 'LIKE', "%{$keyword}%")
                ->orWhere('a.author', 'LIKE', "%{$keyword}%")
                ->orWhere('a.publisher', 'LIKE', "%{$keyword}%");
        });
        $data = [
            'search' => $r->search,
            'books' => $booksQuery->get(),
        ];
        return view('admin.loans.search', $data);
    }

    public function new(Request $r)
    {
        $id_user = auth()->user()->id;
        $booksQuery = $this->getDataMaster('books');
        $book_id = explode(',', $r->book_id);
        $booksQuery = $booksQuery->whereIn('a.id', $book_id)->get();
        $data = [
            'title' => 'Tambah Peminjaman Buku',
            'users' => Member::with('user')->where('user_id', $id_user)->first(),
            'books' => $booksQuery,
        ];
        return view('admin.loans.new', $data);
    }
    public function store(Request $r)
    {
        foreach ($r->book_id as $key => $book_id) {
            $data[] = [
                'book_id' => $book_id,
                'quantity' => $r->quantity[$key],
                'member_id' => auth()->user()->id,
                'loan_date' => now(),
                'due_date' => now()->addDays($r->duration[$key]),
                'return_date' => null,

            ];
        }
        Loans::insert($data);
        return redirect()->route('admin.loans.index')->with('sukses', "Peminjaman buku baru ditambahkan");
    }

    public function print_request(Request $r)
    {
        $id_user = auth()->user()->id;
        $existingRequest = DB::table('print_requests')
            ->where('request_by', $id_user)
            ->whereNull('approved_by')
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Anda sudah pernah melakukan permintaan cetak. Tunggu sampai permintaan yang sebelumnya disetujui atau tolak.');
        }

        DB::table('print_requests')->insert([
            'request_by' => $id_user,
            'approved_by' => null,
            'page' => $r->page,
            'date' => now()
        ]);
        return redirect()->back()->with('sukses', 'Permintaan cetak buku baru ditambahkan');
    }

    public function list_print_request()
    {
        $requests = DB::table('print_requests as a')
            ->join('users as b', 'a.request_by', '=', 'b.id')
            ->leftjoin('users as c', 'a.approved_by', '=', 'c.id')
            ->select('a.*', 'b.name', 'c.name as approved_by_name')
            ->get();
        $data = [
            'title' => 'Permintaan Cetak Halaman',
            'requests' => $requests
        ];
        return view('admin.loans.list_print_request', $data);
    }

    public function print_approve($id)
    {
        DB::table('print_requests')->where('id', $id)->update([
            'approved_by' => auth()->user()->id,
            'is_approved' => now()
        ]);
        return redirect()->back()->with('sukses', 'Permintaan cetak buku selesai');
    }

    public function print()
    {
        $data = [
            'title' => 'Peminjaman Buku',
            'members' => $this->getDataMaster('members'),
        ];
        return view('admin.loans.print', $data);
    }
}

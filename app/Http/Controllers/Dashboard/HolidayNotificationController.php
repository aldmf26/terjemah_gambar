<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HolidayNotification;
use Illuminate\Http\Request;

class HolidayNotificationController extends Controller
{
    public function index(Request $request)
    {
        $title = "Notifikasi Hari Besar";
        $search = $request->input('search');

        $notifications = HolidayNotification::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('admin.holiday.index', compact('notifications', 'title', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'icon_type' => 'required|string',
            'display_duration' => 'required|integer|min:1',
        ]);

        HolidayNotification::create($request->all());

        return redirect()->back()->with('success', 'Notifikasi hari besar berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $notification = HolidayNotification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus!');
    }
}
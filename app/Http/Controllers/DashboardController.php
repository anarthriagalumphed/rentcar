<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // dd('dashboard index');
        $users = User::where('role_id', 2)->get();
        $bookcount = Book::count();
        $categorycount = Category::count();
        $usercount = User::where('role_id', 2)->count();
        $rentlogs = RentLogs::with(['user', 'book'])
        ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal yang dibuat (descending)
        ->limit(10) // Mendapatkan 10 data teratas
        ->get();
        return view('dashboard', ['book_count' => $bookcount, 'category_count' => $categorycount, 'user_count' => $usercount, 'rent_logs' => $rentlogs]);
    }
}

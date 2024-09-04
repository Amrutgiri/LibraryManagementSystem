<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $total_users = User::count();
        $total_books = Book::count();

        return view('admin.dashboard', [
            'total_users' => $total_users,
            'total_books' => $total_books
        ]);

    }
}

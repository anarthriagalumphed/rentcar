<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function book_rent()
    {
        $users = User::where('id', '!=', 1)->get();
        $books = Book::where('status', 'in stock')->get();
        $categories = Category::all();
        return view('book_rent', ['users' => $users, 'books' => $books, 'categories' => $categories]);
    }


    public function store(Request $request)
    {
        // Mengambil tanggal peminjaman dan pengembalian dari input
        $rentDate = $request->input('rent_date');
        $returnDate = $request->input('return_date');

        // Memastikan bahwa tanggal yang dimasukkan sesuai dengan kebutuhan atau validasi tambahan
        // Anda mungkin ingin menambahkan validasi tanggal di sini

        try {
            DB::beginTransaction();

            // Setelah mengambil tanggal, Anda dapat menggunakan variabel ini
            // dalam proses berikutnya

            //proses insert ke rent log table//
            RentLogs::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'rent_date' => $rentDate,
                'return_date' => $returnDate,
                // tambahkan kolom lainnya
            ]);

            //proses update ke book table//
            $book = Book::findOrFail($request->book_id);
            $book->status = 'not available';
            $book->save();

            DB::commit();

            Session::flash('message', 'Book Available');
            Session::flash('alert-class', 'alert-success');
            return redirect('rent_logs');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('message', 'Terjadi kesalahan. Silakan coba lagi.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book_rent');
        }
    }


    public function book_return()
    {
        $users = User::where('id', '!=', 1)->get();
        $books = Book::all();
        return view('book_return', ['users' => $users, 'books' => $books]);
    }


    public function returning(Request $request)
    {
        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();
        if ($countData == 1) {
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();

            $book = Book::findOrFail($request->book_id);
            $book->status = 'in stock';
            $book->save();

            Session::flash('message', 'Book Returned');
            Session::flash('alert-class', 'alert-success');
            return redirect('book_return');
        } else {
            Session::flash('message', 'Book Not Returned');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book_return');
        }
    }

    public function selectState(Request $request)
    {
        $books = [];
        $userID = $request->userID;

        if ($request->has('q')) {
            $search = $request->q;
            $books = RentLogs::select('books.id', 'books.title', 'books.book_code')
                ->join('books', 'rent_logs.book_id', '=', 'books.id')
                ->where('rent_logs.user_id', $userID)
                ->where('books.title', 'LIKE', "%$search%")
                ->whereNull('rent_logs.actual_return_date') // Menambahkan kondisi untuk memeriksa buku yang sedang dipinjam
                ->get();
        } else {
            $books = RentLogs::select('books.id', 'books.title', 'books.book_code')
                ->join('books', 'rent_logs.book_id', '=', 'books.id')
                ->where('rent_logs.user_id', $userID)
                ->whereNull('rent_logs.actual_return_date') // Menambahkan kondisi untuk memeriksa buku yang sedang dipinjam
                ->limit(10)
                ->get();
        }

        return response()->json($books);
    }
}

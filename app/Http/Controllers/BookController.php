<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function books()
    {


        $books = Book::all();
        // dd('ini halaman buku');
        return view('books', ['books' => $books]);
    }





    // flush data login
    // public function index(Request $request)
    // {
    //     $request->session()->flush();
    // }


    public function add_books()
    {
        $categories = Category::all();
        return view('add_books', ['categories' => $categories]);
    }




    public function store(Request $request)
    {
        $book_code = 'plw-' . $request->book_code;
        // dd($request->all);
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:100',
            'title' => 'required|max:255'
        ]);
        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }



        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status', 'book added');
    }







    public function edit_books($slug)
    {

        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('edit_books', ['categories' => $categories, 'book' => $book]);
    }

    public function update_books(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->first();

        // Hapus gambar lama jika ada gambar baru
        if ($request->file('image')) {
            // Hapus gambar lama
            if ($book->cover) {
                Storage::delete('cover/' . $book->cover);
            }

            // Upload gambar baru
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }

        $book->update($request->all());

        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('books')->with('status', 'book updated');
    }





    public function delete_books($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('delete_books', ['book' => $book]);
    }


    public function destroy_books($slug)
    {
        $book = Book::where('slug', $slug)->first();

        $book->categories()->detach();
        if ($book->cover) {
            Storage::delete('cover/' . $book->cover);
        }
        $book->forceDelete();
        return redirect('books')->with('status', 'category deleted');
    }


    public function deleted_books()
    {
        $deletedBooks = Book::onlyTrashed()->get();
        return view('deleted_books', ['deletedBooks' => $deletedBooks]);
    }


    public function restore_books($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('books')->with('status', 'book restored');
    }

    public function getBooksByCategory(Request $request, $categoryID)
    {
        // Ambil hanya buku dengan status "available"
        $books = Book::whereHas('categories', function ($query) use ($categoryID) {
            $query->where('categories.id', $categoryID);
        })->where('status', 'in stock')->get();

        return response()->json($books);
    }





    public function detail_books($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $user = User::where('slug', $slug)->first();
        $categories = Category::all();
        // $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('detail_books', ['user' => $user, 'categories' => $categories,  'book' => $book]);
    }
}

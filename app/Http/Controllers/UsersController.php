<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function users()
    {

        $users = User::where('role_id', 2)->where('status', 'active')->get();
        // dd('ini halaman profile');
        return view('users', ['users' => $users]);
    }


    public function registered_users()
    {

        $registeredUser = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('registered_users', ['registeredUsers' => $registeredUser]);
    }


    public function detail_users($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('detail_users', ['user' => $user, 'rent_logs' => $rentlogs,  'book' => $book]);
    }


    public function delete_users($slug)
    {

        $user = User::where('slug', $slug)->first();
        return view('delete_users', ['user' => $user]);
    }


    public function destroy_users($slug)
    {
        $user = User::where('slug', $slug)->first();
        // $user->delete();
        if ($user->id_card) {
            Storage::delete('id_card/' . $user->id_card);
        }
        $user->forceDelete();
        return redirect('users')->with('status', 'user deleted');
    }

    public function deleted_users()
    {
        $deletedUsers = User::onlyTrashed()->get();
        return view('deleted_users', ['deletedUsers' => $deletedUsers]);
    }



    public function restore_users($slug)
    {


        $category = User::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('users')->with('status', 'Users Unbanned');
    }




    public function add_users()
    {
        $user = User::all();
        return view('add_users', ['users' => $user]);
    }


    public function store(Request $request)
    {
        //tabel yang mau diisi
        $validated = $request->validate([
            'username' => 'max:100',
            'nik' => 'max:16',
            'phone' => 'max:16',

        ]);
        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('id_card', $newName);
        }
        $request['id_card'] = $newName;
        $user = User::create($request->all());
        return redirect('users')->with('status', 'user added');
    }



    public function edit_users($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('edit_users', ['user' => $user]);
    }







    public function update_users(Request $request, $slug)
    {

        $user = User::where('slug', $slug)->first();
        // Validasi hanya jika ada perubahan pada username, nik, atau phone
        $validationRules = [
            'username' => 'max:100' . $user->id,
            'nik' => 'max:16' . $user->id,
            'phone' => 'max:16' . $user->id,

        ];

        // Periksa apakah ada perubahan pada username
        if ($request->username != $user->username) {
            $validationRules['username'] .= '|unique:users';
        }
        // Periksa apakah ada perubahan pada nik
        if ($request->nik != $user->nik) {
            $validationRules['nik'] .= '|unique:users';
        }
        // Periksa apakah ada perubahan pada phone
        if ($request->phone != $user->phone) {
            $validationRules['phone'] .= '|unique:users';
        }
        $user->slug = null;
        $user->update($request->all());


        if ($request->file('image')) {
            // Hapus gambar lama
            if ($user->id_card) {
                Storage::delete('id_card/' . $user->id_card);
            }

            // Upload gambar baru
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('id_card', $newName);

            $request['id_card'] = $newName;
        }


        $user = User::where('slug', $slug)->first();
        $user->update($request->all());
        // $validated = $request->validate($validationRules);



        return redirect('users')->with('status', 'user updated');
    }
}

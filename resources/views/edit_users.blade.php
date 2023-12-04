@extends('layouts.mainlayout')


@section('title', 'Edit user')


@section('content')
    <div>
        <form action="/edit_users/{{ $user->slug }}" method="post">


            @csrf
            <a href="/users" class="btn btn-primary btn-sm mb-2" style="margin-right: 10px;"><i
                class="fas fa-arrow-left"></i>
            Back</a>
            @method('put')
            <div class="form-group mt-5 w-50 " style="margin: auto;">
                @if ($errors->any())

                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <label>Name</label>

                <input value="{{ $user->username }}" type="text" name="username" class="form-control">
                <label>Phone</label>

                <input value="{{ $user->phone }}" type="text" name="phone" class="form-control">
                <div class="text-small text-danger"></div>
                <br>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"> Update</i> </button>
            </div>




            <!-- sini tambah -->


            {{-- <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"> Reset</i> </button> --}}
        </form>

        </>

    @endsection

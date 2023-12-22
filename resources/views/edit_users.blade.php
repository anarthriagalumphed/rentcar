@extends('layouts.mainlayout')

@section('title', 'Edit user')

@section('content')
    <div>
        <form action="/edit_users/{{ $user->slug }}" method="post" enctype="multipart/form-data">

            @csrf
            <a href="{{ route('detail_users', ['slug' => $user->slug]) }}" class="btn btn-primary btn-sm mb-2"
                style="margin-right: 10px;"><i class="fas fa-arrow-left"></i>
                Back</a>
            {{-- @method('put') --}}
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
                <label>Image</label>
                <input type="file" name="image" placeholder="insert name" id="image" class="form-control">
                <label class="form-label">Current Image</label><br>
                <div class="w-50">
                    @if ($user->id_card != '')
                        <img src="{{ asset('storage/id_card/' . $user->id_card) }}" alt="" width="100%">
                    @else
                        <img src="{{ asset('img/pp fix.png') }}" alt="" width="100%">
                    @endif
                    <br>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"> Update</i> </button>
                </div>
            </div>
        </form>
    </div>
@endsection

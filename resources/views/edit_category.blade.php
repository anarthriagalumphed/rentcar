@extends('layouts.mainlayout')

@section('title', 'Edit Category')

@section('content')
    <div>
        <form action="/edit_category/{{ $category->slug }}" method="post">
            @csrf
            <a href="/categories" class="btn btn-primary btn-sm mb-2" style="margin-right: 10px;"><i
                class="fas fa-arrow-left"></i>
            Back</a>
            @method('put')

            <div class="form-group mt-5 w-50" style="margin: auto;">
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
                <input value="{{ $category->name }}" type="text" name="name" placeholder="Insert name"
                    class="form-control">

                <div class="text-small text-danger"></div>
                <br>

                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-save"> Update</i>
                </button>
            </div>
        </form>
    </div>
@endsection

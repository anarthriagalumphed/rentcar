@extends('layouts.mainlayout')


@section('title', 'Add Car')


@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <div>
        <form action="add_books" method="post" enctype="multipart/form-data">
            @csrf
            <a href="/books" class="btn btn-primary btn-sm mb-2" style="margin-right: 10px;"><i class="fas fa-arrow-left"></i>
                Back</a>
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
                <label>Code</label>
                <input type="text" name="book_code" placeholder="insert code" id="code" class="form-control"
                    value="{{ old('book_code') }}">
                <br>
                <label>Nama Mobil</label>
                <input type="text" name="title" placeholder="insert car name" id="title" class="form-control"
                    value="{{ old('title') }}">
                <br>
                <label>Image</label>
                <input type="file" name="image" placeholder="insert name" id="image" class="form-control">
                <br>
                <label>Tahun Keluar</label>
                <input type="text" name="tahun_keluar" placeholder="insert year" id="tahun_keluar" class="form-control"
                    value="{{ old('tahun_keluar') }}">
                <br>
                <label>Category</label>
                <select name="categories[]" id="category" class="form-control select2-multiple" multiple="multiple">

                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach

                </select>
                <br>
                <br>
                <label>Harga</label>
                <input type="text" pattern="[0-9]+" name="price" placeholder="insert price" id="price"
                    class="form-control" value="{{ old('price') }}">

                <div class="text-small text-danger"></div>
                <br>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"> Save</i> </button>
            </div>




            <!-- sini tambah -->


            {{-- <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"> Reset</i> </button> --}}
        </form>


    @endsection

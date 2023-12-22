@extends('layouts.mainlayout')


@section('title', 'Add User')


@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <div>
        <form action="add_users" method="post" enctype="multipart/form-data">
            @csrf
            <a href="/users" class="btn btn-primary btn-sm mb-2" style="margin-right: 10px;"><i class="fas fa-arrow-left"></i>
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

                <label>Nama</label>
                <input type="text" name="username" placeholder="insert Name" id="username" class="form-control"
                    value="{{ old('username') }}">
                <label>NIK</label>
                <input type="text" name="nik" placeholder="insert NIK" id="nik" class="form-control"
                    value="{{ old('nik') }}">

                <label>Phone</label>
                <input type="text" name="phone" placeholder="insert Phone" id="phone" class="form-control"
                    value="+62 {{ old('phone') }}">
                <label>ID</label>
                <input type="file" name="image" placeholder="insert name" id="image" class="form-control">

                </select>



                <div class="text-small text-danger"></div>
                <br>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"> Save</i> </button>
            </div>




            <!-- sini tambah -->


            {{-- <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"> Reset</i> </button> --}}
        </form>


    @endsection

@extends('layouts.mainlayout')

@section('title', 'Categories')


@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card card-success">
        <div class="card-header">

            <h3 class="card-title">@yield('title')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">


                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}
                <br>
                <a href="add_category" class="btn btn-primary btn-sm mb-2" style="margin-right: 10px;"><i
                        class="fas fa-plus"></i>
                    Add
                    Category</a>
                <a href="deleted_category" class="btn btn-warning btn-sm mb-2" style="margin-right: 10px;"><i
                        class="fas fa-history"></i>
                    View Deleted
                    Data</a>
                <br>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>

                <!-- ini perlu diganti data => isi -->

                <!-- ini perlu diganti -->
                <tbody>
                    @foreach ($category as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="edit_category/{{ $item->slug }}" class="btn btn-warning btn-sm"
                                    title="edit category"><i class="fas fa-edit"></i></a>
                                <a href="delete_category/{{ $item->slug }}" class="btn btn-danger btn-sm"
                                    title="delete category"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection

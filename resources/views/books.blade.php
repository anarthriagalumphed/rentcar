@extends('layouts.mainlayout')

@section('title', 'Cars')


@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">

            <h3 class="card-title">@yield('title')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">

                {{-- 
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <br> --}}
                <a href="add_books" class="btn btn-primary btn-sm mb-2" style="margin-right: 10px;"><i class="fas fa-plus"></i>
                    Add
                    Cars</a>
                {{-- <a href="deleted_books" class="btn btn-warning btn-sm mb-2" style="margin-right: 10px;"><i
                        class="fas fa-history"></i>
                    View Deleted
                    Data</a> --}}
                <br>
                <tr>
                    <th>No.</th>
                    <th>Code</th>

                    <th>Title</th>
                    <th>Year</th>
                    <th>Category</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <!-- ini perlu diganti data => isi -->

                <!-- ini perlu diganti -->
                <tbody>
                    @foreach ($books as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->book_code }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->tahun_keluar }}</td>
                            <td>
                                @foreach ($item->categories as $category)
                                    {{ $category->name }}<br>
                                @endforeach
                            </td>
                            <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                {{-- <a href="/edit_books/{{ $item->slug }}" title="edit book"
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> --}}
                                <a href="/detail_books/{{ $item->slug }}" class="btn btn-warning btn-sm"><i
                                        title="view detail car"class="	fas fa-car"></i></a>
                                {{-- <a href="/delete_books/{{ $item->slug }}" title="delete book"
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                                <a href="#" data-toggle="modal" data-target="#deleteBookModal"
                                    data-book-title="{{ $item->title }}" data-book-slug="{{ $item->slug }}"
                                    class="btn btn-danger btn-sm delete-book"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="modal fade" id="deleteBookModal" tabindex="-1" role="dialog" aria-labelledby="deleteBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBookModalLabel">Are you sure to delete this User? <span
                            id="bookTitleToDelete"></span></h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                {{-- <div class="modal-body">
                    <!-- You can add additional information here -->
                </div> --}}
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger confirm-delete"><i class="fas fa-trash"></i>Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


@endsection
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- Memuat Bootstrap JS (Jangan lupa tentang Popper.js) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-book').click(function() {
            var bookTitle = $(this).data('book-title');
            var bookSlug = $(this).data('book-slug');

            $('#bookTitleToDelete').text(bookTitle);
            $('.confirm-delete').attr('href', '/destroy_books/' + bookSlug);
        });
    });
</script>

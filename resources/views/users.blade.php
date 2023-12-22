@extends('layouts.mainlayout')

@section('title', 'Users')


@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card card-warning">
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
                {{-- <a href="/deleted_users" class="btn btn-primary btn-sm mb-2" style="margin-right: 10px;"><i class=""></i>
                    View Banned Users</a> --}}
                <a href="/add_users" class="btn btn-success btn-sm mb-2" style="margin-right: 10px;"><i
                        class="fas fa-plus"></i>
                    Add
                    User</a>
                {{-- <a href="/edit_users" class="btn btn-warning btn-sm mb-2" style="margin-right: 10px;"><i
                        class="fas fa-pen"></i>
                    Edit User</a> --}}
                <br>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>

                <!-- ini perlu diganti data => isi -->

                <!-- ini perlu diganti -->
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>
                                {{ $item->phone }} </td>
                            <td>
                                {{-- <a href="edit_users/{{ $item->slug }}" class="btn btn-primary btn-sm"><i
                                        title="view detail user"class="	fas fa-address-card"></i></a> --}}
                                <a href="detail_users/{{ $item->slug }}" class="btn btn-warning btn-sm"><i
                                        title="view detail user"class="	fas fa-address-card"></i></a>
                                {{-- <a href="delete_users/{{ $item->slug }}" class="btn btn-danger btn-sm"><i
                                        title="ban user"class="fas fa-trash"></i></a> --}}
                                <a href="#"data-toggle="modal" data-target="#deleteUserModal{{ $item->id }}"
                                    data-user-title="{{ $item->username }}" data-user-slug="{{ $item->slug }}"
                                    class="btn btn-danger btn-sm delete-user"><i title="ban user"
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection


@foreach ($users as $item)
    <!-- ... (bagian table di atas) ... -->

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteUserModal{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="deleteUserModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel{{ $item->id }}">Are you sure to delete this
                        User?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <div class="modal-body">
                    <p>Anda yakin ingin menghapus pengguna dengan username {{ $item->username }}?</p>
                </div> --}}
                <div class="modal-footer">
                    <a href="destroy_users/{{ $item->slug }}" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>


    @foreach ($users as $item)
        <!-- ... (bagian table di atas) ... -->

        <!-- Modal Konfirmasi Hapus User -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">Are you sure to delete this book? <span
                                id="userTitleToDelete"></span></h5>
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
    @endforeach
@endforeach
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- Memuat Bootstrap JS (Jangan lupa tentang Popper.js) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-user').click(function() {
            var bookTitle = $(this).data('book-title');
            var bookSlug = $(this).data('book-slug');

            $('#userTitleToDelete').text(bookTitle);
            $('.confirm-delete').attr('href', '/destroy_users/' + bookSlug);
        });
    });
</script>

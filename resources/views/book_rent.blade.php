@extends('layouts.mainlayout')

@section('title', 'Car Rent')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    @if (session('message'))
        <div class="alert {{ session('alert-class') }}">
            {{ session('message') }}
        </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
                    <!-- general form elements -->
                    <div class="card card-white">
                        <div class="card-header">
                            <h3 class="card-title">Car Rent</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="book_rent" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputuser">User</label>
                                    <select name="user_id" type="user" class="form-control userbox" id="inputuser"
                                        placeholder="Enter User">
                                        <option value="" disabled selected>Select User</option>
                                        @foreach ($users as $item)
                                            @if ($item->role_id != 1)
                                                <option value="{{ $item->id }}">{{ $item->username }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="inputcategory">Category</label>
                                    <select name="category_id" class="form-control" id="inputcategory" required>
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="form-group">
                                    <label for="inputbook">Car</label>
                                    <select name="book_ids[]" class="form-control select2-multiple" multiple="multiple"
                                        id="inputbook" placeholder="Enter Book Title">
                                        <option value="" disabled>Select Car</option>
                                        @foreach ($books as $item)
                                            @php
                                                // Dapatkan nama kategori dari relasi many-to-many
                                                $categories = $item->categories->pluck('name')->implode(', ');
                                            @endphp
                                            <option value="{{ $item->id }}" data-category="{{ $categories }}">
                                                {{ $item->book_code }} | {{ $item->title }} ({{ $categories }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="rent_date">Rent Date</label>
                                    <input type="date" name="rent_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="return_date">Return Date</label>
                                    <input type="date" name="return_date" class="form-control" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ini adalah kode terakhir yang work --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Script untuk pemilihan kategori dan mendapatkan buku berdasarkan kategori
        $(document).ready(function() {
            // Inisialisasi Select2 pada dokumen dimuat
            $('.userbox').select2();
            $('#inputbook').select2({
                multiple: true
            });

            // Event ketika kategori berubah
            $('#inputcategory').change(function() {
                var categoryID = $(this).val();

                // Memanggil endpoint untuk mendapatkan buku berdasarkan kategori
                $.ajax({
                    url: '/books-by-category/' + categoryID,
                    type: 'GET',
                    success: function(data) {
                        // Kosongkan opsi buku yang ada
                        $('#inputbook').empty();

                        // Tambahkan opsi buku baru berdasarkan data yang diterima
                        $.each(data, function(index, book) {
                            $('#inputbook').append('<option value="' + book.id + '">' +
                                book.book_code + ' | ' + book.title + '</option>');
                        });

                        // Trigger event select2:select untuk mempertahankan buku yang dipilih sebelumnya
                        $('#inputbook').trigger('select2:select');
                    },
                    error: function(error) {
                        // Tampilkan pesan error
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection

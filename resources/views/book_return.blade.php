@extends('layouts.mainlayout')

@section('title', 'Car Return')

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
                <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Car Return</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="book_return" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputuser">User</label>
                                    <select name="user_id" type="user" class="form-control userbox" id="inputuser"
                                        placeholder="Enter User">
                                        <option value="" disabled selected>Select User</option>
                                        @foreach ($users as $user)
                                            @php
                                                $userBooks = $user
                                                    ->rentLogs()
                                                    ->whereNull('actual_return_date')
                                                    ->pluck('book_id')
                                                    ->toArray();
                                            @endphp
                                            @if ($user->role_id != 1 && count($userBooks) > 0)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputbook">Car</label>
                                    <select name="book_ids[]" type="book" class="form-control select2-multiple"
                                        multiple="multiple" id="inputbook" placeholder="Enter Book Title">
                                        <option value="" disabled>Select Car</option>
                                        <!-- ... (options loop) -->
                                    </select>
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
        $(document).ready(function() {
            $('.userbox').select2();

            // Inisialisasi Select2 pada dokumen dimuat
            $('#inputuser').select2();

            // Event ketika pengguna berubah
            $('#inputuser').on('select2:select', function(e) {
                // Kosongkan pilihan buku
                $('#inputbook').empty();

                // Ambil ID pengguna yang dipilih
                let userID = e.params.data.id;

                if (userID) {
                    $('#inputbook').select2({
                        allowClear: true,
                        width: '100%',
                        ajax: {
                            url: '{{ route('admin.selectState') }}?userID=' + userID,
                            dataType: 'json',
                            delay: 250,
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            text: item.book_code + ' | ' + item.title,
                                            id: item.id
                                        }
                                    })
                                };
                            }
                        }
                    });
                } else {
                    $('#inputbook').empty();
                }
            });
        });
    </script>
@endsection

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.rtl.min.css">
    <link rel="shortcut icon" href="{{ asset('img/icon.ico') }}">

    <title>Perpustakaan</title>
</head>

<body>
    <h1 class="text-center mb-4">Buku</h1>

    <div class="container">
        <a href="/addbuku" type="button" class="btn btn-success">add</a>
        <div class="row">
            @if ($message = Session::get('sukses'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Jumlah Halaman</th>
                        <th scope="col">sinopsis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <th scope="row">{{ $row->id }}</th>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->writer }}</td>
                            <td>{{ $row->publisher }}</td>
                            <td>{{ date(' Y', strtotime($row->publication_year)) }}</td>
                            <td>{{ $row->number_of_pages }}</td>
                            <td>{{ $row->summary }}</td>
                            <td>
                                <button type="button" class="btn btn-warning">edit</button>
                                <button type="button" class="btn btn-danger">delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

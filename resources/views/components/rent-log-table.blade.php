<div class="card card-danger" onclick="window.location='{{ route('rent_logs') }}'">
    <div class="card-header">

        <h3 class="card-title">Rent Logs</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">

            <a href="#" class="btn btn-success btn-sm mb-2" style="margin-right: 10px;"><i>Rekap</i></a>
            <br>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Cars</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                {{-- <th>Action</th> --}}
                {{-- <th></th> --}}
            </tr>

            <!-- ini perlu diganti data => isi -->

            <!-- ini perlu diganti -->
            <tbody>

                @foreach ($rentlog as $item)
                    <tr class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'bg-danger' : 'bg-success') }}"
                        style="opacity: 0.7;">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->user)
                                {{ $item->user->username }}
                            @else
                                User Banned
                            @endif
                        </td>
                        <td>
                            @if ($item->book)
                                {{ $item->book->title }}
                            @else
                                Book Deleted
                            @endif
                        </td>
                        <td>{{ $item->rent_date }}</td>
                        <td>{{ $item->return_date }}</td>
                        {{-- <td></td> --}}
                    </tr>
                @endforeach


            </tbody>

        </table>
    </div>
</div>

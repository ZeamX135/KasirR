<div class="p-2 row">
    <div class="col-md-12">
        <div class="card">
            <div class="p-3 card-title">
                <div class="card-body">

                    <h5><b>{{ $title }}</b></h5>

                    <table class="table">
                        <a href="/admin/transaksi/create" class="mb-2 btn btn-primary"><i class="fas fa-plus"></i>
                            Tambah</a>
                        <tr>
                            <th>No</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/transaksi/{{ $t->id }}/edit"
                                            class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                        {{-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                                        <form action="/admin/transaksi/{{ $t->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="ml-1 btn btn-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

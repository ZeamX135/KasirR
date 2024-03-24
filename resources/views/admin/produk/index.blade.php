<div class="row p-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-title p-3">
                <div class="card-body">

                    <h5><b>{{ $title }}</b></h5>

                    <table class="table">
                        <a href="/admin/produk/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>
                            Tambah</a>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($produk as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->kategori->name }}</td>
                                <td>{{ $p->harga }}</td>
                                <td>{{ $p->stok }}</td>
                                <td>
                                    @isset($p)
                                        <img src="/{{ $p->gambar }}" width="100px" alt="">
                                    @endisset
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/produk/{{ $p->id }}/edit" class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>
                                        {{-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                                        <form action="/admin/produk/{{ $p->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm ml-1"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

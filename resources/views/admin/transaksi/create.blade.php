<div class="row p-2">

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">

                <div class="row mt-1">
                    <div class="col-md-4">
                        <label for="">Kode Produk</label>
                    </div>
                    <div class="col-md-8">
                        <form method="GET">
                            <div class="d-flex">
                                <select name="produk_id" class="form-control mr-1" id="">
                                    <option value="">
                                        -- {{ isset($p_detail) ? $p_detail->name : 'Pilih Produk' }} --</option>
                                    @foreach ($produk as $p)
                                        <option value="{{ $p->id }}">{{ $p->id . ' - ' . $p->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="/admin/transaksi/detail/create" method="POST">
                    @csrf

                    <input type="hidden" name="transaksi_id" value="{{ Request::segment(3) }}">
                    <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                    <input type="hidden" name="produk_name" value="{{ isset($p_detail) ? $p_detail->name : '' }}">
                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($p_detail) ? $p_detail->name : '' }}"
                                class="form-control" disabled name="nama_produk">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">Harga Satuan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($p_detail) ? $p_detail->harga : '' }}"
                                class="form-control" disabled name="harga_satuan">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}"
                                    class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                <input type="number" value="{{ $qty }}" class="form-control ml-1 mr-1"
                                    name="qty">
                                <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}"
                                    class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <h5>Subtotal : Rp. {{ format_rupiah($subtotal) }}</h5>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-8">
                            <a href="/admin/transaksi" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah <i
                                    class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>QTY</th>
                        <th>Subtotal</th>
                        <th>#</th>
                    </tr>

                    @foreach ($transaksi_detail as $td)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $td->produk_name }}</td>
                            <td>{{ $td->qty }}</td>
                            <td>{{ 'Rp. ' . format_rupiah($td->subtotal) }}</td>
                            <td>
                                <a href="/admin/transaksi/detail/delete?id={{ $td->id }}"><i
                                        class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <div class="mt-2">
                    <a href="/admin/transaksi/detail/selesai/{{ Request::segment(3) }}" class="btn btn-success"><i
                            class="fas fa-check"></i> Selesai</a>
                    <a href="" class="btn btn-info"><i class="fas fa-clock"></i> Pending</a>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row p-1">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">

                <form action="" method="GET">
                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input type="number" value="{{ $transaksi->total }}" name="total_belanja"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="number" name="dibayarkan" value="{{ request('dibayarkan') }}"
                            class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Hitung</button>
                </form>

                <hr>

                <div class="form-group">
                    <label for="">Kembalian</label>
                    <input type="number" value="{{ format_rupiah($kembalian) }}" disabled name="kembalian"
                        class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>

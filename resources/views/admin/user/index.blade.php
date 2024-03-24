<div class="pt-2 container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h5><b>{{ $title }}</b></h5>

                    <a href="/admin/user/create" class="btn btn-primary"><i class="fas fa-plus">Tambah</i></a>

                    @if (session()->has('success'))
                        <div class="mt-2 alert alert-success"><i class="fas fa-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table mt-1">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($user as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->usertype }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/user/{{ $u->id }}/edit" class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>
                                        {{-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                                        <form action="/admin/user/{{ $u->id }}" method="POST">
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
                </div>
            </div>
        </div>
    </div>
</div>

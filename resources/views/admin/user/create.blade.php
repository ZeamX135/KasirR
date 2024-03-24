<div class="pt-2 container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>Tambah Data</b></h4>

                    @isset($user)
                        <form action="/admin/user/{{ $user->id }}" method="POST">
                            @method('PUT')
                        @else
                            <form action="/admin/user" method="POST">
                            @endisset
                            @csrf
                            <div class="form-group">
                                <label for=""><b>Nama Lengkap</b></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nama Lengkap"
                                    value="{{ isset($user) ? $user->name : '' }}">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for=""><b>Email</b></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email" value="{{ isset($user) ? $user->email : '' }}">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for=""><b>Password</b></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for=""><b>Konfirmasi Password</b></label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" placeholder="Konfirmasi Password">

                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for=""><b>Role</b></label>
                                <select class="form-control" name="usertype">
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>

                            <a href="/admin/user" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

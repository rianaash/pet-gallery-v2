<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manajemen User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="icon fas fa-check"></i> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Data Pengguna Terdaftar</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input wire:model.live.debounce.300ms="search" type="text" class="form-control float-right" placeholder="Cari Nama / Email...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Bergabung</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&size=64" 
                                             class="img-circle elevation-1 mr-2" 
                                             style="width: 32px; height: 32px;">
                                        <span class="font-weight-bold">{{ $user->name }}</span>
                                    </div>
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge badge-danger">Administrator</span>
                                    @else
                                        <span class="badge badge-success">User Biasa</span>
                                    @endif
                                </td>

                                <td>{{ $user->created_at->format('d M Y') }}</td>

                                <td class="text-center">
                                    @if($user->id !== auth()->id())
                                        <button wire:click="deleteUser({{ $user->id }})"
                                                wire:confirm="Yakin mau hapus user {{ $user->name }}? Semua foto miliknya akan hilang!"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <span class="badge badge-secondary">Akun Saya</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-users-slash fa-3x mb-3"></i><br>
                                    User tidak ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
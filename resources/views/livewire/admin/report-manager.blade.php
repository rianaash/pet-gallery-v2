<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="icon fas fa-check"></i> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Daftar Laporan Masuk</h3>
                    
                    <div class="card-tools">
                        <span class="badge badge-warning">{{ $reports->where('status', 'pending')->count() }} Pending</span>
                    </div>
                </div>
                
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 15%">Foto</th>
                                <th style="width: 20%">Pelapor</th>
                                <th style="width: 25%">Masalah</th>
                                <th style="width: 15%">Status</th>
                                <th style="width: 25%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                            <tr>
                                <td class="align-middle">
                                    @if($report->photo)
                                
                                        <a href="{{ asset('storage/' . $report->photo->image_url) }}">
                                            <img src="{{ asset('storage/app/public/photos/' . $report->photo->image_url) }}" 
                                                 alt="Evidence" 
                                                 class="img-thumbnail" 
                                                 style="height: 60px; width: 60px; object-fit: cover;">
                                        </a>
                                        <div class="small text-muted mt-1">
                                            <i class="fas fa-user-edit"></i> {{ $report->photo->user->name ?? '' }}
                                        </div>
                                    
                                    @endif
                                </td>

                                <td class="align-middle">
                                    <strong>{{ $report->reporter->name ?? 'User Hilang' }}</strong><br>
                                    <small class="text-muted">
                                        <i class="far fa-clock"></i> {{ $report->created_at->diffForHumans() }}
                                    </small>
                                </td>

                                <td class="align-middle">
                                    @php
                                        $badgeColor = match($report->reason) {
                                            'Spam' => 'badge-info',
                                            'Inappropriate' => 'badge-danger',
                                            'Stolen' => 'badge-purple', // Kalau gapunya custom css, ini bakal fallback
                                            default => 'badge-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeColor }}">{{ $report->reason }}</span>
                                    
                                    @if($report->description)
                                        <div class="mt-1 text-muted small font-italic" style="white-space: normal;">
                                            "{{ Str::limit($report->description, 50) }}"
                                        </div>
                                    @endif
                                </td>

                                <td class="align-middle">
                                    @if($report->status == 'pending')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($report->status == 'resolved')
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-secondary">Diabaikan</span>
                                    @endif
                                </td>

                                <td class="align-middle text-center">
                                    @if($report->status == 'pending')
                                        <div class="btn-group">
                                            <button wire:click="dismissReport({{ $report->id }})" 
                                                    class="btn btn-default btn-sm"
                                                    title="Abaikan Laporan">
                                                <i class="fas fa-times"></i> Abaikan
                                            </button>

                                            <button wire:click="deletePhoto({{ $report->id }})" 
                                                    wire:confirm="Yakin ingin menghapus foto ini? Tindakan tidak bisa dibatalkan."
                                                    class="btn btn-danger btn-sm"
                                                    title="Hapus Foto & Terima Laporan">
                                                <i class="fas fa-trash"></i> Hapus Foto
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted"><i class="fas fa-check-circle"></i> Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i><br>
                                    Belum ada laporan baru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    </div>
            </div>
            </div>
    </section>
</div>
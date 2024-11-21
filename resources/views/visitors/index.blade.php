@extends('layouts.app')

@section('title', 'Dashboard Pengunjung')

@section('content')
<div class="container">
    <!-- Dashboard Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Pengunjung Hari Ini</h5>
                    <h2 class="card-text">{{ $todayVisitors }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Pengunjung Bulan Ini</h5>
                    <h2 class="card-text">{{ $monthlyVisitors }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Pengunjung Aktif</h5>
                    <h2 class="card-text">{{ $activeVisitors }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('visitors.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama/ID..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control" 
                           value="{{ request('date') }}">
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Visitors List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengunjung</h5>
            <a href="{{ route('visitors.create') }}" class="btn btn-primary">Tambah Pengunjung</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>ID Anggota</th>
                        <th>Tujuan</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitors as $visitor)
                    <tr>
                        <td>{{ $visitor->name }}</td>
                        <td>{{ $visitor->member_id }}</td>
                        <td>{{ $visitor->purpose }}</td>
                        <td>{{ $visitor->check_in->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($visitor->check_out)
                                {{ $visitor->check_out->format('d/m/Y H:i') }}
                            @else
                                <form action="{{ route('visitors.checkout', $visitor) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-warning">Check Out</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('visitors.edit', $visitor) }}" 
                               class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('visitors.destroy', $visitor) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Yakin hapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Data pengunjung tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
           <div class="d-flex justify-content-center">
               {{ $visitors->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

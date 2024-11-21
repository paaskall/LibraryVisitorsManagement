@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Statistik Pengunjung (7 Hari Terakhir)</div>
                <div class="card-body">
                    <canvas id="dailyVisitorChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Tujuan Kunjungan</div>
                <div class="card-body">
                    <canvas id="purposeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan console.log untuk debugging
    console.log('Daily Visitors:', @json($dailyVisitors));
    console.log('Purpose Stats:', @json($purposeStats));

    // Grafik Pengunjung Harian
    if (document.getElementById('dailyVisitorChart')) {
        new Chart(document.getElementById('dailyVisitorChart'), {
            type: 'bar',
            data: {
                labels: [
                    @foreach($dailyVisitors as $data)
                        '{{ $data->date }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: [
                        @foreach($dailyVisitors as $data)
                            {{ $data->total }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Grafik Tujuan Kunjungan
    if (document.getElementById('purposeChart')) {
        new Chart(document.getElementById('purposeChart'), {
            type: 'pie',
            data: {
                labels: [
                    @foreach($purposeStats as $data)
                        '{{ $data->purpose }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($purposeStats as $data)
                            {{ $data->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    }
});
</script>
@endpush
@endsection

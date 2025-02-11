@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Grafik Omset Tahunan</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>THN</th>
                <th>JANUARI</th>
                <th>FEBRUARI</th>
                <th>MARET</th>
                <th>APRIL</th>
                <th>MEI</th>
                <th>JUNI</th>
                <th>JULI</th>
                <th>AGUSTUS</th>
                <th>SEPTEMBER</th>
                <th>OKTOBER</th>
                <th>NOVEMBER</th>
                <th>DESEMBER</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $year => $months)
                <tr>
                    <td>{{ $year }}</td>
                    @php $total = 0; @endphp
                    @for ($month = 1; $month <= 12; $month++)
                        @php 
                            $omset = $months[$month] ?? 0;
                            $total += $omset;
                        @endphp
                        <td>Rp {{ number_format($omset, 0, ',', '.') }}</td>
                    @endfor
                    <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

 {{-- Grafik Omset Tahunan --}}
 <h2 class="mt-5">Grafik Omset Tahunan</h2>
        <canvas id="chartOmset"></canvas>
    </div>

    <script type="module" src="{{ asset('js/chart.js') }}"></script>


    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('chartOmset').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar', // Bisa 'line', 'bar', 'pie'
            data: {
                labels: json($labels),
                datasets: [{
                    label: 'Total Omset',
                    data: json($totalPerTahun),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
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
    </script>
@endsection
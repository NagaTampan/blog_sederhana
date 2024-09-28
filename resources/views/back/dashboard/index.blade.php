@extends('back.layout.template')
@section('title', 'Dashboard - Admin')

@section('content')
{{-- Content --}}
<main class="col-md-9 ms-sm-auto col-lg-11 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('myChart').getContext('2d');

        // Mendapatkan data dari server
        const titles = @json($articles->pluck('title')->map(function($title) {
            return strlen($title) > 15 ? substr($title, 0, 15) . '...' : $title;
        }));

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: titles, // Menggunakan judul yang sudah dipotong
                datasets: [{
                    label: 'Views',
                    data: @json($articles->pluck('views')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        ticks: {
                            autoSkip: false, // Menghindari pengabaian label
                            maxRotation: 45, // Memutar label maksimal 45 derajat
                            minRotation: 45 // Memutar label minimal 45 derajat
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

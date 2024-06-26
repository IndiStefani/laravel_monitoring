{{-- row atas --}}

<div class="col-md-8">
    <p class="text-center">
        <strong id="yearText">Realisasi Tahun: {{ date('Y') }}</strong>
    </p>
    <!-- chart-->
    <div class="chart">
        <canvas id="line-serapan"></canvas>
    </div>
    <!-- end-->
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const target = @json($target);
            const realisasi = @json($realisasi);

            const ctx = document.getElementById('line-serapan').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                        'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                        label: 'Target per Bulan',
                        data: target,
                        backgroundColor: 'rgba(251, 135, 0, 1)',
                        borderColor: 'rgba(251, 135, 0, 1)',
                        borderWidth: 1,
                        fill: true,
                        tension: 0.5,
                        order: 1
                    }, {
                        label: 'Realisasi per Bulan',
                        data: realisasi,
                        backgroundColor: 'rgba(0, 128, 0, 1)',
                        borderColor: 'rgba(0, 128, 0, 1)',
                        borderWidth: 1,
                        fill: true,
                        tension: 0.5,
                        order: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 15,
                                padding: 20
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush

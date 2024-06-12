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
        fetch('/api/serapan-anggaran')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('line-serapan').getContext('2d');
                const lineSerapanChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                            'September', 'October', 'November', 'December'
                        ],
                        datasets: [{
                            label: 'Target per Bulan',
                            data: data.target,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Realisasi per Bulan',
                            data: data.realisasi,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
@endpush

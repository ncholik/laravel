{{-- row atas --}}

<div class="col-md-8">
    <!-- chart-->
    <div class="chart">
        <canvas id="line-serapan" style="width: 100%; height:450px"></canvas>
    </div>
    <!-- end-->
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const target = @json($target);
            const realisasi = @json($realisasi);

            const ctx = document.getElementById('line-serapan').getContext('2d');

            const customLegendPlugin = {
                id: 'customLegendPlugin',
                afterDatasetsDraw(chart, args, options) {
                    const legendContainer = chart.legend.legendItems;
                    legendContainer.sort((a, b) => {
                        if (a.text === 'Realisasi Keuangan') return 1;
                        if (b.text === 'Realisasi Keuangan') return -1;
                        return 0;
                    });
                }
            };

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                        'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                        label: 'Target Keuangan',
                        data: target,
                        backgroundColor: 'rgba(0, 159, 255, 1)',
                        borderColor: 'rgba(0, 159, 255, 1)',
                        borderWidth: 1,
                        fill: true,
                        tension: 0.5,
                        order: 1
                    }, {
                        label: 'Realisasi Keuangan',
                        data: realisasi,
                        backgroundColor: 'rgba(0, 150, 0, 1)',
                        borderColor: 'rgba(0, 150, 0, 1)',
                        borderWidth: 1,
                        fill: true,
                        tension: 0.5,
                        order: 0
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
                },
                plugins: [customLegendPlugin]
            });
        });
    </script>
@endpush

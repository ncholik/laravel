{{-- chart serapan --}}

<div class="col-md-12">
    <div class="chart">
        <!-- Sales Chart Canvas -->
        <canvas id="serapan" style="max-height: 300px; max-width: 100%;"></canvas>
    </div>
</div>

@push('js')
    {{-- chart serapan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('serapan').getContext('2d');
            var serapan = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        'Diserap',
                        'Belum diserap'
                    ],
                    datasets: [{
                        label: 'Persentase',
                        data: @json($data),
                        backgroundColor: [
                            '#28a745',
                            '#ff0e0e'
                        ],
                        borderColor: [
                            'white',
                            'white'
                        ],
                        borderRadius: 5,
                        borderWidth: 2,
                        hoverOffset: 20
                    }]
                },
                options: {
                    responsive: true,
                    // maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let value = tooltipItem.raw;
                                    return `${tooltipItem.label}: ${value.toFixed(1)}%`;
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 15,
                                padding: 20
                            }
                        },
                        subtitle: {
                            display: true,
                            text: 'SERAPAN ANGGARAN',
                            padding: 10
                        }
                    }
                }
            });
        });
    </script>
@endpush

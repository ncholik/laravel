{{-- chart serapan --}}

<div class="col-md-7">
    <div class="chart">
        <!-- Sales Chart Canvas -->
        <canvas id="doughnut" style="max-height: 300px; max-width: 100%;"></canvas>
    </div>
</div>

{{-- info anggaran --}}
<div class="col-md-5">
    <div class="card border-danger mb-2" style="width: 300px;">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h6>TOTAL ANGGARAN</h6>
            <h4 class="card-text text-danger"><b>Rp.
                    {{ number_format($total_perencanaan, 0, ',', '.') }}</b></h4>
        </div>
    </div>

    <div class="card border-success mb-2" style="width: 300px;">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h6 class="card-title">TOTAL SERAPAN</h6>
            <h4 class="card-text text-success"><b>Rp.
                    {{ number_format($total_realisasi, 0, ',', '.') }}</b></h4>
        </div>
    </div>

    <div class="card border-warning mb-2" style="width: 300px;">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h6 class="card-title">SISA ANGGARAN</h6>
            <h4 class="card-text text-warning"><b>Rp.
                    {{ number_format($total_perencanaan - $total_realisasi, 0, ',', '.') }}</b>
            </h4>
        </div>
    </div>
</div>
{{-- end --}}

@push('js')
    {{-- chart doughnut --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('doughnut').getContext('2d');
            var doughnutChart = new Chart(ctx, {
                type: 'doughnut',
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

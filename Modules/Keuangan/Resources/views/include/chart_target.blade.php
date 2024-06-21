{{-- chart target --}}
@push('js')
{{-- chart target dan realisasi keuangan --}}
<script>
    var ctxVisitors = document.getElementById('visitors-chart').getContext('2d');
    var visitorsChart = new Chart(ctxVisitors, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Visitors',
                data: [65, 59, 80, 81, 56, 55, 40],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
@endpush

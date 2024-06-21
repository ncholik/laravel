{{-- chart realisasi fisik --}}
@push('js')
{{-- realisasi fisik --}}
<script>
    var ctxSales = document.getElementById('sales-chart').getContext('2d');
    var salesChart = new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Sales',
                data: [28, 48, 40, 19, 86, 27, 90],
                borderColor: 'rgba(153, 102, 255, 1)',
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

<div class="col-md-12">
    <div class="position-relative mb-4">
        <canvas id="myBarChart" height="100px"></canvas>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myBarChart').getContext('2d');
            const myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Realisasi',
                        data: [12, 19, 3, 5, 2, 3, 9],
                        backgroundColor: 'rgba(0, 159, 255, 1)',
                        borderColor: 'rgba(0, 159, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Perencanaan',
                        data: [15, 10, 5, 2, 20, 30, 45],
                        backgroundColor: 'rgba(0, 150, 0, 1)',
                        borderColor: 'rgba(0, 150, 0, 1)',
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

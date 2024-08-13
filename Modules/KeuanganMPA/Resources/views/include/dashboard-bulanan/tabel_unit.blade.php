{{-- tabel tertinggi dan terendah --}}

<div class="col-lg-12">
    <div class="btn-group" role="group" aria-label="Table toggles">
        <button type="button" class="btn btn-success" id="btn-table-1">5 Unit
            Tertinggi</button>
        <button type="button" class="btn btn-outline-success" id="btn-table-2">5 Unit
            Terendah</button>
    </div>

    <div id="table-1" class="table-responsive">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead class="bg-success">
                        <tr>
                            <th>Unit Serapan Tertinggi</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topUnits as $unit)
                            <tr>
                                <td>{{ $unit['nama'] }}</td>
                                <td>
                                    Rp. {{ number_format($unit['total_pagu'], 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp. {{ number_format($unit['total_realisasi'], 0, ',', '.') }}
                                </td>
                                <td>{{ number_format($unit['percentage'], 2) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="table-2" class="table-responsive">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead class="bg-success">
                        <tr>
                            <th>Unit Serapan Tertinggi</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bottomUnits as $unit)
                            <tr>
                                <td>{{ $unit['nama'] }}</td>
                                <td>
                                    Rp. {{ number_format($unit['total_pagu'], 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp. {{ number_format($unit['total_realisasi'], 0, ',', '.') }}
                                </td>
                                <td>{{ number_format($unit['percentage'], 2) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    {{-- tabel unit --}}
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const table1 = document.getElementById('table-1');
            const table2 = document.getElementById('table-2');
            const btnTable1 = document.getElementById('btn-table-1');
            const btnTable2 = document.getElementById('btn-table-2');

            table1.style.display = 'block';
            table2.style.display = 'none';

            btnTable1.addEventListener('click', () => {
                table1.style.display = 'block';
                table2.style.display = 'none';
                btnTable1.classList.add('btn-success');
                btnTable1.classList.remove('btn-outline-success');
                btnTable2.classList.add('btn-outline-success');
                btnTable2.classList.remove('btn-success');
            });

            btnTable2.addEventListener('click', () => {
                table1.style.display = 'none';
                table2.style.display = 'block';
                btnTable1.classList.add('btn-outline-success');
                btnTable1.classList.remove('btn-success');
                btnTable2.classList.add('btn-success');
                btnTable2.classList.remove('btn-outline-success');
            });
        });
    </script>
@endpush

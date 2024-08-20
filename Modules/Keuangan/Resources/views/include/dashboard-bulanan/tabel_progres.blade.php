<!-- progres-->
<div class="col-md-4">
    <div class="table-responsive table-sm ">
        <table class="table table-striped table-earning">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th class="text-center">Persentase(%)</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 12; $i++)
                    <tr>
                        <td>{{ $namaBulan[$i] }}</td>
                        <td class="text-center">{{ number_format($persentasePerBulan[$i] ?? 0, 2) }}%</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

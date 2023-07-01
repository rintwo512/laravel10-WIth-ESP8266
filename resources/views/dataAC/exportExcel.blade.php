

<table>
    <thead>
    <tr>
        <th>No.</th>
        <th>Assets</th>
        <th>Wing</th>
        <th>Lantai</th>
        <th>Ruangan</th>
        <th>Merk</th>
        <th>Type</th>
        <th>Paard Kracht(PK)</th>
        <th>Status</th>
        <th>Kerusakan</th>
        <th>TGL Pemasangan</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dataExport as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->assets }}</td>
            <td>{{ $data->wing }}</td>
            <td>{{ $data->lantai }}</td>
            <td>{{ $data->ruangan }}</td>
            <td>{{ $data->merk }}</td>
            <td>{{ $data->type }}</td>
            <td>{{ $data->kapasitas }}</td>
            @if ($data->status == 'Rusak')
            <td style="background: red">{{ $data->status }}</td>
            @else
            <td style="background: green">{{ $data->status }}</td>
            @endif
            <td>{{ $data->kerusakan }}</td>
            <td>{{ $data->tgl_pemasangan }}</td>
            <td>{{ $data->catatan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

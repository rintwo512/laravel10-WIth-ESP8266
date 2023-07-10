@extends('layout.main')


@section('content')

@php
    use Illuminate\Support\Carbon;
@endphp

<a href="{{ url('/ac') }}" class="mb-2 text-uppercase btn btn-primary btn-sm"><i class="bi bi-arrow-bar-left"></i> Back</a>
    <div class="card">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">ID : <strong>{{ $data->label }}</strong></li>
                <li class="list-group-item">Asset : <strong>{{ $data->assets }}</strong></li>
                <li class="list-group-item">Wing : <strong>{{ $data->wing }}</strong></li>
                <li class="list-group-item">Lantai : <strong>{{ $data->lantai }}</strong></li>
                <li class="list-group-item">Lokasi : <strong>{{ $data->ruangan }}</strong></li>
                <li class="list-group-item">Merk : <strong>{{ $data->merk }}</strong></li>
                <li class="list-group-item">Type : <strong>{{ $data->type }}</strong></li>
                <li class="list-group-item">Jenis : <strong>{{ $data->jenis }}</strong></li>
                <li class="list-group-item">Product : <strong>{{ $data->product }}</strong></li>
                <li class="list-group-item">Kapasitas : <strong>{{ $data->kapasitas }}</strong></li>
                <li class="list-group-item">Amper : <strong>{{ $data->current }}</strong></li>
                <li class="list-group-item">Voltage : <strong>{{ $data->voltage }}</strong></li>
                <li class="list-group-item">Btu : <strong>{{ $data->btu }}</strong></li>
                <li class="list-group-item">Refrigerant : <strong>{{ $data->refrigerant }}</strong></li>
                <li class="list-group-item">Pipa Liquid + Gas : <strong>{{ $data->pipa }}</strong></li>
                <li class="list-group-item">No Seri Indoor : <strong>{{ $data->seri_indoor }}</strong></li>
                <li class="list-group-item">No Seri Outdoor : <strong>{{ $data->seri_outdoor }}</strong></li>
                <li class="list-group-item">Tanggal Pemasangan : <strong>{{ $data->tgl_pemasangan }} / {{ Carbon::parse($data->tgl_pemasangan)->diffForHumans() }}</strong></li>
                <li class="list-group-item">Petugas Pemasangan : <strong>{{ $data->petugas_pemasangan }}</strong></li>
                <li class="list-group-item">Tanggal Maintenance : <strong>{{ Carbon::parse($data->tgl_maintenance)->diffForHumans() }}</strong></li>
                <li class="list-group-item">Petugas Maintenance : <strong>{{ $data->petugas_maint }}</strong></li>
                <li class="list-group-item">Status : <strong>{{ $data->status }}</strong></li>
                <li class="list-group-item">Kerusakan : <strong>{{ $data->kerusakan }}</strong></li>
                <li class="list-group-item">Keterangan : <strong>{{ $data->keterangan }}</strong></li>
                <li class="list-group-item">Catatan : <strong>{{ $data->catatan }}</strong></li>
            </ul>
        </div>
    </div>
@endsection

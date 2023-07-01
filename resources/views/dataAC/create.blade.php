@extends('layout.main')


@section('content')

<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<div class="row">

<div class="col-xl-9 mx-auto">

    <a href="{{ url('/ac') }}" class="btn btn-success btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back</a>

  <h6 class="mb-0 text-uppercase">Tambah Data AC</h6>

  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="p-4 border rounded">
        <form action="{{ url('/ac/create') }}" method="post" class="row g-3 needs-validation">
            @csrf
          <div class="col-md-4">
            <label for="tgl_pemasangan" class="form-label">Tanggal Pemasangan <small>(optional)</small></label>
            <input type="text" class="form-control datepicker" name="tgl_pemasangan" id="tgl_pemasangan" value="{{ old('tgl_pemasangan') }}">
          </div>
          <div class="col-md-4">
            <label for="petugas_pemasangan" class="form-label">Petugas Pemasangan <small>(optional)</small></label>
            <input type="text" data-role="tagsinput" class="form-control" id="petugas_pemasangan" name="petugas_pemasangan" value="{{ old('petugas_pemasangan') }}">
          </div>
          <div class="col-md-4">
            <label for="tgl_maintenance" class="form-label">Tanggal Maintenance <small>(optional)</small></label>
            <input class="result form-control" type="text" name="tgl_maintenance" id="date-time" value="{{ old('tgl_maintenance') }}">
          </div>
          <div class="col-md-12">
            <label for="petugas_maint" class="form-label">Petugas Maintenance <small>(optional)</small></label>
            <input class="form-control" data-role="tagsinput" type="text" name="petugas_maint" value="{{ old('petugas_maint') }}">
          </div>
          <div class="col-md-4">
            <label for="label" class="form-label">ID <small>(optional)</small></label>
            <input type="text" class="form-control text-capitalize @error('label')
              is-invalid @enderror" id="label" name="label" value="{{ old('label') }}">
              @error('label')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
          </div>
          <div class="col-md-4">
            <label for="assets" class="form-label">Asset <small>(optional)</small></label>
            <input type="text" class="form-control" name="assets" id="assets" value="{{ old('assets') }}">
          </div>
          <div class="col-md-4">
            <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
            <select class="form-select" id="merk" required name="merk">
                <option selected disabled value="">--Select--</option>
                <option value="Daikin">Daikin</option>
                <option value="General">General</option>
                <option value="Panasonic">Panasonic</option>
                <option value="LG">LG</option>
                <option value="Sharp">Sharp</option>
                <option value="Mitshubisi">Mitshubisi</option>
                <option value="Midea">Midea</option>
                <option value="Polytron">Polytron</option>
                <option value="Toshiba">Toshiba</option>
                <option value="AUX">AUX</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="wing" class="form-label">Wing <span class="text-danger">*</span></label>
            <select class="form-select" id="wing" required name="wing">
                <option selected disabled value="">--Select--</option>
                <option value="WA">WA</option>
                <option value="WB">WB</option>
                <option value="WC">WC</option>
                <option value="WD">WD</option>
                <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="col-md-4 optLantai">
             {{-- inputan ini berdasarkan WING --}}
          </div>
          <div class="col-md-4">
            <label for="ruangan" class="form-label">Ruangan <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan" id="ruangan" value="{{ old('ruangan') }}" required>
          </div>
          <div class="col-md-4">
            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
            <select class="form-select" id="type" required name="type">
                <option selected disabled value="">--Select--</option>
                <option value="Cassete">Cassete</option>
                <option value="Wall Mounted">Wall Mounted</option>
                <option value="Standing floor">Standing Floor</option>
                <option value="Central">Central</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="kapasitas" class="form-label">Kapasitas <span class="text-danger">*</span></label>
            <select class="form-select" id="kapasitas" required name="kapasitas">
                <option selected disabled value="">--Select--</option>
                <option value="1/2pk">1/2pk</option>
                <option value="3/4pk">3/4pk</option>
                <option value="1pk">1pk</option>
                <option value="1,5pk">1,5pk</option>
                <option value="2pk">2pk</option>
                <option value="2,5pk">2,5pk</option>
                <option value="3pk">3pk</option>
                <option value="5pk">5pk</option>
                <option value="8pk">8pk</option>
                <option value="10pk">10pk</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="jenis" class="form-label">Jenis <span class="text-danger">*</span></label>
            <select class="form-select" id="jenis" required name="jenis">
                <option selected disabled value="">--Select--</option>
                <option value="Inverter">Inverter</option>
                <option value="Non-inverter">Non-Inverter</option>
            </select>
          </div>
          <div class="col-md-4 optRefrigerant">

          </div>
          <div class="col-md-4">
            <label for="product" class="form-label">Product <small>(optional)</small></label>
            <input type="text" class="form-control" name="product" id="product" value="{{ old('product') }}">
          </div>
          <div class="col-md-4">
            <label for="current" class="form-label">Amper <small>(optional)</small></label>
            <input type="text" class="form-control" name="current" id="current" value="{{ old('current') }}">
          </div>
          <div class="col-md-3">
            <label for="voltage" class="form-label">Voltage <span class="text-danger">*</span></label>
            <select class="form-select" id="voltage" required name="voltage">
                <option selected disabled value="">--Select--</option>
                <option value="220Volt">220Volt</option>
                <option value="380Volt">380Volt</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="btu" class="form-label">Btu <small>(optional)</small></label>
            <input type="text" class="form-control" name="btu" id="btu" value="{{ old('btu') }}">
          </div>
          <div class="col-md-3">
            <label for="pipa" class="form-label">Pipa <small>(Liquid + Gas)<small>(optional)</small></small></label>
            <select class="form-select" id="pipa" name="pipa">
              <option selected disabled value="">--Select--</option>
              <option value="1/4 + 3/8">1/4 + 3/8</option>
              <option value="1/4 + 1/2">1/4 + 1/2</option>
              <option value="1/4 + 5/8">1/4 + 5/8</option>
              <option value="3/8 + 5/8">3/8 + 5/8</option>
              <option value="3/8 + 3/4">3/8 + 3/4</option>
              <option value="1/2 + 3/4">1/2 + 3/4</option>
              <option value="1/2 + 7/8">1/2 + 7/8</option>
              <option value="1/2 + 1 1/2">1/2 + 1 1/2</option>
          </select>
          </div>
          <div class="col-md-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" id="status" required name="status">
                <option selected disabled value="">--Select--</option>
                <option value="Normal">Normal</option>
                <option value="Rusak">Rusak</option>
                <option value="Progres">Progres</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="seriIndoor" class="form-label">No Seri Indoor <small>(optional)</small></label>
            <input type="text" class="form-control @error('seri_indoor')
              is-invalid
            @enderror" name="seri_indoor" id="seriIndoor" value="{{ old('seri_indoor') }}">
            @error('seri_indoor')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="seriOutdoor" class="form-label">No Seri Outdoor <small>(optional)</small></label>
            <input type="text" class="form-control @error('seri_outdoor') is-invalid @enderror" name="seri_outdoor" id="seriOutdoor" value="{{ old('seri_outdoor') }}">
            @error('seri_outdoor')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-6">
            <label class="form-label" id="labelKerusakan">Kerusakan</label>
            <textarea class="form-control" name="kerusakan" id="kerusakan" rows="4" cols="4" value="{{ old('kerusakan') }}" placeholder="Masukan kerusakan jika ada!"></textarea>
          </div>
          <div class="col-6" id="colKeterangan">
            <label class="form-label">Keterangan <small>(optional)</small></label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" cols="4" value="{{ old('keterangan') }}" placeholder="Masukan keterangan jika ada!"></textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Catatan <small>(optional)</small></label>
            <textarea class="form-control" name="catatan" id="catatan" rows="4" cols="4" value="{{ old('catatan') }}" placeholder="Masukan catatan jika ada!"></textarea>
          </div>
          <div class="col-12">
              <div class="d-grid">
              <button class="btn btn-purple" type="submit">Submit form</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</div>
<!--end row-->
{{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}
<script src="{{ asset('assets/myScript/funcCreateAC.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
@endsection

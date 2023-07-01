@extends('layout.main')


@section('content')
<?php use Illuminate\Support\Carbon; ?>



            <div class="flash-success" data-success="{{ session('success') }}"></div>
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-table" style="color:#7b378e"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Trash</li>
                  </ol>
                </nav>
              </div>
            </div>

            <a href="{{ url('/ac') }}" class="mb-0 text-uppercase btn btn-primary btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
            @can('admin')
            <a id="btnDelPermanent" href="{{ url('/ac/trash/deleteAll') }}" class="mb-0 text-uppercase btn btn-danger btn-sm"><i class="bi bi-x-circle-fill"></i> Delete All</a>
            @endcan
        <hr/>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Assets</th>
                    <th>Label</th>
                    <th>Wing</th>
                    <th>Lantai</th>
                    <th>Ruangan</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($softData as $ac)
                  <tr id="idone{{ $ac->id }}">
                    <td>{{ $ac->assets }}</td>
                    <td>{{ $ac->label }}</td>
                    <td>{{ $ac->wing }}</td>
                    <td>{{ $ac->lantai }}</td>
                    <td>{{ $ac->ruangan }}</td>
                    <td>{{ $ac->merk }}</td>
                    <td>{{ $ac->type }}</td>
                    @if ($ac->status == 'Rusak')
                    <td class="bg-danger text-white">{{ $ac->status }}</td>
                    @else
                    <td class="bg-info text-white">{{ $ac->status }}</td>
                    @endif
                    <td>
                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:void(0)" class="text-warning" onclick="delFunc({{ $ac->id }})"><i class="bi bi-download"></i></a>

                            <button id="btnDetailTrash" class="bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#modalDetailTrash"
                            data-idtrash="{{ $ac->id }}"
                            data-labelactrash="{{ $ac->label }}"
                            data-assetsactrash="{{ $ac->assets }}"
                            data-wingactrash="{{ $ac->wing }}"
                            data-lantaiactrash="{{ $ac->lantai }}"
                            data-ruanganactrash="{{ $ac->ruangan }}"
                            data-merkactrash="{{ $ac->merk }}"
                            data-typeactrash="{{ $ac->type }}"
                            data-jenisactrash="{{ $ac->jenis }}"
                            data-kapasitasactrash="{{ $ac->kapasitas }}" data-refrigerantactrash="{{ $ac->refrigerant }}" data-productactrash="{{ $ac->product }}"
                            data-currentactrash="{{ $ac->current }}"
                            data-voltageactrash="{{ $ac->voltage }}"
                            data-btuactrash="{{ $ac->btu }}"
                            data-statusactrash="{{ $ac->status }}"
                            data-catatanactrash="{{ $ac->catatan }}" data-tglpemasanganactrash="{{ $ac->tgl_pemasangan }}" data-petugaspemasanganactrash="{{ $ac->petugas_pemasangan }}"
                            data-tanggalmaintenanceactrash="{{ Carbon::parse($ac->tgl_maintenance)->locale('id')->diffForHumans() }}" data-updatedtimeactrash="{{ $ac->is_delete }}/{{ Carbon::parse($ac->updated_at)->locale('id')->diffForHumans() }}"><i class="bi bi-eye"></i></button>

                        </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Assets</th>
                    <th>Label</th>
                    <th>Wing</th>
                    <th>Lantai</th>
                    <th>Ruangan</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>


        {{-- Modal Detail --}}

        <div class="col">
          <div class="modal fade" id="modalDetailTrash" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detail Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    {{-- <div class="card-body"> --}}
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Di hapus <span>:</span> <span id="detailUpdatedACTrash"></span>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal Pemasangan <span>:</span> <span id="detailTanggaPemasanganACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Petugas Pemasangan <span>:</span> <span id="detailPetugasPemasanganACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal Maintenance <span>:</span> <span id="detailTglMaintenanceACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Label <span>:</span> <span id="detailLabelACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Assets <span>:</span> <span id="detailAssetsACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Wing <span>:</span> <span id="detailWingACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Lantai <span>:</span> <span id="detailLantaiACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Ruangan <span>:</span> <span id="detailRuanganACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Merk <span>:</span> <span id="detailMerkACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Type <span>:</span> <span id="detailTypeACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Jenis <span>:</span> <span id="detailJenisACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Kapasitas <span>:</span> <span id="detailKapasitasACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Refrigerant <span>:</span> <span id="detailRefrigerantACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Product <span>:</span> <span id="detailProductACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Amper <span>:</span> <span id="detailAmperACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Voltage <span>:</span> <span id="detailVoltageACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Btu <span>:</span> <span id="detailBtuACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Status <span>:</span> <span id="detailStatusACTrash"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-center align-items-center text-center" id="detailCatatanACTrash"></span>
                        </li>
                      </ul>
                    {{-- </div> --}}
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- end modal detail --}}



        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
          function delFunc(id)
          {
              $.ajax({
                url:"{{ url('/ac/trash') }}" + "/" + id,
                type: "DELETE",
                data:{
                  _token : $("input[name=_token]").val()
                },
                success : function(response){
                  $("#idone"+id).remove();
                }
              });
          }

          $(document).on('click', '#btnDelPermanent', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = href;
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })

          });


          $(document).on('click', '#btnDetailTrash', function() {
              const labeltrash = $(this).data('labelactrash');
              const assetstrash = $(this).data('assetsactrash');
              const wingactrash = $(this).data('wingactrash');
              const lantaiactrash = $(this).data('lantaiactrash');
              const ruanganactrash = $(this).data('ruanganactrash');
              const merkactrash = $(this).data('merkactrash');
              const typeactrash = $(this).data('typeactrash');
              const jenisactrash = $(this).data('jenisactrash');
              const kapasitasactrash = $(this).data('kapasitasactrash');
              const refrigerantactrash = $(this).data('refrigerantactrash');
              const productactrash = $(this).data('productactrash');
              const currentactrash = $(this).data('currentactrash');
              const voltageactrash = $(this).data('voltageactrash');
              const btuactrash = $(this).data('btuactrash');
              const statusactrash = $(this).data('statusactrash');
              const catatanactrash = $(this).data('catatanactrash');
              const tanggalpemasanganactrash = $(this).data('tglpemasanganactrash');
              const petugaspemsanganactrash = $(this).data('petugaspemasanganactrash');
              const tanggalmainttrash = $(this).data('tanggalmaintenanceactrash');
              const updatedtimeactrash = $(this).data('updatedtimeactrash');

              if(updatedtimeactrash == '1 detik yang lalu'){

                $('#detailUpdatedACTrash').html('');

              }else{

                $('#detailUpdatedACTrash').html(updatedtimeactrash);

              }

              $('#detailTanggaPemasanganACTrash').html(tanggalpemasanganactrash);
              $('#detailPetugasPemasanganACTrash').html(petugaspemsanganactrash);
              $('#detailTglMaintenanceACTrash').html(tanggalmainttrash);
              $('#detailLabelACTrash').html(labeltrash);
              $('#detailAssetsACTrash').html(assetstrash);
              $('#detailWingACTrash').html(wingactrash);
              $('#detailLantaiACTrash').html(lantaiactrash);
              $('#detailRuanganACTrash').html(ruanganactrash);
              $('#detailMerkACTrash').html(merkactrash);
              $('#detailTypeACTrash').html(typeactrash);
              $('#detailJenisACTrash').html(jenisactrash);
              $('#detailKapasitasACTrash').html(kapasitasactrash);
              $('#detailRefrigerantACTrash').html(refrigerantactrash);
              $('#detailProductACTrash').html(productactrash);
              $('#detailAmperACTrash').html(currentactrash);
              $('#detailVoltageACTrash').html(voltageactrash);
              $('#detailBtuACTrash').html(btuactrash);
              $('#detailStatusACTrash').html(statusactrash);
              $('#detailCatatanACTrash').html(catatanactrash);
          });

        </script>

@endsection

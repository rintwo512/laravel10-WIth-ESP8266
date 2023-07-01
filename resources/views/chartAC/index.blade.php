@extends('layout.main')

@section('content')
@php
use Illuminate\Support\Carbon;
$nowYear = Carbon::now()->format("Y");
$iniBulan = Carbon::now()->format("F");
$nowMonth = Carbon::now()->month - 1;


@endphp

<meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="flash-success" data-success="{{ session('success') }}"></div>
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-table" style="color:#7b378e"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chart AC</li>
                  </ol>
                </nav>
              </div>
            </div>

            <a href="{{ url('/ac') }}" class="btn btn-danger btn-sm mb-3"><i class="bi bi-arrow-bar-left"></i> Back</a>

            <div class="col-md-3">
            <form action="{{ url('/chart/search') }}">
                @csrf
            <div class="input-group mb-3">
                <button class="btn btn-primary" type="submit">Search</button>
                <select class="form-select" name="updateTahun" id="updateTahun">
                    <option value="">--Select--</option>
                    @foreach ($listUpdateTahun as $list )
                    <option value="{{ $list->tahun }}">{{ $list->tahun }}</option>
                    @endforeach
                </select>
            </div>
        </form>

    </div>
        <hr/>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">

                <a href="javascript:void(0)" class="btn btn-success mb-3 text-white"  data-bs-toggle="modal" data-bs-target="#modalCreateChart"><i class="bi bi-plus"></i>Add New</a>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="unlockBtn" name="unlockBtn" value="true">
                  </div>

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>

                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Unit</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody id="dataBody">
                        @foreach ($dataChart as $ch )
                        <tr id="idchart{{ $ch->id }}">
                            <td>{{ $ch->tahun }}</td>
                            <td>{{ $ch->bulan }}</td>
                            <td>{{ $ch->total }}</td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">

                                    @if ($iniBulan == $ch->bulan && $nowYear == $ch->tahun)

                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delDataChart({{ $ch->id }})"><i class="bi bi-x-circle-fill"></i></a>


                                    <a id="btnUpdateChart" href="javascript:void(0)" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalUpdateChart" data-idchart="{{ $ch->id }}" data-tahunchart="{{ $ch->tahun }}" data-bulanchart="{{ $ch->bulan }}" data-totalchart="{{ $ch->total }}"
                                        ><i class="bi bi-pencil-fill"></i></a>

                                    @else

                                    <button disabled class="btn btn-secondary btn-sm unDel" onclick="delDataChart({{ $ch->id }})"><i class="bi bi-x-circle-fill"></i></button>


                                    <button id="btnUpdateChart" disabled class="btn btn-secondary btn-sm text-white unEd" data-bs-toggle="modal" data-bs-target="#modalUpdateChart" data-idchart="{{ $ch->id }}" data-tahunchart="{{ $ch->tahun }}" data-bulanchart="{{ $ch->bulan }}" data-totalchart="{{ $ch->total }}"
                                        ><i class="bi bi-pencil-fill"></i></button>

                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Total : {{ $dataTotalUnit }} Unit</th>
                        <th>Opsi</th>
                      </tr>
                    </tfoot>
                  </table>
            </div>
          </div>
        </div>



            <!-- Modal Cretae -->
            <div class="modal fade" id="modalCreateChart" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="userTitle">New Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                <form action="{{ url('chart/create') }}" class="row g-3 needs-validation" method="post">

                  @csrf
                  <div class="col-md-4">
                    <label for="tahunChart" class="form-label">Tahun </label>
                    <select class="form-select" id="tahunChart" name="tahunChart" required>
                        <option value="">--Select--</option>
                        <option value="{{ $nowYear }}">{{ $nowYear }}</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="monthChart" class="form-label">Bulan </label>
                    <select class="form-select" id="monthChart" name="monthChart" required>
                        <option value="">--Select--</option>
                        @foreach (array_slice($month, $nowMonth) as $mon )
                        @if ($iniBulan == $mon)
                        <option value="{{ $mon }}">{{ $mon }}</option>
                        @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="totalChart" class="form-label">Unit </label>
                    <input type="text" class="form-control" id="totalChart" name="totalChart" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                  </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
                </div>
              </div>
            </div>
            <!-- End Modal Cretae -->

            <!-- Modal Update -->
            <div class="modal fade" id="modalUpdateChart" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Data</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">
                  <form action="{{ url('/chart/update') }}" class="row g-3 needs-validation" method="post">
                    @csrf
                    <div class="col-md-4">
                        <input type="hidden" id="idChartUpdate" name="idUpdateChart">
                      <label for="tahunUpdateChart" class="form-label">Tahun </label>
                      <select class="form-select" id="tahunUpdateChart" name="tahunUpdateChart" required>
                          <option value="">--Select--</option>
                          <option value="{{ $nowYear }}">{{ $nowYear }}</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="monthUpdateChart" class="form-label">Bulan </label>
                      <select class="form-select" id="monthUpdateChart" name="monthUpdateChart" required>
                          <option value="">--Select--</option>
                          @foreach (array_slice($month, $nowMonth) as $mon )
                          <option value="{{ $mon }}">{{ $mon }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="totalUpdateChart" class="form-label">Unit </label>
                      <input type="text" class="form-control" id="totalUpdateChart" name="totalUpdateChart" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" id="btnUpdateChart1" class="btn btn-primary" disabled>Submit</button>
                  </div>
                </form>
                  </div>
                </div>
              </div>
              <!-- End Modal Update -->

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
          const flashSuccess = document.querySelector('.flash-success');
          const flashNotif = flashSuccess.dataset.success;
          if(flashNotif){
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: flashNotif,
            showConfirmButton: false,
            timer: 4000
            });
          }
        </script>

        <script>
          $(document).ready(function() {
            $('#totalUpdateChart').on('keyup',function(){
              $("#btnUpdateChart1").removeAttr("disabled");
            });
          });
      </script>
        <script type="text/javascript">
            function delDataChart(id){

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
                        $.ajax({
                            url:"{{ url('/chart/delete') }}" + "/" + id,
                            type: "DELETE",
                            data:{
                            _token : $("input[name=_token]").val()
                            },
                            success : function(response){
                            $("#idchart"+id).remove();
                            }
                        });
                    }
                    })
                }

        </script>

        <script>

            $(document).on("click", "#btnUpdateChart", function(e) {
                e.preventDefault();
                const idChart = $(this).data('idchart');
                const tahunChart = $(this).data('tahunchart');
                const bulanChart = $(this).data('bulanchart');
                const totalChart = $(this).data('totalchart');
                $("#modal-body #idChartUpdate").val(idChart);
                $("#modal-body #tahunUpdateChart").val(tahunChart);
                $("#modal-body #monthUpdateChart").val(bulanChart);
                $("#modal-body #totalUpdateChart").val(totalChart);
            });

            $(document).ready(function() {
                $('#unlockBtn').change(function() {
                    if($(this).prop("checked")){
                        $('.unDel').removeAttr('disabled');
                        $('.unEd').removeAttr('disabled');
                        $('.unEd').addClass('btn-info');
                        $('.unDel').addClass('btn-danger');
                    }else{
                        $('.unDel').attr('disabled', 'disabled' );
                        $('.unEd').attr('disabled', 'disabled' );
                        $('.unEd').removeClass('btn-info');
                        $('.unDel').removeClass('btn-danger');
                    }
                })
            });

        </script>


@endsection

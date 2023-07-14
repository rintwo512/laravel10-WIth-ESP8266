@extends('layout.main')

@section('content')
    <div class="profile-cover bg-dark"></div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-0">Profile</h5>
                    <hr>
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">User Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Email address</label>
                                    <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" value="{{ $data->tempat_lahir }}" readonly>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Tanggl Lahir</label>
                                    <input type="text" class="form-control"
                                        value="{{ date('l, d-F-Y', strtotime($data->tanggal_lahir)) }}" readonly>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Whatsapp</label>
                                    <input type="text" class="form-control" value="{{ $data->no_wa }}" readonly>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" value="{{ $data->nik }}" readonly>
                                </div>
                                <div class="text-start">
                                    <a href="{{url('/members')}}" class="btn btn-purple px-4">Back</a>
                                  </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        @if ($data->image != 'default.png')
                            <img src="{{ asset('storage/' . $data->image) }}" class="rounded-circle shadow" width="120"
                                height="120" alt="">
                        @else
                            <img src="{{ asset('assets/images/avatars/' . $data->image) }}" class="rounded-circle shadow"
                                width="120" height="120" alt="">
                        @endif
                    </div>

                    <div class="text-center mt-4">
                        <h4 class="mb-1">{{ $data->name }}</h4>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--end row-->
@endsection

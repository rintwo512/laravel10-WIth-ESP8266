@extends('layout.main')

@section('content')

        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Masukkan url website yang ingin Anda Scrapping</p>
                    </div>
                    <hr/>
                    <form action="{{ url('/tools/getLinks') }}" method="post">
                    @csrf
                    <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon3">https://example.com</span>
                        <input type="url" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="links" required>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary px-5">Generate</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

        </div>





@endsection

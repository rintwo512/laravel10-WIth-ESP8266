@extends('layout.main')

@section('content')

        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <a href="{{ url('/tools/scrapeLinks') }}" class="btn btn-primary"><i class="bx bx-reply"></i> Back</a>
                    </div>
                    <hr/>
                    @foreach($links as $link)
                     <h5>{{$link["text"]}} : <a href="#">{{$link["href"]}}</a></h5>
                    @endforeach
                  </div>
                </div>
              </div>

        </div>





@endsection

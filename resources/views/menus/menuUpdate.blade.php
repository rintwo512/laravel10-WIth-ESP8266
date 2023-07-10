@extends('layout.main')

@section('content')
<style>
    section {
        counter-reset: total;
    }

    input {
        opacity: 0;
        position: absolute;
    }

    label {
        position: relative;
        display: block;
        background: #f8f8f8;
        border: 1px solid #f0f0f0;
        border-radius: 2em;
        padding: .5em 1em .5em 5em;
        box-shadow: 0 1px 2px rgba(100, 100, 100, .5) inset, 0 0 10px rgba(100, 100, 100, .1) inset;
        cursor: pointer;
        text-shadow: 0 2px 2px #fff;
        transition: all .2s cubic-bezier(0.165, 0.840, 0.440, 1);
    }

    label::before {
        content: '';
        position: absolute;
        top: 50%;
        left: .7em;
        width: 3em;
        height: 1.2em;
        border-radius: .6em;
        background: #eee;
        transform: translateY(-50%);
        box-shadow: 0 1px 3px rgba(100, 100, 100, .5) inset, 0 0 10px rgba(100, 100, 100, .2) inset;
        transition: all .2s cubic-bezier(0.165, 0.840, 0.440, 1);
    }

    label::after {
        content: '';
        position: absolute;
        top: 50%;
        left: .5em;
        width: 1.4em;
        height: 1.4em;
        border: .25em solid #fafafa;
        border-radius: 50%;
        box-sizing: border-box;
        background-color: #ddd;
        background-image: linear-gradient(to top, #fff 0%, #fff 40%, transparent 100%);
        transform: translateY(-50%);
        box-shadow: 0 3px 3px rgba(0, 0, 0, .5);
        transition: all .2s cubic-bezier(0.165, 0.840, 0.440, 1);
    }

    input:checked + label {
        text-decoration: line-through;
    }

    input:checked + label::before {
        background: #1CE;
    }

    input:checked + label::after {
        transform: translateX(2em) translateY(-50%);
    }

    .total::after {
        content: counter(total);
        font-weight: bold;
    }
</style>

<form method="POST" action="{{ route('members.update-menus', $user) }}">
    @csrf
    <h1>Akses Menu</h1>
    <h5>Update Menu: {{ $user->name }}</h5>
    <a href="{{ url('/members') }}" class="mb-0 text-uppercase btn btn-primary btn-sm mb-2"><i class="bi bi-arrow-bar-left"></i> Back</a>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <section>
                    @foreach ($menus as $menu)
                    <div class="mb-2 mt-2">
                        <input id="checkbox{{ $menu->id }}" type="checkbox" name="menu_statuses[{{ $menu->id }}]" value="1" {{ $user->menus->contains('id', $menu->id) ? 'checked' : '' }} {{ $menu->id == 4 ? 'disabled' : '' }} />
                        <label for="checkbox{{ $menu->id }}">{{ $menu->name }}</label>
                    </div>
                    @endforeach
                </section>
                <button type="submit" class="btn btn-purple mt-3 mb-3">Update</button>
            </div>
        </div>
    </div>
</form>


@endsection

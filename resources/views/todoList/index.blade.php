@extends('layout.main')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-0">To Do List</h4>
            <hr>
            <form id="add-todo-form">
                @csrf
                <div class="row gy-3">
                    <div class="col-md-10">
                        <input type="text" name="title" type="text" class="form-control" value=""
                            placeholder="Enter task">
                    </div>
                    <div class="col-md-2 text-end d-grid">
                        <button type="submit" class="btn btn-primary">Add todo</button>
                    </div>
                </div>
            </form>
            <div class="form-row mt-3" id="todo-list" data-next-id="{{ $data->isEmpty() ? 1 : $data->last()->id + 1 }}">
                @foreach ($data as $todo)
                    <div class="col-12  {{ $todo->completed ? 'completed' : '' }}" data-id="{{ $todo->id }}">
                        <div class="pb-3 todo-item">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="checkbox" class="toggle-completed" {{ $todo->completed ? 'checked' : '' }}>
                                </div>
                                <input type="text" readonly="" class="form-control false"
                                    aria-label="Text input with checkbox" value="{{ $todo->title }}">
                                    @if ($todo->title != "Ini adalah contoh todo list!")
                                <button class="btn btn-outline-secondary bg-danger text-white delete-todo"
                                    id="button-addon2">X</button>
                                    @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/todo.js')}}"></script> --}}
    <script>
        $(document).ready(function() {
            // Menangani penambahan to-do

            $('#add-todo-form').submit(function(e) {
                e.preventDefault();

                var title = $('input[name="title"]').val();

                $.ajax({
                    url: "{{ url('/todolist/add') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: title
                    },
                    success: function(response) {
                        if (response.success) {
                            var nextId = $('#todo-list').data('next-id');
                            var todo = '<div class="col-12" data-id="' + nextId + '">' +
                                '<div class="pb-3 todo-item">' +
                                '<div class="input-group">' +
                                '<div class="input-group-text">' +
                                '<input type="checkbox" class="toggle-completed">' +
                                '</div>' +
                                '<input type="text" readonly class="form-control false" aria-label="Text input with checkbox" value="' +
                                title + '">' +
                                '<button class="btn btn-outline-secondary bg-danger text-white delete-todo" id="button-addon2">X</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>';

                            $('#todo-list').append(todo);
                            $('input[name="title"]').val('');

                            // Update nilai data-next-id untuk todo berikutnya
                            $('#todo-list').data('next-id', nextId + 1);
                        }
                    }
                });
            });


            // Menangani penandaan to-do sebagai selesai atau belum selesai
            $(document).on('change', '.toggle-completed', function() {
                var div = $(this).closest('.col-12');
                var id = div.data('id');
                var completed = $(this).prop('checked');


                $.ajax({
                        url: "{{ url('todolist/update/') }}" + "/" + id,
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: 'PUT',
                            completed: completed ? 1 : 0
                        }
                    })
                    .done(function(response) {
                        if (response.success) {
                            div.toggleClass('completed', completed);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                    });
            });




            // Menangani penghapusan to-do
            $(document).on('click', '.delete-todo', function() {
                var div = $(this).closest('.col-12');
                var id = div.data('id');

                $.ajax({
                    url: "{{ url('todolist/delete') }}" + "/" + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            div.remove();
                        }
                    }
                });
            });
        });
    </script>
@endsection

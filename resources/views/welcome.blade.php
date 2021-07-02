<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href={{ asset('css/app.css') }}>

    </head>
    <body>
        <div class="container p-3">
            <div class="row">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('delete'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('delete') }}
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-4">
                    <table class="table table-success table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student['id'] }}</td>
                                    <td>{{ $student['name'] }}</td>
                                    <td>{{ $student['grade'] }}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-sm btn-primary student" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $student['id'] }}" data-name="{{ $student['name'] }}" data-grade="{{ $student['grade'] }}">Edit</button>
                                        <form action="{{ route('student.delete', $student['id']) }}" method="POST" class="ml-2">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="updateForm" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                      <label for="name" class="form-label">Name</label>
                                      <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="mb-3">
                                      <label for="grade" class="form-label">Grade</label>
                                      <input type="text" class="form-control" name="grade" id="grade">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudent">Add Student</button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('student.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="name" class="form-label">Name</label>
                                  <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="mb-3">
                                  <label for="grade" class="form-label">Grade</label>
                                  <input type="text" class="form-control" name="grade" id="grade">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script type="application/javascript">
            $(document).ready(function () {
                $('.student').each(function() {
                  $(this).click(function(event){
                    $('#updateForm').attr("action", "/student/update/"+$(this).data("id")+"")
                    $('#name').val($(this).data("name"))
                    $('#grade').val($(this).data("grade"))
                  })
                })
            });
        </script>
    </body>
</html>

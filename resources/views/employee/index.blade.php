@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<div class="container">

  
  @if(Session::has('message'))
    <div class="alert alert-success alert-dismisible" role="alert">
      {{ Session::get('message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden>&times;</span>
      </button>
    </div>
  @endif
    

  <a href="{{ url('employee/create') }}" class="btn btn-success">New employee</a>

  <div class="table-responsive text-center mt-4">
    <table class="table table-light">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Foto</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido paterno</th>
          <th scope="col">Apellido materno</th>
          <th scope="col">Correo</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($employees as $employee)
        <tr>
          <td>{{ $employee->id }}</td>
          <td><img src="{{ asset('/img/employees/').'/'.$employee->photo }}" width="50" class="img-fluid rounded-circle mx-auto" alt=""></td>
          <td>{{ $employee->name }}</td>
          <td>{{ $employee->father_lastname }}</td>
          <td>{{ $employee->mother_lastname }}</td>    
          <td>{{ $employee->email }}</td>  
          <td>
            <div class="btn-group">
              <a href="{{ url('/employee/'.$employee->id.'/edit') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
              </a> 
              <form action="{{ url('/employee/'.$employee->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
                <button type="submit" onclick="return confirm('Do you want to delete?')" class="btn btn-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $employees->links() !!}
  </div>
</div>
@endsection
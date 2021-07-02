<h1>{{ $mode }} employee</h1>

@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ isset($employee->name) ? $employee->name : old('name') }}">
</div>

<div class="form-group">
    <label for="father_lastname">Apellido paterno</label>
    <input type="text" class="form-control" name="father_lastname" id="father_lastname" value="{{ isset($employee->father_lastname) ? $employee->father_lastname : old('father_lastname') }}">
</div>

<div class="form-group">
    <label for="mother_lastname">Apellido materno</label>
    <input type="text" class="form-control" name="mother_lastname" id="mother_lastname" value="{{ isset($employee->mother_lastname) ? $employee->mother_lastname : old('mother_lastname') }}">
</div>

<div class="form-group">
    <label for="email">Correo</label>
    <input type="email" class="form-control" name="email" id="email" value="{{ isset($employee->email) ? $employee->email : old('email') }}">
</div>

<div class="mb-3">
    <label for="photo" class="form-label">Foto</label>
    @if(isset($employee->photo))
    <img src="{{ asset('/img/employees/').'/'.$employee->photo }}" width="50" class="img-fluid rounded-circle mx-auto" alt="">
    @endif
    <input type="file" class="form-control" name="photo" id="photo" value="">
</div>

<input type="submit" value="{{ $mode }}" class="btn btn-success">
<a href="{{ url('employee') }}" class="btn btn-secondary">Return</a>


@extends('layouts.app')
@section('title', 'Edit')
@section('content')
<div class="container">
    <form action="{{ url('/employee/'.$employee->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('employee.form', ['mode' => 'Edit'])
    </form>
</div>
@endsection
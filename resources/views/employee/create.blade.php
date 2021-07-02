@extends('layouts.app')
@section('title', 'Create')
@section('content')
<div class="container">
    <form action="{{ url('/employee') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('employee.form', ['mode' => 'Create'])
    </form>
</div>
@endsection
@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="uper">
  <h4>
    Lecturer(s) for <strong>{{ $degree->name }}</strong>
  </h4>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>Lecturer name</th>
        <th>Lecturer surname</th>
        <th>Lecturer email</th>
        <th>Lecturer DOB</th>
        <th>Fullname</th>
        <th colspan="1">Degrees</th>
      </tr>
    </thead>
    <tbody>
      @foreach($degree->lecturers as $tutor)
        <tr>
          <td>{{$tutor->name}}</td>
          <td>{{$tutor->surname}}</td>
          <td>{{$tutor->email}}</td>
          <td>{{$tutor->dob}}</td>
          <td>{{$tutor->name}} {{$tutor->surname}}</td>
          <td>
            <a href="{{ url('/students/') }}">
              <button class="btn btn-primary btn-sm" type="button">BACK TO STUDENTS
              </button>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
<div>
@endsection

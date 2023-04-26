@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  <h4>
    Student/s enrolled for <strong>{{ $degree->name }}</strong>
  </h4>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>Student Name(s)</th>
        <th>Student Surname</th>
        <th>Student Email</th>
        <th>Student DoB</th>
        <th colspan="1">TUTOR(S)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($degree->students as $student)
        <tr>
          <td>{{ $student->name }}</td>
          <td>{{ $student->surname }}</td>
          <td>{{ $student->email }}</td>
          <td>{{ $student->dob }}</td>
          <td>
            <a href="{{ url('/course/' . $degree->id) }}">
              <button class="btn btn-secondary btn-sm" type="button">COURSES / MODULES
              </button>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
<div>
@endsection

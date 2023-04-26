@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  <h4>
    @foreach($student->degrees as $degree)
     <strong>{{ $student->name }} {{ $student->surname }}</strong> is enrolled for <strong>{{ $degree->name }}</strong>
    @endforeach
  </h4>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>Qualification ID</th>
        <th>Qualification Name</th>
        <th>Qualification Duration</th>
        <th colspan="1">TUTOR(S)</th>
        <th>Courses</th>
      </tr>
    </thead>
    <tbody>
      @foreach($student->degrees as $degree)
        <tr>
          <td>{{ $degree->id }}</td>
          <td>{{ $degree->name }}</td>
          <td>{{ $degree->duration }}</td>
          <td>
            <a href="{{ url('/tutor/' . $degree->id) }}">
              <button class="btn btn-primary btn-sm" type="button">LECTURER(S)
              </button>
            </a>
          </td>
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

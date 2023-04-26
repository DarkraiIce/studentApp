@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="uper">
  <h4>
    Degrees for <strong>{{ $course->name }}</strong>
  </h4>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>Degree ID</th>
        <th>Degree Name</th>
        <th>Degree Duration</th>
        <th colspan="1">Degrees Enrolled For</th>
      </tr>
    </thead>
    <tbody class="text-center">
      @foreach($course->degrees as $degree)
        <tr>
          <td>{{ $degree->id }}</td>
          <td>{{ $degree->name }}</td>
          <td>{{ $degree->duration }}</td>
          <td>
            <a href="{{ url('/degree/' . $degree->id . '/students/') }}">
              <button class="btn btn-primary btn-sm" type="button">DEGREES
              </button>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
<div>
@endsection

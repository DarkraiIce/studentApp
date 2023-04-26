@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="uper">
  <h4>
    Courses for <strong>{{ $degree->name }}</strong>
  </h4>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Course Duration</th>
        <th>Course Credits</th>
        <th colspan="1">Degrees</th>
      </tr>
    </thead>
    <tbody class="text-center">
      @foreach($degree->courses as $course)
        <tr>
          <td>{{ $course->id }}</td>
          <td>{{ $course->name }}</td>
          <td>{{ $course->duration }}</td>
          <td>{{ $course->credits }}</td>
          <td>
            <a href="{{ url('/course/' . $course->id . '/degrees/') }}">
              <button class="btn btn-primary btn-sm" type="button">DEGREE(S)
              </button>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
<div>
@endsection

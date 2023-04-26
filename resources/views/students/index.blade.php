@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  <h4>Students Enrolled At <strong>Online College</strong></h4>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Student name</th>
        <th>Student surname</th>
        <th>Student email</th>
        <th>Birth Date</th>
        <th>Fullname</th>
        <th colspan="1">Qualification</th>
        <th>Remove Student(s)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($students as $student)
        <tr>
          <td>{{$student->id}}</td>
          <td>{{$student->name}}</td>
          <td>{{$student->surname}}</td>
          <td>{{$student->email}}</td>
          <td>{{$student->dob}}</td>
          <td>{{$student->name}} {{$student->surname}}</td>
          <td>
            <a href="{{ url('/degree/' . $student->id) }}">
              <button class="btn btn-success btn-sm scope" type="button"><i class="fa fa-book"></i> ENROLL
              </button>
            </a>
          </td>
          <td>
            <form action="{{ route('students.destroy', $student->id)}}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm scope" type="submit"><i class="fa fa-trash fa-lg"></i> DELETE</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
<div>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.table-data').DataTable();
  });
</script>
@endsection

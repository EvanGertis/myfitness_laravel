@extends('base')

@section('main')
<div class="col-sm-12">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
<div>
    <a style="margin: 19px;" href="{{ route('workouts.create')}}" class="btn btn-primary">New workout</a>
    </div> 
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Workouts</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Reps</td>
          <td>Exercise</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($workouts as $workout)
        <tr>
            <td>{{$workout->id}}</td>
            <td>{{$workout->reps}} {{$workout->exercise}}</td>
            <td>
                <a href="{{ route('workouts.edit',$workout->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('workouts.destroy', $workout->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection
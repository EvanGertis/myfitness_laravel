@extends('base') 
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a Workout</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('workouts.store') }}">
          @csrf
          <div class="form-group">    
              <label for="reps">reps:</label>
              <input type="text" class="form-control" name="reps"/>
          </div>

          <div class="form-group">
              <label for="exercise">exercise:</label>
              <input type="text" class="form-control" name="exercise"/>
          </div>
                       
          <button type="submit" class="btn btn-primary-outline">Add workout</button>
      </form>
  </div>
</div>
</div>
@endsection
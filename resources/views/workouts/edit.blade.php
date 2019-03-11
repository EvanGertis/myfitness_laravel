@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a workout</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('workouts.update', $workout->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="reps">reps:</label>
                <input type="text" class="form-control" name="reps" value={{ $workout->reps }} />
            </div>

            <div class="form-group">
                <label for="exercise">exercise:</label>
                <input type="text" class="form-control" name="exercise" value={{ $workout->exercise }} />
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
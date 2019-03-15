<?php

namespace App\Http\Controllers;

use DB;

use App\Workout;
use App\User_Workout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $workouts = DB::select('SELECT id,reps, exercise FROM workouts w INNER JOIN (SELECT workout_id FROM user__workouts uw INNER JOIN users u ON ? = uw.user_id GROUP BY workout_id) r ON r.workout_id = w.id;', [$request->user()->id]);
            return view('workouts.index', ['workouts'=> $workouts]);
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('workouts.create');
        } else {
            return redirect('/login');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'reps'=>'required',
                'exercise'=>'required'
            ]);

            $workout = new Workout([
                'reps' => $request->get('reps'),
                'exercise'=> $request->get('exercise')
            ]);

           

            $workout->save();

            $user_workout = new User_Workout([
                'user_id' => $request->user()->id,
                'workout_id' => $workout->id
            ]);

            $user_workout->save();
            
            return redirect('/workouts')->with('success', 'Workout saved!');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()){

            $workout = Workout::find($id);
            return view('workouts.edit', compact('workout'));

        } else {
            return redirect('/login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check()){
            $request->validate([
                'reps'=> 'required',
                'exercise'=>'required'
            ]);

            $workout = Workout::find($id);
            $workout->reps = $request->get('reps');
            $workout->exercise = $request->get('exercise');

            $workout->save();

            return redirect('/workouts')->with('success', 'Workout updated!');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $workout = Workout::find($id);
            $workout->delete();
    
            return redirect('/workouts')->with('success', 'Workout deleted!');
        } else {
            
            return redirect('/login');
        }
    }
}

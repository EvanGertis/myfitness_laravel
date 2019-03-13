<?php

namespace App\Http\Controllers;
use App\Workout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workouts = Workout::all();

        return view('workouts.index', compact('workouts'));
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

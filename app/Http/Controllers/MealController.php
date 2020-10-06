<?php

namespace App\Http\Controllers;

use App\Meal;
use App\Member;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $data['members'] = Member::pluck('name', 'id');
        $data['meals'] = Meal::with('member');

        if ($request->filled('date')){
            $data['meals']->whereDate('date', $request->date);
        }

        if ($request->filled('member')){
            $data['meals']->where('member_id', $request->member);
        }

        $data['meals'] = $data['meals']->paginate(30);

        return view('meal.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d'
        ]);


        foreach ($request->member_id ?? [] as $key => $member_id)
        {
            $memberDateCheck = Meal::where('date', $request->date)->where('member_id', $member_id)->count();

            if ($request->meal[$key] && $memberDateCheck == 0){

                Meal::create([

                    'member_id' => $member_id,
                    'date' => $request->date,
                    'meal' => $request->meal[$key],

                ]);
            }
        }

        return redirect()->back()->with('success', 'Meal Added Successful');
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
        //
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

        $request->validate([
            'update_date' => 'required|date_format:Y-m-d',
            'update_meal' => 'required|numeric',
        ]);

        Meal::where('id', $id)->update([

            'date' => $request->update_date,
            'meal' => $request->update_meal,

        ]);

        return redirect()->back()->with('success', 'Meal Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meal::destroy($id);

        return redirect()->back()->with('success', 'Meal Delete Successful');
    }
}

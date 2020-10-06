<?php

namespace App\Http\Controllers;

use App\Bazar;
use App\Member;
use Illuminate\Http\Request;

class BazarController extends Controller
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
        $data['bazars'] = Bazar::with('member');

        if ($request->filled('date')){
            $data['bazars']->whereDate('date', $request->date);
        }

        if ($request->filled('member')){
            $data['bazars']->where('member_id', $request->member);
        }

        $data['bazars'] =  $data['bazars']->paginate(30);

        return view('bazar.index',$data);
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
            'date' => 'required|date_format:Y-m-d',
            'member' => 'required|numeric',
            'bazar_amount' => 'required|numeric'
        ]);

        Bazar::create([

            'member_id' => $request->member,
            'date' => $request->date,
            'bazar_amount' => $request->bazar_amount,

        ]);

        return redirect()->back()->with('success', 'Bazar Added Successful');
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
            'update_bazar_amount' => 'required|numeric'
        ]);

        Bazar::where('id', $id)->update([

            'date' => $request->update_date,
            'bazar_amount' => $request->update_bazar_amount,

        ]);

        return redirect()->back()->with('success', 'Bazar Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bazar::destroy($id);

        return redirect()->back()->with('success', 'Bazar Delete Successful');
    }
}

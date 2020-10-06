<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index', [

            'members' => Member::paginate('30')

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

            'name' => 'required',
            'mobile' => 'required|numeric|unique:members,mobile',

        ]);

        Member::create([

            'name' => $request->name,
            'mobile' => $request->mobile,

        ]);


        return redirect()->back()->with('success', 'Member Added Successful.');

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

            'update_name' => 'required',
            'update_mobile' => 'required|numeric|unique:members,mobile',

        ]);

        Member::where('id', $id)->update([

            'name' => $request->update_name,
            'mobile' => $request->update_mobile,

        ]);


        return redirect()->back()->with('success', 'Member Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            Member::destroy($id);

        }catch (\Exception $e){
            if ($e->getCode() == 23000){
                return redirect()->back()->with('error', 'You Can not delete this member because this member is use in another places.');
            }else{
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Member Delete Successful.');
    }
}

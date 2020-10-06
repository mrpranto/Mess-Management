<?php

namespace App\Http\Controllers;

use App\Bazar;
use App\Meal;
use App\Member;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        $data = [];
        $data['members'] = Member::pluck('name', 'id');
        $data['membersData'] = Member::query();
        $data['mealRate'] = 0;
        $totalBazar = Bazar::query();
        $totalMeal = Meal::query();
        if ($request->filled('from_date') && $request->filled('to_date')){
            $data['membersData']->with(['meals' => function($q) use($request){

                $q->whereBetween('date', [$request->from_date, $request->to_date]);

            }])->with(['bazars' => function($q) use($request){

                $q->whereBetween('date', [$request->from_date, $request->to_date]);

            }]);

            $totalBazar->whereBetween('date', [$request->from_date, $request->to_date]);
            $totalMeal->whereBetween('date', [$request->from_date, $request->to_date]);

        }

        if ($request->filled('member')) {
            $data['membersData']->where('id', $request->member);
        }

        $data['mealRate'] = $totalBazar->sum('bazar_amount') > 0 ? ($totalBazar->sum('bazar_amount') / $totalMeal->sum('meal')) : 0;
        $data['membersData'] = $data['membersData']->get();

        return view('report.index',$data);
    }
}

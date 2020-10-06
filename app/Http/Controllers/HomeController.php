<?php

namespace App\Http\Controllers;

use App\Bazar;
use App\Meal;
use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['memberCount'] = Member::count();
        $data['currentMonthTotalBazar'] = Bazar::whereBetween('date', [Carbon::parse(date('Y-m'))->firstOfMonth(), Carbon::parse(date('Y-m'))->lastOfMonth()])
                                        ->sum('bazar_amount');
        $data['currentMonthTotalMeal'] = Meal::whereBetween('date', [Carbon::parse(date('Y-m'))->firstOfMonth(), Carbon::parse(date('Y-m'))->lastOfMonth()])
                                        ->sum('meal');


        return view('home', $data);
    }
}

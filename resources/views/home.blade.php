@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Dashboard</h4>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Member</div>
                                <a href=""><div class="h5 mb-0 font-weight-bold text-gray-800">{{ $memberCount }}</div></a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Current Month Bazar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($currentMonthTotalBazar) .' /=' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Current Month Meal</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $currentMonthTotalMeal }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-utensils fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Meal Rate</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currentMonthTotalBazar > 0 && $currentMonthTotalMeal > 0 ? number_format($currentMonthTotalBazar / $currentMonthTotalMeal) .' /=' : 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--Row-->
    </div>
@endsection

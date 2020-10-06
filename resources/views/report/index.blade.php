@extends('layouts.master')
@section('title', 'Member')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Reports</h4>
        </div>

        <div class="row mb-3">

            <div class="col-sm-12 col-md-12">


                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">
                            <i class="fa fa-book"></i> Monthly Report
                        </h6>
                    </div>
                    <div class="card-body">

                        <form action="">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <label for="date" class="col-form-label">From Date</label>
                                        <div>
                                            <input type="text" class="form-control form-control-sm simpleDataInput" name="from_date" value="{{ request('from_date') }}" placeholder="Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <label for="date" class="col-form-label">From Date</label>
                                        <div>
                                            <input type="text" class="form-control form-control-sm simpleDataInput" name="to_date" value="{{ request('to_date') }}" placeholder="Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group  input-group-sm">
                                        <label for="date" class="col-form-label">Member</label>
                                        <div>
                                            <select name="member" class="form-control form-control-sm">
                                                <option value="">- Select Member -</option>

                                                @foreach($members as $key => $member)
                                                    <option {{ request('member') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $member }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-6 col-md-3">
                                    <label  class="col-form-label">&nbsp;</label>
                                    <div>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>
                                            <a href="{{ route('report.page') }}" class="btn btn-sm btn-info"><i class="fa fa-recycle"></i> Refresh</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @if (request('from_date') && request('to_date'))

                            <div class="table-responsive-sm">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Total Meal</th>
                                        <th>Total Bazar</th>
                                        <th>Meal Rate</th>
                                        <th>Total Cost</th>
                                        <th>Return Back</th>
                                        <th>Mess Back</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $totalMeal = 0;
                                        $totalBazar = 0;
                                        $totalCost = 0;
                                        $totalReturnBack = 0;
                                        $totalMessBack = 0;
                                    @endphp
                                    @foreach($membersData as $key => $member)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->mobile }}</td>
                                            <td>{{ $member->meals->sum('meal') }}</td>
                                            <td>{{ $member->bazars->sum('bazar_amount') }}</td>
                                            <td>{{ number_format($mealRate, 2) }}</td>
                                            <td>{{ number_format($member->meals->sum('meal') * $mealRate) }}</td>
                                            <td>
                                                @php
                                                    $returnBack = number_format($member->bazars->sum('bazar_amount') - ($member->meals->sum('meal') * $mealRate));
                                                @endphp
                                                {{ $returnBack > 0 ? $returnBack : '' }}
                                            </td>
                                            <td>
                                                @php
                                                    $messBack = ($member->bazars->sum('bazar_amount') - ($member->meals->sum('meal') * $mealRate));
                                                @endphp
                                                {{ $messBack < 0 ? number_format(abs($messBack)) : '' }}
                                            </td>
                                        </tr>
                                        @php
                                            $totalReturnBack += ($member->bazars->sum('bazar_amount') - ($member->meals->sum('meal') * $mealRate)) > 0 ? ($member->bazars->sum('bazar_amount') - ($member->meals->sum('meal') * $mealRate)) : 0;
                                            $totalMessBack += ($member->bazars->sum('bazar_amount') - ($member->meals->sum('meal') * $mealRate)) < 0 ? ($member->bazars->sum('bazar_amount') - ($member->meals->sum('meal') * $mealRate)) : 0 ;
                                            $totalMeal += $member->meals->sum('meal');
                                            $totalBazar += $member->bazars->sum('bazar_amount');
                                            $totalCost += ($member->meals->sum('meal') * $mealRate);
                                        @endphp
                                    @endforeach

                                    <tr>
                                        <th colspan="3">Total :-</th>
                                        <th>{{ number_format($totalMeal) }}</th>
                                        <th>{{ number_format($totalBazar) }}</th>
                                        <td></td>
                                        <th>{{ number_format($totalCost) }}</th>
                                        <th>{{ number_format($totalReturnBack) }}</th>
                                        <th>{{ number_format(abs($totalMessBack)) }}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        @endif
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection

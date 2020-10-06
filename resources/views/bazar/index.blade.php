@extends('layouts.master')
@section('title', 'Bazar')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Bazars</h4>
        </div>

        <div class="row mb-3">

            <div class="col-sm-12 col-md-8 offset-md-2">

                @if (session()->get('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                        <b><i class="fa fa-check-circle"></i> Success !</b>
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if (session()->get('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                        <b><i class="fa fa-times"></i> Error !</b>
                        {{ session()->get('error') }}
                    </div>
                @endif



                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">
                            <i class="fa fa-plus"></i> Add Bazar
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bazar.store') }}" method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="date" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control simpleDataInput @error('date') is-invalid @enderror" name="date" value="{{ date('Y-m-d') }}" placeholder="Date">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="meal" class="col-sm-3 col-form-label">Member</label>
                                <div class="col-sm-9">

                                    <select name="member" class="form-control" id="">
                                        <option value="">- Select Member -</option>

                                        @foreach($members as $key => $member)
                                            <option value="{{ $key }}">{{ $member }}</option>
                                        @endforeach
                                    </select>

                                    @error('member')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bazar_amount" class="col-sm-3 col-form-label">Bazar Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('bazar_amount') is-invalid @enderror" step="0.01" name="bazar_amount" id="bazar_amount" min="0">
                                    @error('bazar_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-sm-12 col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">
                            <i class="fa fa-list"></i> Bazar List
                        </h6>
                    </div>
                    <div class="card-body">

                        <form action="">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="date" class="col-form-label">Date</label>
                                        <div>
                                            <input type="text" class="form-control form-control-sm simpleDataInput" name="date" value="{{ request('date') }}" placeholder="Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
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
                                <div class="col-sm-6 col-6 col-md-2">
                                    <label for="date" class="col-form-label">&nbsp;</label>
                                    <div>
                                        <button class="btn btn-sm btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-6 col-md-2">
                                    <label for="date" class="col-form-label">&nbsp;</label>
                                    <div>
                                        <a href="{{ route('bazar.index') }}" class="btn btn-sm btn-info btn-block"><i class="fa fa-recycle"></i> Refresh</a>
                                    </div>
                                </div>
                            </div>
                        </form>



                        <div class="table-responsive-sm mt-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Bazar Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($bazars as $key => $bazar)

                                    <tr>
                                        <td>{{ $bazars->firstItem()+$key }}</td>
                                        <td>{{ $bazar->member->name }}</td>
                                        <td>{{ date('F d,Y', strtotime($bazar->date)) }}</td>
                                        <td>{{ $bazar->bazar_amount }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button data-toggle="modal" data-target="#editMeal{{ $bazar->id }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Edit</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteCheck({{ $bazar->id }})"><i class="fa fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <form action="{{ route('bazar.destroy', $bazar->id) }}" method="post" id="deleteForm_{{ $bazar->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                @empty

                                    <tr>
                                        <th class="text-center" colspan="5">No Bazar Found</th>
                                    </tr>


                                @endforelse

                                </tbody>
                            </table>

                        </div>

                    </div>

                    <div class="card-footer">
                        {{ $bazars->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>

    @foreach($bazars as $key => $bazar)

        <div class="modal fade" id="editMeal{{ $bazar->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <i class="fa fa-pencil-alt"></i> Edit {{ $bazar->member->name }} Bazar
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('bazar.update', $bazar->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="date" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control simpleDataInput @error('update_date') is-invalid @enderror" name="update_date" value="{{ old('update_date') ?: $bazar->date }}" placeholder="Date">
                                    @error('update_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="update_bazar_amount" class="col-sm-3 col-form-label">Bazar Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('update_bazar_amount') is-invalid @enderror" name="update_bazar_amount" value="{{ old('update_bazar_amount') ?: $bazar->bazar_amount }}" id="update_bazar_amount" min="0">
                                    @error('update_bazar_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endforeach

@endsection

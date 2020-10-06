@extends('layouts.master')
@section('title', 'Members')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Members</h4>
        </div>

        <div class="row mb-3">

            <div class="col-sm-12 col-md-6 offset-md-3">

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
                            <i class="fa fa-plus"></i> Add New Member
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('member.store') }}" method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Mobile">
                                    @error('mobile')
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
            <div class="col-sm-12 col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">
                            <i class="fa fa-list"></i> Member List
                        </h6>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($members as $key => $member)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->mobile }}</td>
                                        <td>
                                            <div class="btn-group btn-circle">
                                                <button data-toggle="modal" data-target="#editMember{{ $member->id }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Edit</button>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteCheck({{ $member->id }})"><i class="fa fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <form action="{{ route('member.destroy', $member->id) }}" method="post" id="deleteForm_{{ $member->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                @empty
                                    <tr>
                                        <th colspan="4">No Members Found</th>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>

                        @foreach($members as $key => $member)

                        <div class="modal fade" id="editMember{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <i class="fa fa-pencil-alt"></i> Edit Member
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('member.update', $member->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">

                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control @error('update_name') is-invalid @enderror" name="update_name" id="name" value="{{ $member->name }}">
                                                    @error('update_name')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control @error('update_mobile') is-invalid @enderror" name="update_mobile" id="mobile" value="{{ $member->mobile }}">
                                                    @error('update_mobile')
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


                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
@endsection

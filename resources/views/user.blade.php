@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-black-50">Users</h3>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                @if (Auth::user()->role_id == 0)
                <div class="pull-left">
                    <button class="" data-toggle="modal" data-target="#addUsers"><i class="fa fa-plus"></i><span class="btn-text ie-jump">add</span>
                    </button>
                </div>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="">
                            <table id="eshoppy-users-table" class="table table-hover display  pb-30">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="addUsers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog w-500">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h5 class="modal-title">Add user</h5>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>'adduser', 'method'=>'POST', 'id' => 'add_user_form')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Name<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="name" id='add_user_name' />
                            <div class="help-block name-error"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Email<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="email" id='add_user_email' />
                            <div class="help-block email-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Password<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="password" id='add_user_password' />
                            <div class="help-block password-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label class="control-label">Role</label>
                            <select class="form-control selectpicker" data-style="form-control" name="user_role" id="add_user_role">
                                <option value="0">Admin</option>
                                <option value="1">User</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label class="mw-unset status-block">status</label>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="add_checkbox" name="is_active" id="is_active" value="1" checked="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" data-table="eshoppy-users-table" onclick="submitForm(this)" data-redirect="{{ url('/') }}">Save</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>
<div id="editUser" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog w-500">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h5 class="modal-title">Edit User</h5>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>'updateuser', 'method'=>'POST', 'id' => 'edit_user_form')) }}
                <input type="hidden" name="id" value="" id="user_id">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Name<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="name" id="user_name" value="" />
                            <div class="help-block name-error"></div>
                        </div>
                        <div class="col-sm-10">
                            <label for="" class="control-label">Email<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="email" id="user_email" value="" />
                            <div class="help-block email-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label class="control-label">Role</label>
                            <select class="form-control selectpicker" data-style="form-control" name="user_role" id="edit_user_role">
                                <option value="0">Admin</option>
                                <option value="1">User</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label class="mw-unset status-block">status</label>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="edit_checkbox" data-color="#65b32e" data-secondary-color="#ccc" name="is_active" value="1">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-table="eshoppy-users-table" onclick="submitForm(this)" data-redirect="{{ url('/') }}">Save</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    @endsection
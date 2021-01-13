@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-black-50">Category</h3>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <button class="" data-toggle="modal" data-target="#addCategory"><i class="fa fa-plus"></i><span class="btn-text ie-jump">add</span>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="">
                            <table id="eshoppy-category-table" class="table table-hover display  pb-30">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
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
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog w-500">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h5 class="modal-title">Add Category</h5>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>'addCategory', 'method'=>'POST', 'id' => 'add_category_form')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Category<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="category" id='add_category_name' />
                            <div class="help-block category-error"></div>
                        </div>
                        <div class="col-sm-2">
                            <label class="mw-unset status-block">status</label>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="edit_checkbox" name="is_active" id="is_active" value="1" checked="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-table="eshoppy-category-table" onclick="submitForm(this)" data-redirect="{{ url('/') }}">Save</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
</div>
<div id="editCategory" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog w-500">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h5 class="modal-title">Edit Category</h5>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>'updatecategory', 'method'=>'POST', 'id' => 'edit_category_form')) }}
                <input type="hidden" name="id" value="" id="category_id">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Category<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="category" id="category_name" value="" />
                            <div class="help-block category-error"></div>
                        </div>
                        <div class="col-sm-2">
                            <label class="mw-unset status-block">status</label>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="edit_category" data-color="#65b32e" data-secondary-color="#ccc" name="is_active" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-table="eshoppy-category-table" onclick="submitForm(this)" data-redirect="{{ url('/') }}">Save</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
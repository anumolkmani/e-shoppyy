@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-black-50">Products</h3>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <button class="" data-toggle="modal" data-target="#addProducts"><i class="fa fa-plus"></i><span class="btn-text ie-jump">add</span>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="">
                            <table id="eshoppy-products-table" class="table table-hover display  pb-30">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product</th>
                                        <th>status</th>
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
<div id="addProducts" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog w-500">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h5 class="modal-title">Add Product</h5>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>'addProduct', 'method'=>'POST', 'id' => 'add_product_form')) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Category<sup class="mandatory">*</sup></label>
                            <select class="form-control selectpicker" data-style="form-control" name="category" id="select_category_name">
                                <option value="0">choose an option</option>
                                @foreach($categories as $key => $category)
                                <option value="{{$category['id']}}">{{$category['category']}}</option>
                                @endforeach
                            </select>
                            <div class="help-block category-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Product<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="product" id='add_product_name' />
                            <div class="help-block product-error"></div>
                        </div>
                        <div class="col-sm-2">
                            <label class="mw-unset status-block">status</label>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="add_checkbox" name="is_active" id="is_active" value="1" checked="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-table="eshoppy-products-table" onclick="submitForm(this)" data-redirect="{{ url('/') }}">Save</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="editProduct" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog w-500">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h5 class="modal-title">Edit Product</h5>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>'updateproduct', 'method'=>'POST', 'id' => 'edit_product_form')) }}
                <input type="hidden" name="category_id" value="" id="category_id">
                <input type="hidden" name="product_id" value="" id="product_id">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Category<sup class="mandatory">*</sup></label>
                            <select class="form-control selectpicker" data-style="form-control" name="category" id="edit_select_category_name">
                                @foreach($categories as $key => $category)
                                <option value="{{$category['id']}}">{{$category['category']}}</option>
                                @endforeach
                            </select>
                            <div class="help-block category-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="" class="control-label">Product<sup class="mandatory">*</sup></label>
                            <input type="text" class="form-control" name="product" id="edit_product_name" value="" />
                            <div class="help-block product-error"></div>
                        </div>
                        <div class="col-sm-2">
                            <label class="mw-unset status-block">status</label>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="edit_product" data-color="#65b32e" data-secondary-color="#ccc" name="is_active" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-table="eshoppy-products-table" onclick="submitForm(this)" data-redirect="{{ url('/') }}">Save</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@extends('laravel_tagable::backend.layouts.master')
@section('page_title')
    Laravel Tag Manager
@stop
@section('custom_plugin_js')
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center">مدیریت تگ ها</div>
            <div class="card-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-bottom" id="tag_tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" href="#manage_tab" data-toggle="tab"><i class="fas fa-th-list"></i><span class="margin_right_5">مدیریت تگ ها</span></a></li>
                        <li class="nav-item add_tag_tab">
                            <a class="nav-link" href="#add_tag" data-toggle="tab">
                                <i class="far fa-plus-square"></i>
                                <span>افزودن</span>
                            </a>
                        </li>
                        <li class="nav-item edit_tag_tab hidden">
                            <a href="#edit_tag" class="nav-link paddin_left_30" data-toggle="tab">
                                <span class="span_edit_tag_tab">ویرایش</span>
                            </a>
                            <button class="close closeTab cancel_edit_tag" type="button">×</button>
                        </li>
                        <li class="nav-item manage_tag_item_tab hidden">
                            <a href="#manage_tab_item" class="nav-link paddin_left_30" data-toggle="tab">
                                <span class="span_manage_tag_item_tab">مدیریت تصاویر</span>
                            </a>
                            <button class="close closeTab cancel_manage_tag_item" type="button">×</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="manage_tab">
                            <div>
                                <div class="space-20"></div>
                                <div class="col-xs-12 tag_manager_parrent_div">
                                    <table id="TagManagerGridData" class="table " width="100%"></table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="add_tag">
                            <div class="space-20"></div>
                            <form id="frm_create_tag" class="form-horizontal" name="frm_create_tag">
                                @if($multi_lang)
                                <div class="form-group row fg_lang">
                                    <label class="col-sm-2 control-label col-form-label label_post" for="lang">
                                        <span class="more_info"></span>
                                        <span class="label_lang">انتخاب زبان</span>
                                    </label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="lang_id" id="FaqSelectLang">
                                            <option value="-1">انتخاب زبان</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 messages"></div>
                                </div>
                                @endif
                                <div class="form-group row fg_title">
                                    <label class="col-sm-2 control-label col-form-label label_post" for="title">
                                        <span class="more_info"></span>
                                        <span class="label_title">عنوان</span>
                                    </label>
                                    <div class="col-sm-6">
                                        <input name="title" class="form-control" id="tag_title" tab="1">
                                    </div>
                                    <div class="col-sm-4 messages"></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-12 col-md-3 control-label col-form-label label_post" for="description">توضیحات</label>
                                    <div class="col-6">
                                        <textarea class="form-control" name="description" id="tag_description" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="clearfixed"></div>
                                <div class="col-12">
                                    <button type="submit" class="float-right btn btn-success ml-2"><i class="fa fa-save margin_left_8"></i>ذخیره</button>
                                    <button type="button" class="float-right btn bg-secondary color_white cancel_add_close_btn"><i class="fa fa-times margin_left_8"></i>انصراف</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="edit_tag"></div>
                        <div class="tab-pane" id="manage_tab_item">
                            <div class="space-20"></div>
                                <div class="tabbable">
                                    <ul class="nav nav-tabs nav-tabs-bottom" id="tag_tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#manage_tab_tag_item" data-toggle="tab">
                                                <i class="fas fa-th-list"></i>
                                                <span class="margin_right_5">مدیریت آیتم ها</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" id="add_tag_item_tab">
                                            <a class="nav-link" href="#add_tag_item" data-toggle="tab">
                                                <i class="far fa-plus-square"></i>
                                                <span>افزودن آیتم</span>
                                            </a>
                                        </li>
                                        <li class="nav-item edit_tag_item_tab hidden">
                                            <a href="#edit_tag_item" class="nav-link paddin_left_30" data-toggle="tab">
                                                <span class="span_edit_tag_item_tab">ویرایش</span>
                                            </a>
                                            <button class="close closeTab cancel_edit_tag_item_tab" type="button">×</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="manage_tab_tag_item"></div>
                                        <div class="tab-pane" id="add_tag_item"></div>
                                        <div class="tab-pane" id="edit_tag_item"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('inline_js')
    @include('laravel_tagable::backend.helper.inline_js')
@stop
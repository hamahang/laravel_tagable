<script>
    //get gallery
    window['tag_grid_columns'] = [
        {
            width: '5%',
            data: 'id',
            title: 'ردیف',
            searchable: false,
            sortable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'id',
            name: 'id',
            title: 'آی دی',
            visible: false
        },
        {
            width: '20%',
            data: 'title',
            name: 'title',
            title: 'عنوان'
        },
        {
            width: '20%',
            data: 'description',
            name: 'description',
            title: 'توضیحات'
        },

        {
            width: '25%',
            data: 'created_by',
            name: 'created_by',
            title: 'ایجاد شده توسط',
            mRender: function (data, type, full) {
                if (full.user && full.user.name) {
                    return '<span>' + full.user.name + '<span>';
                }
                else
                    return '<span><span>';
            }
        },
        {
            width: '5%',
            data: 'is_active',
            name: 'is_active',
            title: 'وضعیت',
            mRender: function (data, type, full) {
                var ch = '';
                if (parseInt(full.is_active))
                    ch = 'checked';
                else
                    ch = '';
                return '<input class="styled " id="' + full.id + '" type="checkbox" name="special" data-item_id="' + full.id + '"  onchange="change_status_tag(this)"' + ch + '>'
            }
        },
        {
            width: '7%',
            searchable: false,
            sortable: false,
            data: 'action', name: 'action', 'title': 'عملیات',
            mRender: function (data, type, full) {
                return '' +
                    '<div class="gallerty_menu float-right pointer" onclick="set_fixed_dropdown_menu(this)" data-toggle="dropdowns">' +
                    '<span>' +
                    '   <em class="fas fa-caret-down"></em>' +
                    '   <i class="fas fa-bars"></i> ' +
                    '</span>' +
                    '  <div class="dropdown_gallery hidden">' +
                    '   <a class="btn_edit_tag pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + '">' +
                    '       <i class="fa fa-edit"></i><span class="ml-2">ویرایش</span>' +
                    '   </a>' +
                    '    <a class="btn_trash_tag pointer gallery_menu-item" data-item_id="' + full.id + '" data-title="' + full.title + ' ">' +
                    '       <i class="fa fa-trash"></i><span class="ml-2">حذف</span>' +
                    '   </a>'
                '  </div>' +
                '</div>';

            }
        }
    ];
    $(document).ready(function () {
        datatable_load_fun();
    });

    /*___________________________________________________Add Gallery_____________________________________________________________________*/
    $(document).off("click", ".cancel_add_close_btn");
    $(document).on("click", ".cancel_add_close_btn", function () {
        clear_form_elements('#frm_create_tag');
        $('a[href="#manage_tab"]').click();
    });
    var create_tag_constraints = {
        title: {
            presence: {message: '^<strong>عنوان فرم ضروریست.</strong>'}
        },
    };
    var create_tag_form_id = document.querySelector("#frm_create_tag");
    init_validatejs(create_tag_form_id, create_tag_constraints, ajax_func_create_tag);

    function ajax_func_create_tag(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LTS.saveTag')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#frm_create_tag .total_loader').remove();
                if (data.success) {
                    var form_element = $("#frm_create_tag");
                    form_element.find('select').val('').trigger('change');
                    clear_form_elements('#frm_create_tag');
                    menotify('success', data.title, data.message);
                    TagManagerGridData.ajax.reload(null, false);
                    $('a[href="#manage_tab"]').click();
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }

    /*___________________________________________________Add tag_____________________________________________________________________*/
    $(document).off("click", ".btn_edit_tag");
    $(document).on("click", ".btn_edit_tag", function () {
        var item_id = $(this).data('item_id');
        var title = $(this).data('title');
        $('.span_edit_tag_tab').html('ویرایش : ' + title);
        get_edit_tag_form(item_id);
    });

    function get_edit_tag_form(item_id) {
        $('#edit_tag').children().remove();
        $('#edit_tag').append(generate_loader_html('لطفا منتظر بمانید...'));
        $.ajax({
            type: "POST",
            url: '{{ route('LTS.getEditTagForm')}}',
            dataType: "json",
            data: {
                item_id: item_id
            },
            success: function (result) {
                $('#edit_tag .total_loader').remove();
                if (result.success) {
                    $('#edit_tag').append(result.Tag_edit_view);
                    $('.edit_tag_tab').removeClass('hidden');
                    $('a[href="#edit_tag"]').click();

                    var edit_tag_form_id = document.querySelector("#frm_edit_tag");
                    init_validatejs(edit_tag_form_id, create_tag_constraints, ajax_func_edit_tag);
                }
                else {
                }
            }
        });
    }

    function ajax_func_edit_tag(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LTS.editTag')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#frm_edit_tag .total_loader').remove();
                if (data.success) {
                    menotify('success', data.title, data.message);
                    TagManagerGridData.ajax.reload(null, false);
                    $('a[href="#manage_tab"]').click();
                    $('.edit_tag_tab').addClass('hidden');
                    $('#edit_tag').html('');

                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }

    /*___________________________________________________Edit tag_____________________________________________________________________*/

    $(document).off("click", ".cancel_edit_tag");
    $(document).on("click", ".cancel_edit_tag", function () {
        $('a[href="#manage_tab"]').click();
        $('.edit_tag_tab').addClass('hidden');
        $('#edit_tag').html('');
    });
    /*___________________________________________________init select2_____________________________________________________________________*/

    /*___________________________________________________Trash tag_____________________________________________________________________*/

    $(document).off("click", ".btn_trash_tag");
    $(document).on("click", ".btn_trash_tag", function () {
        var item_id = $(this).data('item_id');
        var title = $(this).data('title');
        desc = 'بله تگ( ' + title + ' ) را حذف کن !';
        var parameters = {item_id: item_id};
        yesNoAlert('حذف تگ', 'از حذف تگ مطمئن هستید ؟', 'warning', desc, 'لغو', trash_tag, parameters);
    });

    function trash_tag(params) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{!!  route('LTS.trashTag') !!}',
            data: params,
            success: function (data) {
                if (data.success) {
                    menotify('success', data.title, data.message);
                    TagManagerGridData.ajax.reload(null, false);
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }

    /*___________________________________________________Change is_active_____________________________________________________________________*/
    function change_status_tag(input) {
        var checked = input.checked;
        var item_id = input.id;
        var parameters = {is_active: checked, item_id: item_id};
        yesNoAlert('تغییر وضعیت تگ', 'از تغییر وضعیت تگ مطمئن هستید ؟', 'warning', 'بله، وضعیت تگ را تغییر بده!', 'لغو', set_tag_is_active, parameters, remove_checked, parameters);
    }

    function set_tag_is_active(params) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{!!  route('LTS.setTagStatus') !!}',
            data: params,
            success: function (result) {
                if (result.success) {
                    menotify('success', result.title, result.message);
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }

    function remove_checked(params) {
        var $this = $('#' + params.item_id);
        if (params.is_active) {
            $this.prop('checked', false);
        }
        else {
            $this.prop('checked', true);
        }
    }

    $('#LTS_showThumbImage').tooltip({
        animated: 'fade',
        placement: 'bottom',
        html: true
    });
    /*___________________________________________________Tooltip_____________________________________________________________________*/
    $(document).on('mouseenter', '#LTS_showThumbImage', function () {
        var image_name = $(this).data('image');
        var imageTag = '<div style="position:fixed;">' + '<img src="' + image_name + '" alt="image" height="100" />' + '</div>';
        $(this).parent('div').append(imageTag);
    });
    $(document).on('mouseleave', '#LTS_showThumbImage', function () {
        $(this).parent('div').children('div').remove();
    });

    /*___________________________________________________FixedColumn_____________________________________________________________________*/
    function set_fixed_dropdown_menu(e) {
        $(e).find('.dropdown_gallery').toggleClass('hidden');
        var position = $(e).offset();
        var position2 = $(e).position();
        var scrollTop = $(document).scrollTop();
        var scrollLeft = $(document).scrollLeft();
        var drop_height = $(e).find('.dropdown_gallery').height() + 16;
        if (($(window).height() - position.top) > drop_height) {
            $(e).find('.dropdown_gallery').css({'position': 'fixed', 'top': position.top - scrollTop + 16, 'left': Math.abs(position.left) + 20, 'height': 'fit-content'});
            window.addEventListener("scroll", function (event) {
                var scroll = this.scrollY;
                $(e).find('.dropdown_gallery').css('top', position.top - scroll + 16)
            });
        }
        else {
            $(e).find('.dropdown_gallery').css({'position': 'fixed', 'top': position.top - scrollTop + 16 - drop_height, 'left': Math.abs(position.left) + 20, 'height': 'fit-content'});
            window.addEventListener("scroll", function (event) {
                var scroll = this.scrollY;
                $(e).find('.dropdown_gallery').css('top', position.top - scroll + 16 - drop_height)
            });
        }
    }
    $(window).click(function(e) {
        if (!$(e.target).closest(".gallerty_menu ").length > 0) {
            $('.dropdown_gallery').addClass('hidden');
        }
    });
    /*___________________________________________________DataTable_____________________________________________________________________*/

    function datatable_load_fun() {
        var getTagRoute = '{{ route('LTS.getTag') }}';
        dataTablesGrid('#TagManagerGridData', 'TagManagerGridData', getTagRoute, tag_grid_columns,false);
    }

    /*___________________________________________________init select2_____________________________________________________________________*/
    init_select2_data('#FaqSelectLang',{!! $multi_lang !!});
</script>
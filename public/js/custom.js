//Datatable for users
var usersTable = $("#eshoppy-users-table").DataTable({
    "destroy": true,
    "aProcessing": true,
    "aServerSide": true,
    "deferRender": true,
    responsive: true,
    "ajax": {
        "url": "getusers",
        "dataSrc": ""
    },
    'fnCreatedRow': function (nRow, aData, iDataIndex) {
        $(nRow).attr('id', 'user-' + aData.id);
    },
    "columns": [{
        "render": function (data, type, row, meta) {
            return meta.row + 1;
        }
    },
    {
        "render": function (data, type, content, meta) {
            return content.name;
        }
    },

    {
        sortable: true,
        "width": "20%",
        "render": function (data, type, content, meta) {
            return content.email;

        }
    },
    {
        sortable: true,
        "width": "20%",
        "render": function (data, type, content, meta) {
            if (content.role_id == 1) {
                return "User";
            } else {
                return "Admin";
            }
        }
    },
    {
        sortable: true,
        "width": "20%",
        "render": function (data, type, content, meta) {
            if (content.is_active == 1) {
                return "Active";
            } else {
                return "Inactive";
            }
        }
    },
    {
        sortable: false,
        "render": function (data, type, content, meta) {
            return '<a class="btn btn-xs btn-warning btn-edit" onclick="editUser(' + content.id + ')">\n\
                        <i class="fa fa-pencil" title="edit"></i></a>\n\
                        <button class="btn btn-xs btn-danger btn-delete"  data-url="deleteuser" onclick="deletefunc(this)" data-message="deleted successfully" \n\
                        data-table="eshoppy-users-table" data-confirm_message="Are you Sure" data-id="' + content.id + '">\n\
                        <i class="fa fa-trash" title="delete"></i>\n\
                        </button>';
        }
    }
    ]
});

//function for filling edit user
function editUser(id) {
    $('#user_id').val(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user/edit/' + id,
        type: 'get',
        success: function (data) {
            console.log(data[0]['role_id']);
            $('#user_name').val(data[0]['name']);
            $('#user_email').val(data[0]['email']);
            $('#edit_user_role').val(data[0]['role_id']).trigger('change');
            if (data[0]['is_active'] == 1) {
                $('.edit_checkbox').attr('checked', true);
            } else {
                $('.edit_checkbox').attr('checked', false);
            }
            $('#editUser').modal('show');
        }
    });
}

// General function for normal form submit
window.submitForm = function (element) {
    $('.help-block').html('');
    var formId = $(element).closest('form').attr('id');
    var actionUrl = $(element).closest('form').attr('action');
    var method = $(element).closest('form').attr('method');
    var formData = new FormData($('#' + formId)[0]);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: actionUrl,
        type: method,
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.errors) {
                $.each(data.errors, function (key, val) {
                    $("." + key + "-error").text(val[0]);
                });
            }
            if (data.success) {
                window.location.reload();
            }
        }
    });
}

// General function for delete
window.deletefunc = function (element) {
    var actionUrl = $(element).data('url');
    var id = $(element).data('id');
    var message = $(element).data('message');
    var confirm_message = $(element).data('confirm_message');
    var cancel = $(element).data('cancel');
    var cancel_message = $(element).data('cancel_message');
    swal({
        title: 'Are you sure',
        text: confirm_message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#e40000",
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes',
        closeOnConfirm: false,
    }, function (result) {
        if (result) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: actionUrl + '/' + id,
                method: 'POST',
                success: function (response) {
                    if (response == 1) {
                        swal({
                            title: 'Deleted Successfully',
                            text: message,
                            type: 'success',
                            confirmButtonColor: "#e40000",
                            confirmButtonText: 'Ok',
                        }, function (result) {
                            window.location.reload();
                        });
                    } else {
                        swal(cancel, cancel_message, "error");
                    }
                }
            });
        }
    });
}

//Datatable for product category
var categoryTable = $("#eshoppy-category-table").DataTable({
    "destroy": true,
    "aProcessing": true,
    "aServerSide": true,
    "deferRender": true,
    responsive: true,
    "ajax": {
        "url": "getcategory",
        "dataSrc": ""
    },
    'fnCreatedRow': function (nRow, aData, iDataIndex) {
        $(nRow).attr('id', 'category-' + aData.id);
    },
    "columns": [{
        "render": function (data, type, row, meta) {
            return meta.row + 1;
        }
    },
    {
        "render": function (data, type, content, meta) {
            return content.category;
        }
    },
    {
        sortable: true,
        "width": "20%",
        "render": function (data, type, content, meta) {
            if (content.is_active == 1) {
                return "Active";
            } else {
                return "Inactive";
            }
        }
    },
    {
        sortable: false,
        "render": function (data, type, content, meta) {
            return '<a class="btn btn-xs btn-warning btn-edit" onclick="editCategory(' + content.id + ')">\n\
                        <i class="fa fa-pencil" title="edit"></i></a>\n\
                        <button class="btn btn-xs btn-danger btn-delete"  data-url="deletecategory" onclick="deletefunc(this)" data-message="deleted successfully" \n\
                        data-table="eshoppy-category-table" data-confirm_message="Are you Sure" data-id="' + content.id + '">\n\
                        <i class="fa fa-trash" title="delete"></i>\n\
                        </button>';
        }
    }
    ]
});

//function for filling edit category form
function editCategory(id) {
    $('#category_id').val(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/category/edit/' + id,
        type: 'get',
        success: function (data) {
            $('#category_name').val(data[0]['category']);
            if (data[0]['is_active'] == 1) {
                $('.edit_category').attr('checked', true);
            } else {
                $('.edit_category').attr('checked', false);
            }
            $('#editCategory').modal('show');
        }
    });
}

//Datatable for products
var categoryTable = $("#eshoppy-products-table").DataTable({
    "destroy": true,
    "aProcessing": true,
    "aServerSide": true,
    "deferRender": true,
    responsive: true,
    "ajax": {
        "url": "getproducts",
        "dataSrc": ""
    },
    'fnCreatedRow': function (nRow, aData, iDataIndex) {
        $(nRow).attr('id', 'product-' + aData.id);
    },
    "columns": [{
        "render": function (data, type, row, meta) {
            return meta.row + 1;
        }
    },
    {
        "render": function (data, type, content, meta) {
            return content.product;
        }
    },
    {
        sortable: true,
        "width": "20%",
        "render": function (data, type, content, meta) {
            if (content.is_active == 1) {
                return "Active";
            } else {
                return "Inactive";
            }
        }
    },
    {
        sortable: false,
        "render": function (data, type, content, meta) {
            return '<a class="btn btn-xs btn-warning btn-edit" onclick="editProduct(' + content.id + ')">\n\
                        <i class="fa fa-pencil" title="edit"></i></a>\n\
                        <button class="btn btn-xs btn-danger btn-delete"  data-url="deleteproduct" onclick="deletefunc(this)" data-message="deleted successfully" \n\
                        data-table="eshoppy-category-table" data-confirm_message="Are you Sure" data-id="' + content.id + '">\n\
                        <i class="fa fa-trash" title="delete"></i>\n\
                        </button>';
        }
    }
    ]
});

//function for filling edit category form
function editProduct(id) {
    $('#product_id').val(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/product/edit/' + id,
        type: 'get',
        success: function (data) {
            $('#edit_select_category_name').val(data[0]['category']).trigger('change');
            $('#edit_product_name').val(data[0]['product']);
            if (data[0]['is_active'] == 1) {
                $('.edit_product').attr('checked', true);
            } else {
                $('.edit_product').attr('checked', false);
            }
            $('#editProduct').modal('show');
        }
    });
}




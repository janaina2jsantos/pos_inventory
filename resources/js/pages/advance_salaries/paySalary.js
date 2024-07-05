function getEmployees() {
    $.ajax({
        method: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/ajax/pay-salary',
        dataType: 'json',
        success: function(response) {
            setUpTable(response);
        },
        error: function(error) {
            return;
        }
    });
}

function setUpTable(data) {
    var datatable = $('.datatable-pay-salary').KTDatatable({
        data: {
            source: data,
            map: function(raw) {
                var dataSet = raw;
                if (typeof raw.data !== 'undefined') {
                    dataSet = raw.data;
                }
                return dataSet;
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },
        layout:
        {
            scroll: true,
            footer: false
        },
        sortable: true,
        pagination: true,
        search: {
            input: $('#kt_datatable_search_query'),
            key: 'generalSearch'
        },
        columns: [
        {
            field: 'id',
            title: '#',
            sortable: 'DESC',
            width: 40,
            type: 'number',
            selector: false,
            textAlign: 'center',
        },
        {
            field: 'employee',
            title: 'Employee',
        },
        {
            field: 'salary',
            title: 'Salary',
            width: 90,
            textAlign: 'center',
            template: function(row) {
                return '$' + row.salary;
            }
        },
        {
            field: 'month',
            title: 'Month',
            width: 90,
            textAlign: 'center',
            template: function(row) {
                return moment(row.month, 'YYYY-MM').format('MMMM');
            },
        },
        {
            field: 'advance',
            title: 'Advance',
            width: 90,
            textAlign: 'center',
            template: function(row) {
                if (row.advance.length) {
                    if (!row.isPaid.length) {
                        return '<span class="label label-lg label-light-danger label-inline">$' + row.advance + '</span>';
                    }
                    else {
                        return '<span class="label label-lg label-light-success label-inline">$' + row.advance + '</span>';
                    }
                }
                else {
                    return '$0.00';
                }
            },
        },
        {
            field: 'photo',
            title: 'Photo',
            width: 80,
            textAlign: 'center',
            template: function(row) {
                if (row.photo) {
                    return '<img src="' + row.photo + '" alt="Employee Photo" width="90%" />';
                }
                else {
                    return '<img src="../../../dist/assets/img/users/default_avatar.jpg" alt="Employee Photo" width="85%" />';
                }
            },
        },    
        {
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 125,
            overflow: 'visible',
            autoHide: false,
            template: function(row) {
                if (!row.isPaid.length) {
                    return '\
                        <a href="#" class="btn btn-light-danger font-weight-bold mr-2" title="Edit" onclick="paySalaryToEmployee('+row.id+');">Pay Salary</a>\
                    ';
                }
                else {
                    return '\
                        <button class="btn btn-sm btn-secondary btn-paid" disabled><i class="fa-solid fa-check"></i> &nbsp;Paid</button>\
                    ';
                }
            },
        }],
    });
}

function paySalaryToEmployee(id) {
    Swal.fire({
        title: 'Are you sure you want to pay this employee?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel',
        customClass: "show-order",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/ajax/pay-salary/"+id,
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {"id": id}, 
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        Swal.fire(
                            'Success!',
                            response.message,
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    }
                    else {
                        Swal.fire(
                            'Error!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'There was an error while executing the action.',
                        'error'
                    );
                }
            });
        }
    });
}

$('#kt_datatable_search_query').on('keyup', function() {
    var word = $(this).val();
    $.ajax({
        url: '/ajax/pay-salary',
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'word': word},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-pay-salary").KTDatatable({});
                datatable.KTDatatable("destroy");
                setUpTable(response);
            }
            else {
                return false;
            }
        },
        error: function(error) {
            return;
        }
    });
});

$('#kt_datatable_search_month').on('change', function() {
    var month = $(this).val();
    $.ajax({
        url: '/ajax/pay-salary',
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'month': month},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-pay-salary").KTDatatable({});
                datatable.KTDatatable("destroy");
                setUpTable(response);
            }
            else {
                return false;
            }
        },
        error: function(error) {
            return;
        }
    });
});

$('#kt_datatable_search_button').on('click', function() {
    var word = $('#kt_datatable_search_query').val();
    var month = $('#kt_datatable_search_month').val();
    $.ajax({
        url: "/ajax/pay-salary",
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'search': true, 'word': word, 'month': month},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-pay-salary").KTDatatable({});
                datatable.KTDatatable("destroy");
                setUpTable(response);
            }
            else {
                return false;
            }
        },
        error: function(error) {
            return;
        }
    });
});

$(document).ready(function() {
    getEmployees();
});

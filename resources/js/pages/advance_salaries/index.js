function getAdvanceSalaries() {
    $.ajax({
        method: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/ajax/advance-salaries',
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
    var datatable = $('.datatable-advance-salaries').KTDatatable({
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
            field: 'employee_name',
            title: 'Employee',
            width: 150,
        },
        {
            field: 'employee_salary',
            title: 'Salary',
            width: 90,
            textAlign: 'center',
            template: function(row) {
                return '$' + row.employee_salary;
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
            field: 'advance_salary',
            title: 'Advance',
            width: 120,
            textAlign: 'center',
            template: function(row) {
                if ((row.isPaid.length > 0) && (moment(row.isPaid, 'YYYY-MM').format('YYYY-MM') == moment(row.month, 'YYYY-MM').format('YYYY-MM'))) {
                    return '<span class="label label-lg label-light-success label-inline">$' + row.advance_salary + '</span>';
                }
                else {
                    return '<span class="label label-lg label-light-danger label-inline">$' + row.advance_salary + '</span>';
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
                if ((row.isPaid) && (moment(row.isPaid, 'YYYY-MM').format('YYYY-MM') == moment(row.month, 'YYYY-MM').format('YYYY-MM'))) {
                    return '\
                        <a href="/advance-salaries/'+row.id+'/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <button class="btn btn-sm btn-secondary btn-paid" disabled><i class="fa-solid fa-check"></i> &nbsp;Paid</button>\
                    ';
                }
                else {
                    return '\
                        <a href="advance-salaries/'+row.id+'/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" onclick="deleteAdvanceSalary('+row.id+');">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                }
            },
        }],
    });
}

function deleteAdvanceSalary(id) {
    Swal.fire({
        title: 'Are you sure you want to delete this advance?',
        text: 'This action cannot be undone!',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel',
        customClass: "show-order",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/advance-salaries/"+id+"/delete",
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {method: '_DELETE', submit: true}, 
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
                        'There was an error while deleting the advance.',
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
        url: '/ajax/advance-salaries',
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'word': word},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-advance-salaries").KTDatatable({});
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
        url: '/ajax/advance-salaries',
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'month': month},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-advance-salaries").KTDatatable({});
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
    var status = $('#kt_datatable_search_status').val();
    $.ajax({
        url: "/ajax/advance-salaries",
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'search': true, 'word': word, 'status': status},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-advance-salaries").KTDatatable({});
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
    getAdvanceSalaries();
});

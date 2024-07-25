function getMonthlyExpenses() {
    $.ajax({
        method: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/ajax/expenses/monthly',
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
    var datatable = $('.datatable-expenses').KTDatatable({
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
            field: 'details',
            title: 'Details',
            width: 510,
        },
        {
            field: 'date',
            title: 'Date',
            width: 120,
        },
        {
            field: 'amount',
            title: 'Amount',
            width: 100,
            template: function(row) {
                return '$' + row.amount;
            }
        },
        ],
    });
}

$('#kt_datatable_search_query').on('keyup', function() {
    var word = $(this).val();
    var month = $('#kt_datatable_search_month').val();
    $.ajax({
        url: '/ajax/expenses/monthly',
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'word': word, 'month': month},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-expenses").KTDatatable({});
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
        url: '/ajax/expenses/monthly',
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'month': month},
        dataType: "json",
        success: function(response) {
            $('#expensesDate').text(moment(month, 'YYYY-MM').format('MMMM') + ' Expenses');
            if(response) {
                var datatable = $(".datatable-expenses").KTDatatable({});
                datatable.KTDatatable("destroy");
                setUpTable(response);
            }
            else {
                return false;
            }
        },
        error: function(xhr, status, error) {
            // console.log('Error: ' + error);
            return;
        }
    });
});

$('#kt_datatable_search_button').on('click', function() {
    var word = $('#kt_datatable_search_query').val();
    var month = $('#kt_datatable_search_month').val();
    $.ajax({
        url: "/ajax/expenses/monthly",
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'search': true, 'word': word, 'month': month},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-expenses").KTDatatable({});
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
    getMonthlyExpenses();
});

function getAttendances() {
    $.ajax({
        method: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/ajax/attendances',
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
    var datatable = $('.datatable-attendances').KTDatatable({
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
            field: 'count',
            title: 'SL',
            width: 40,
            textAlign: 'center',
        },
        {
            field: 'date',
            title: 'Date',
            width: 120,
        },
        {
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 125,
            overflow: 'visible',
            autoHide: false,
            template: function(row) {
                var date = moment(row.date, 'DD/MM/YYYY').format('YYYY-MM-DD');
                return '\
                    <a href="/attendances/'+date+'/show" class="btn btn-sm btn-clean btn-icon" title="Details">\
                        <span class="svg-icon svg-icon-md">\
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                    <polygon points="0 0 24 0 24 24 0 24"/>\
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>\
                                </g>\
                            </svg>\
                        </span>\
                    </a>\
                    <a href="/attendances/'+date+'/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">\
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
                ';
            },
        }],
    });
}

$('#kt_datatable_search_month').on('change', function() {
    var month = $(this).val();
    $.ajax({
        url: '/ajax/attendances',
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'month': month},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-attendances").KTDatatable({});
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
    var month = $('#kt_datatable_search_month').val();
    $.ajax({
        url: "/ajax/attendances",
        method: "GET",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'search': true, 'month': month},
        dataType: "json",
        success: function(response) {
            if(response) {
                var datatable = $(".datatable-attendances").KTDatatable({});
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
    getAttendances();
});

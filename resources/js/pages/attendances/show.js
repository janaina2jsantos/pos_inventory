function getAttendances() {
    var url = window.location.href.split("/");
    $.ajax({
        method: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/ajax/attendances/"+url[4]+"/show",
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
        // layout definition
        layout:
        {
            scroll: true,
            footer: false
        },
        // column sorting
        sortable: true,
        pagination: true,
        search: {
            input: $('#kt_datatable_search_query'),
            key: 'generalSearch'
        },
        // columns definition
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
            field: 'name',
            title: 'Employee',
            width: 280,
        },
        {
            field: 'photo',
            title: 'Photo',
            width: 80,
            template: function(row) {
                if (row.photo) {
                    return '<img src="' + row.photo + '" alt="Employee Photo" width="90%" />';
                }
                else {
                    return '<img src="../../../dist/assets/img/misc/default_avatar.jpg" alt="Employee Photo" width="85%" />';
                }
            },
        },
        {
            field: 'attendance',
            title: 'Attendance',
            template: function(row) {
                if (row.attendance == "present") {
                    return '<span class="label label-lg label-light-success label-inline">' + row.attendance + '</span>';
                }
                else {
                    return '<span class="label label-lg label-light-danger label-inline">' + row.attendance + '</span>';
                }
            },
        }],
    });
}

$(document).ready(function() {
    getAttendances();
});

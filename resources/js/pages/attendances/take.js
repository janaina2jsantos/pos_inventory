function getAttendances() {
    $.ajax({
        method: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/ajax/attendances/take',
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
            width: 250,
        },
        {
            field: 'photo',
            title: 'Photo',
            width: 100,
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
            width: 170,
            overflow: 'visible',
            autoHide: false,
            template: function(row) {
                var presentChecked = row.attendance == 'present' ? 'checked' : '';
                var absentChecked = row.attendance == 'absent' ? 'checked' : '';
                return '\
                    <div class="radio-inline">\
                        <label class="radio">\
                            <input type="radio" name="attendance_'+row.id+'" value="present" '+presentChecked+' onclick="takeAttendance('+row.id+')" />\
                            <span></span>&nbsp;Present\
                        </label>\
                        <label class="radio">\
                            <input type="radio" name="attendance_'+row.id+'" value="absent" '+absentChecked+' onclick="takeAttendance('+row.id+')" />\
                            <span></span>&nbsp;Absent\
                        </label>\
                    </div>\
                ';
            },
        }],
    });
}

function takeAttendance(id) {
    var attendance = $('input[name="attendance_'+id+'"]:checked').val();
    $.ajax({
        url: "/attendances/"+id+"/create",
        type: "POST",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'employee_id': id,'attendance': attendance}, 
        dataType: 'json',
        success: function(response) {
            if (response) {
                showAlert('Attendance saved successfully.', 'success');
            }
            else {
                showAlert('There was a problem saving the attendance.', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function showAlert(message, type = 'error') {
    var alertDiv = $('#customAlert');
    var alertMessage = $('#alertMessage');

    if (type === 'success') {
        alertDiv.css({
            'background-color': '#d4edda',
            'color': '#155724',
            'border-color': '#c3e6cb'
        });
    } 
    else {
        alertDiv.css({
            'background-color': '#f8d7da',
            'color': '#721c24',
            'border-color': '#f5c6cb'
        });
    }

    alertMessage.text(message);
    alertDiv.fadeIn();

    setTimeout(function() {
        alertDiv.fadeOut();
    }, 1200);
}

$(document).ready(function() {
    getAttendances();
});

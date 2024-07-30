function getAttendances() {
    var url = window.location.href.split("/");
    $.ajax({
        method: 'GET',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/ajax/attendances/"+url[4]+"/edit",
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
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 220,
            overflow: 'visible',
            autoHide: false,
            template: function(row) {
                var presentChecked = row.attendance == 'present' ? 'checked' : '';
                var absentChecked = row.attendance == 'absent' ? 'checked' : '';
                return '\
                    <div class="radio-inline">\
                        <label class="radio">\
                            <input type="radio" name="attendance_'+row.id+'" value="present" '+presentChecked+' onclick="editAttendance('+row.id+')" />\
                            <span></span>&nbsp;Present\
                        </label>\
                        <label class="radio">\
                            <input type="radio" name="attendance_'+row.id+'" value="absent" '+absentChecked+' onclick="editAttendance('+row.id+')" />\
                            <span></span>&nbsp;Absent\
                        </label>\
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" onclick="deleteAttendance('+row.id+');">\
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
                    </div>\
                ';
            },
        }],
    });
}

function editAttendance(id) {
    var attendance = $('input[name="attendance_'+id+'"]:checked').val();
    $.ajax({
        url: "/attendances/"+id+"/edit/single",
        type: "PUT",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {'id': id,'attendance': attendance}, 
        dataType: 'json',
        success: function(response) {
            if (response) {
                showAlert('Attendance successfully updated.', 'success');
            }
            else {
                showAlert('There was an error while updating the attendance.', 'error');
            }
        },
        error: function(xhr, status, error) {
            return false;
        }
    });
}

function deleteAttendance(id) {
    Swal.fire({
        title: 'Are you sure you want to delete this attendance?',
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
                url: "/attendances/"+id+"/delete",
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
                        'There was an error while deleting the attendance.',
                        'error'
                    );
                }
            });
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

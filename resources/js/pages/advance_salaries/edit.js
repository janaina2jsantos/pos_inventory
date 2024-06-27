$(document).ready(function() {
    $("#advanceSalary").inputmask('€ 999.999.999,99', {
        numericInput: true
    });
});

function teste(id) {

    $.ajax({
        url: "/ajax/advance-salaries/"+id+"/recurring",
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
                    location.href = "/advance-salaries";
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
            console.log(error);

            Swal.fire(
                'Error!',
                'There was an error while executing the action.',
                'error'
            );
        }
    });

}

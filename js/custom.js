$(document).ready(function () {
    $('.delete_exam').click(function (e) { 
        e.preventDefault();
        var pk = $(this).val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this exam!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                method: "POST",
                url: "Instructor_exam_delete.php",
                data: {
                    'exam_pk':pk,
                    'delete_exam':true,
                },
                success: function (response) {
                    if(response == 200){
                        swal("Success!", "Exam deleted Successfully", "success");
                        $('#exams_table').load(location.href + " #exams_table");
                    }else if(response == 500){
                        swal("Error!", "Something went wrong!", "error");
                    }
                }
              });
            }
          });
    });
});
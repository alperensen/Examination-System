<?php 
session_start();

$servername = "";
$username = "alperen";
$password = "password";
$db_name = "exam_system";
$conn = mysqli_connect($servername,$username,$password,$db_name);
if (!$conn) {
  die("Could not connect to database: " . mysqli_connect_error());
}

/*DELETE OPERATION*/ 
if(isset($_POST['delete_exam'])){
    $exam_pk = mysqli_real_escape_string($conn, $_POST['exam_pk']);

    $delete_query = "DELETE FROM exams WHERE exams.pk='$exam_pk'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run){
        echo 200;
    }else{
        echo 500;
    }


}

?>
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
if(isset($_GET['term'])){
    /*GET THE TERM ENTERED BY USER*/
    $searchTerm = $_GET['term'];
    /*STUDENT FIND QUERY*/
    $query = "SELECT students.pk, users.firstName, users.lastName FROM students JOIN users ON students.userFk = users.pk 
              WHERE CONCAT(users.firstName, ' ', users.lastName) LIKE '%" . $searchTerm . "%'";
    $result = $conn->query($query);
    /* SHOW STUDENTS */
    $students = [];
    while($row = $result->fetch_assoc()) {
        $student = [];
        $student['label'] = $row['firstName'] . ' ' . $row['lastName']; 
        $student['value'] = $row['pk']; 
        $students[] = $student;
    }
    echo json_encode($students);
}
?>

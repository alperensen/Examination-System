<?php $page_name = "Course Details"; ?>
<?php include 'layout/ins_header.php'; ?>
<!-- GETTING VALUES AT COURSES TABLE AND EXAMS TABLE-->
<?php 
if(isset($_GET['code'])) {
    $courses_code = $_GET['code'];
    $sql_courses = "SELECT courses.pk, courses.name, courses.code FROM courses WHERE courses.code = '$courses_code'";
    $result_courses = $conn->query($sql_courses);
    $row_courses = $result_courses->fetch_assoc(); 
    $courses_pk = $row_courses["pk"];
    $courses_code = $row_courses["code"];
    $courses_name = $row_courses["name"];

    $sql_exams = "SELECT exams.pk, exams.date, exams.type, exams.percentgrade FROM exams WHERE exams.courseFk = '$courses_pk'";
    $result_exams = $conn->query($sql_exams);
    
}
$instructorName = $_SESSION['name'];
?>
        <div class="d-flex main-content" id="wrapper">
            <!-- Sidebar-->
            <?php include 'layout/ins_sidebar.php'; ?>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <?php include 'layout/ins_navbar.php'; ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <a href="Instructor_courses.php" class="btn btn-dark" style="margin-top: 0.3rem;"><i class="fa-solid fa-arrow-left"></i></a><br>
                    <span class="baslik"><?php echo $courses_name ?></span>
                    <br><br>
                    <div class="card course-details">
                        <div class="card-body">
                            <p class="card-text" style="padding-bottom: 0.8rem;">Course Code: <?php echo $courses_code ?></p>
                            <p class="card-text">Instructor Name: <?php echo $instructorName ?></p>
                        </div>
                    </div>
                    <br>
                    <span class="baslik">LIST OF EXAMS</span>
                    <div id="exams_table" class="table-responsive-md" style="margin-top: 2rem;margin-left: auto;margin-right: auto;">
                        <table class="table table-striped">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date-Time</th>
                                <th scope="col">Percent Grade</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <!--SHOWING TABLE-->
                            <?php
                            $var = 1;
                            if ($result_exams->num_rows > 0) {
                                while ($row_exams = $result_exams->fetch_assoc()) {
                                    ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $var ?>
                                    </th>
                                    <th scope="row">
                                        <?php echo $row_exams["type"] ?>
                                    </th>
                                    <td>
                                        <?php echo $row_exams["date"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_exams["percentgrade"] ?>
                                    </td>
                                    <td>
                                    <a href="Instructor_exam_update.php?pk=<?php echo $row_exams["pk"] ?>"><button type="button" class="btn btn-secondary">Update</button></a>
                                    <form action="" method="POST" class="d-inline">
                                        <button type="buton" value="<?= $row_exams["pk"]; ?>" class="btn btn-dark delete_exam">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                                    $var++;
                                }
                            } else {
                                echo "<tr><td colspan='2'>No exams found</td></tr>";
                                echo "<tr><td colspan='2'>No exams found</td></tr>";
                                echo "<tr><td colspan='2'>No exams found</td></tr>";
                            }
                            ?>
                        </table>
                        <a href="Instructor_exam_create.php?code=<?php echo $courses_code ?>"><button style="float: right;" type="button" class="btn btn-dark">Add Exam</button></a>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>

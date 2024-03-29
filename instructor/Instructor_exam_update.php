<?php $page_name = "Exam Edit"; ?>
<?php include 'layout/ins_header.php'; ?>
<?php 
if(isset($_GET['pk'])) {
    $exams_pk = $_GET['pk'];
    $sql = "SELECT exams.date, exams.type, exams.percentgrade, exams.courseFk FROM exams WHERE exams.pk = '$exams_pk'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
    $courseFk = $row["courseFk"];

    $sql_courses = "SELECT courses.code FROM courses WHERE courses.pk = '$courseFk'";
    $result_courses = $conn->query($sql_courses);
    $row_courses = $result_courses->fetch_assoc();
    $courses_code = $row_courses["code"];

}
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
                    <span class="baslik">EDIT EXAM</span>
                    <br><br>
                    <div class="card examForm">
                        <div class="card-body">
                        <a href="Instructor_courses_details.php?code=<?php echo $courses_code ?>"><button style="float: right;" type="button" class="btn btn-dark">Back</button></a>
                        <h4 class="card-title">EDIT EXAM</h4>
                        <?php
                        $instructorName = $_SESSION['name'];
                        date_default_timezone_set('Europe/Istanbul');
                        $examTypeErr = $examDateTimeErr = $percentGradeErr = "";
                        $currentDateTime = date("Y-m-d H:i:s");

                        function test_input($data)
                        {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        if (isset($_POST['update_exam'])) {

                            if (empty($_POST['update_examType'])) {
                                $examTypeErr = "Exam type is required";
                            } else {
                                $examType = test_input($_POST['update_examType']);
                            }

                            if (empty($_POST['update_examDateTime'])) {
                                $examDateTimeErr = "Exam date is required";
                            } else {
                                $examDateTime = test_input($_POST['update_examDateTime']);
                            }

                            if (empty($_POST['update_percentGrade'])) {
                                $percentGradeErr = "Percent grade is required";
                            } else {
                                $percentGrade = test_input($_POST['update_percentGrade']);
                            }

                            $exams_pk = isset($_GET['pk']) ? $_GET['pk'] : null;

                            $sql_exam_type = "SELECT type FROM exams WHERE pk = ?";
                            $stmt_exam_type = $conn->prepare($sql_exam_type);
                            $stmt_exam_type->bind_param("i", $exams_pk);
                            $stmt_exam_type->execute();
                            $result_exam_type = $stmt_exam_type->get_result();
                            $row_exam_type = $result_exam_type->fetch_assoc();
                            $current_exam_type = $row_exam_type['type'];

                            if ($current_exam_type == 'Midterm' || $current_exam_type == 'Project') {

                                if ($examType == 'Final') {
                                    ?>
                                    <script>
                                        swal({
                                            title: "Error",
                                            text: "A Final exam already exists",
                                            icon: "error",
                                        });
                                    </script>
                                    <?php
                                } else {
                                    UpdateExam($examDateTime, $examType, $percentGrade, $instructorName, $currentDateTime);
                                }

                            } else if ($current_exam_type == 'Final') {

                                UpdateExam($examDateTime, $examType, $percentGrade, $instructorName, $currentDateTime);
                            }

                        }

                        function UpdateExam($examDateTime, $examType, $percentGrade, $instructorName, $currentDateTime)
                        {
                            global $conn, $courses_code, $courseFk, $exams_pk;

                            $sql_sum_percentgrade = "SELECT SUM(percentgrade) AS total_percentgrade FROM exams WHERE exams.courseFk = '$courseFk'";
                            $stmt_sum_percentgrade = $conn->prepare($sql_sum_percentgrade);
                            $stmt_sum_percentgrade->execute();
                            $result_sum_percentgrade = $stmt_sum_percentgrade->get_result();


                            if ($result_sum_percentgrade) {
                                $row_sum_percentgrade = $result_sum_percentgrade->fetch_assoc();
                                $total_percentgrade = $row_sum_percentgrade['total_percentgrade'];
                            } else {
                                $total_percentgrade = 0;
                            }

                            $total_with_user_grade = $total_percentgrade + $percentGrade;

                            if ($total_with_user_grade > 100) {
                                $total_possible_grade = 100 - $total_percentgrade;
                                ?>
                                <script>
                                    swal({
                                        title: "Total percent grade for this course: <?php echo $total_percentgrade; ?>",
                                        text: "You can assign at most <?php echo $total_possible_grade; ?> percent grade for this exam.",
                                        icon: "error",
                                    });
                                </script>
                                <?php
                            } else {
                                
                                $sql_update = "UPDATE exams SET date=?, type=?, percentgrade=?, updatedBy=?, updatedDate=? WHERE pk=?";
                                $stmt = $conn->prepare($sql_update);
                                $stmt->bind_param("ssdssi", $examDateTime, $examType, $percentGrade, $instructorName, $currentDateTime, $exams_pk);
                            
                                if ($stmt->execute()) {
                                    ?>
                                    <script>
                                        swal({
                                            title: "Success",
                                            text: "You updated the exam",
                                            icon: "success",
                                        }).then(function () {
                                            window.location.href = 'Instructor_courses_details.php?code=<?php echo $courses_code ?>';
                                        });
                                    </script>
                                    <?php
                                } else {
                                    ?>
                                    <script>
                                        swal({
                                            title: "Error",
                                            text: "Failed to update the exam",
                                            icon: "error",
                                        });
                                    </script>
                                    <?php
                                    echo "Error: " . $stmt->error;
                                }
                            }
                            
                        }
                        ?>

                        <?php
                            if($result->num_rows >0){
                                
                                ?>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="examType" class="form-label">Exam Type:<span class="text-danger">*</span></label>
                                        <select class="form-select" id="examType" name="update_examType" required>
                                        <option <?= $row['type'] == 'Project' ? 'selected' : '' ?> value="Project">Project</option>
                                        <option <?= $row['type'] == 'Midterm' ? 'selected' : '' ?> value="Midterm">Midterm</option>
                                        <option <?= $row['type'] == 'Final' ? 'selected' : '' ?> value="Final">Final</option>
                                        </select>
                                        <span class="text-danger"><?php echo $examTypeErr; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="examDateTime" class="form-label">Date and Time:<span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" value="<?= $row['date'];?>" id="examDateTime" name="update_examDateTime" required>
                                        <span class="text-danger"><?php echo $examDateTimeErr; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="percentGrade" class="form-label">Percent Grade:<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" value="<?= $row['percentgrade'];?>" id="percentGrade" name="update_percentGrade" placeholder="Enter percent grade" min="0" max="100" required>
                                        <span class="text-danger"><?php echo $percentGradeErr; ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-dark" type="submit" name="update_exam" style="float: right;">Update</button>
                                    </div>
                                </form>
                                <?php
                            }else{
                                echo "<h4>No Such Pk found";
                            }
                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>


<?php $page_name = "Exam Creation"; ?>
<?php include 'layout/ins_header.php'; ?>

        <div class="d-flex main-content" id="wrapper">
            <!-- Sidebar-->
            <?php include 'layout/ins_sidebar.php'; ?>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <?php include 'layout/ins_navbar.php'; ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <span class="baslik">EXAM CREATION</span>
                    <br><br>
                    <!--EXAMFORM-->
                    <div class="card examForm">
                        <div class="card-body">
                        <?php
                            
                            if(isset($_GET['code'])) {
                                $courses_code = $_GET['code'];
                                $sql_courses = "SELECT courses.pk FROM courses WHERE courses.code = '$courses_code'";
                                $result_courses = $conn->query($sql_courses);
                                $row_courses = $result_courses->fetch_assoc(); 
                                $courseFk = $row_courses["pk"];
                                
                            }
                        ?>
                        <?php
                        $examTypeErr = $examDateTimeErr = $percentGradeErr = "";
                        $instructorName = $_SESSION['name'];
                        date_default_timezone_set('Europe/Istanbul');
                        $currentDateTime = date("Y-m-d H:i:s");

                        function test_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }
                        /*CREATE OPERATION*/
                        if (isset($_POST['save_exam'])) {
                            if (empty($_POST['create_examType'])) {
                                $examTypeErr = "Exam type is required";
                            } else {
                                $examType = test_input(isset($_POST['create_examType']) ? $_POST['create_examType'] : '');
                            }

                            if (empty($_POST['create_examDateTime'])) {
                                $examDateTimeErr = "Exam date is required";
                            } else {
                                $examDateTime = test_input(isset($_POST['create_examDateTime']) ? $_POST['create_examDateTime'] : '');
                            }

                            if (empty($_POST['create_percentGrade'])) {
                                $percentGradeErr = "Percent grade is required";
                            } else {
                                $percentGrade = test_input(isset($_POST['create_percentGrade']) ? $_POST['create_percentGrade'] : '');
                            }

                            /*EXAM TYPE CONTROL */
                            if ($_POST['create_examType'] == 'Final') {
                                $sql_check_final_exam = "SELECT exams.type FROM exams WHERE type = 'Final' AND exams.courseFk = '$courseFk'";
                                $result_check_final_exam = $conn->query($sql_check_final_exam);

                                if ($result_check_final_exam && $result_check_final_exam->num_rows > 0) {
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
                                    saveExam($examDateTime, $examType, $percentGrade, $courseFk, $instructorName, $currentDateTime);
                                }
                            } else {
                                saveExam($examDateTime, $examType, $percentGrade, $courseFk, $instructorName, $currentDateTime);
                            }
                        }
                        /* SAVE EXAM FUNCTION */
                        function saveExam($examDateTime, $examType, $percentGrade, $courseFk, $instructorName, $currentDateTime) {
                            global $conn, $courses_code, $courseFk, $instructorName;
                            /*TOTAL PERCENT GRADE CONTROL*/
                            $sql_sum_percentgrade = "SELECT SUM(percentgrade) AS total_percentgrade FROM exams WHERE exams.courseFk = '$courseFk'";
                            $result_sum_percentgrade = $conn->query($sql_sum_percentgrade);

                            if ($result_sum_percentgrade) {
                                $row_sum_percentgrade = $result_sum_percentgrade->fetch_assoc();
                                $total_percentgrade = $row_sum_percentgrade['total_percentgrade'];
                            } else {
                                $total_percentgrade = 0;
                            }

                            $user_percentGrade = isset($_POST['create_percentGrade']) ? intval($_POST['create_percentGrade']) : 0;
                            $total_with_user_grade = $total_percentgrade + $user_percentGrade;

                            if ($total_with_user_grade > 100) {
                                $max_allowed_grade = 100 - $total_percentgrade;
                                ?>
                                <script>
                                    swal({
                                        title: "Error",
                                        text: "You can enter up to <?php echo $max_allowed_grade; ?> for percent grade",
                                        icon: "error",
                                    });
                                </script>
                                <?php
                            } else {

                                $stmt_insert = $conn->prepare("INSERT INTO exams (date, type, percentgrade, courseFk, updatedBy, updatedDate) VALUES (?, ?, ?, ?, ?, ?)");
                                $stmt_insert->bind_param("ssdiss", $examDateTime, $examType, $percentGrade, $courseFk, $instructorName, $currentDateTime);

                                if ($stmt_insert->execute()) {
                                    ?>
                                    <script>
                                        swal({
                                            title: "Success",
                                            text: "You saved the exam",
                                            icon: "success",
                                        }).then(function() {
                                            window.location.href = 'Instructor_courses_details.php?code=<?php echo $courses_code ?>';
                                        });
                                    </script>
                                    <?php
                                }
                            }
                        }
                        ?>

                            <!--FORM CONTEXT-->
                            <a href="Instructor_courses_details.php?code=<?php echo $courses_code ?>"><button style="float: right;" type="button" class="btn btn-dark">Back</button></a>
                            <h4 class="card-title">SAVE EXAM</h4>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="examType" class="form-label">Exam Type:<span class="text-danger">*</span></label>
                                    <select class="form-select" id="examType" name="create_examType" required>
                                        <option value="">Select Type</option>
                                        <option value="Project">Project</option>
                                        <option value="Midterm">Midterm</option>
                                        <option value="Final">Final</option>
                                    </select>
                                    <span class="text-danger"><?php echo $examTypeErr; ?></span>
                                </div>

                                <div class="mb-3">
                                    <label for="examDateTime" class="form-label">Date and Time:<span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="examDateTime" name="create_examDateTime" required>
                                    <span class="text-danger"><?php echo $examDateTimeErr; ?></span>
                                </div>

                                <div class="mb-3">
                                    <label for="percentGrade" class="form-label">Percent Grade:<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="percentGrade" name="create_percentGrade" placeholder="Enter percent grade" min="0" max="100" required>
                                    <span class="text-danger"><?php echo $percentGradeErr; ?></span>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-dark" type="submit" name="save_exam" style="float: right;">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>

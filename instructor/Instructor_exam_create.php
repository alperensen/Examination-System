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

                        date_default_timezone_set('Europe/Istanbul');
                        $currentDateTime = date("Y-m-d H:i:s");

                        function test_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

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
                                $sql_check_final_exam = "SELECT exams.type FROM exams WHERE type = 'Final'";
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
                                    saveExam($examDateTime, $examType, $percentGrade, $courseFk, $_SESSION['name'], $currentDateTime);
                                }
                            } else {
                                saveExam($examDateTime, $examType, $percentGrade, $courseFk, $_SESSION['name'], $currentDateTime);
                            }
                        }

                        function saveExam($examDateTime, $examType, $percentGrade, $courseFk, $updatedBy, $updatedDate) {
                            global $conn, $courses_code;
                            /*TOTAL PERCENT GRADE CONTROL*/
                            $sql_sum_percentgrade = "SELECT SUM(percentgrade) AS total_percentgrade FROM exams";
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
                                $sql_insert = "INSERT INTO exams (date, type, percentgrade, courseFk, updatedBy, updatedDate) VALUES ('$examDateTime', '$examType', '$percentGrade', '$courseFk', '$updatedBy', '$updatedDate')";

                                if ($conn->query($sql_insert) === TRUE) {
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

<!--<div class="table-responsive-md">
                        <table class="table table-striped table-hover" style="max-width: 70rem;margin-left: auto;margin-right: auto;">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Names</th>
                                <th scope="col">Code</th>
                                <th scope="col"></th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            
                        </table>
                        <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Exam</h1>
                                    <button type="button" onclick="sorulariTemizle()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="examForm">
                                            <div class="mb-3">
                                                <label for="Input1" class="form-label">Exam Name:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="Input1" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="startDate">Date:<span class="text-danger">*</span></label>
                                                <input id="startDate" class="form-control" type="date">   
                                            </div>

                                            <div class="mb-3">
                                                <label for="Input2" class="form-label">Time:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="Input2" placeholder="00:00" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Input3" class="form-label">Score:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="Input3" placeholder="100" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="Input4" class="form-label">Question 1:</label>
                                                <input type="text" class="form-control" id="Input4" required>
                                                <label class="form-check-label">Answers:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input rad-style" type="radio" name="secenek1" id="answerA" value="A">
                                                    <label class="form-check-label" for="answerA">A</label>
                                                    <input type="text" class="form-control secenekMetni" id="secenek1AMetni" placeholder="Answer A" required>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input rad-style" type="radio" name="secenek1" id="answerB" value="B">
                                                    <label class="form-check-label" for="answerB">B</label>
                                                    <input type="text" class="form-control secenekMetni" id="secenek1BMetni" placeholder="Answer B" required>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input rad-style" type="radio" name="secenek1" id="answerC" value="B">
                                                    <label class="form-check-label" for="answerC">C</label>
                                                    <input type="text" class="form-control secenekMetni" id="secenek1BMetni" placeholder="Answer C" required>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input rad-style" type="radio" name="secenek1" id="answerD" value="B">
                                                    <label class="form-check-label" for="answerD">D</label>
                                                    <input type="text" class="form-control secenekMetni" id="secenek1BMetni" placeholder="Answer D" required>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input rad-style" type="radio" name="secenek1" id="answerE" value="E">
                                                    <label class="form-check-label" for="answerE">E</label>
                                                    <input type="text" class="form-control secenekMetni" id="secenek1BMetni" placeholder="Answer E" required>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button"  onclick="sonSoruyuSil()" class="btn btn-secondary">Remove Last Question</button>
                                    <button type="button" class="btn btn-secondary" onclick="soruEkle()">Add Question</button>
                                    <button type="button" onclick="sorulariTemizle()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-dark">Add</button>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>-->

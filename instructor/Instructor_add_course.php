<?php $page_name = "Add Course"; ?>
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
            <span class="baslik">ADD COURSE</span>
            <br><br>
            <!-- STUDENT FORM -->
            <div class="card examForm">
                <div class="card-body">
                    <?php 
                    $usernameErr = $passwordErr = $fNameErr = $lNameErr = $dobErr = $activeErr = $emailErr = "";
                    $instructorName = $_SESSION['name'];
                     
                    date_default_timezone_set('Europe/Istanbul');
                    $currentDateTime = date("Y-m-d H:i:s");
                    $studentNameErr = $courseNameErr = "";

                    function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    $instructor_user_pk = $_SESSION['pk'];
                    $sql_instructor = "SELECT pk FROM instructors WHERE userFk = ?";
                    $stmt_instructor = $conn->prepare($sql_instructor);
                    $stmt_instructor->bind_param("i", $instructor_user_pk);
                    $stmt_instructor->execute();
                    $result_instructor = $stmt_instructor->get_result();

                    $row_instructor = $result_instructor->fetch_assoc();
                    $instructor_pk = $row_instructor['pk'];
                    
                    $query_students = "SELECT students.pk, users.firstName, users.lastName FROM students JOIN users ON students.userFk = users.pk";
                    $result_students = $conn->query($query_students);

                    $query_courses = "SELECT * FROM courses WHERE courses.instructorFk = ?";
                    $stmt = $conn->prepare($query_courses);
                    $stmt->bind_param("i", $instructor_pk);
                    $stmt->execute();
                    $result_courses = $stmt->get_result();

                    if(isset($_POST['add_student_course'])){
                        if (empty($_POST['student_name'])) {
                            $studentNameErr = "Student Name is required";
                        } else {
                            $student_pk = test_input($_POST['student_name']);
                        }
                        
                        if (empty($_POST['course_name'])) {
                            $courseNameErr = "Course Name is required";
                        } else {
                            $course_pk = test_input($_POST['course_name']);
                        }

                        //CHECK STUDENT HAS ALREADY ADDED THE COURSE
                        $check_query = "SELECT * FROM course_student WHERE courseFk = ? AND studentFk = ?";
                        $check_stmt = $conn->prepare($check_query);
                        $check_stmt->bind_param("ii", $course_pk, $student_pk);
                        $check_stmt->execute();
                        $check_result = $check_stmt->get_result();

                        if($check_result->num_rows > 0) {
                            echo "<script>swal('Error', 'This student is already added to this course.', 'error');</script>";
                        } else {
                            //INSERT STUDENT to COURSE
                            $insert_course_student = $conn->prepare("INSERT INTO course_student (courseFk, studentFk, updatedBy, updatedDate) VALUES (?, ?, ?, ?)");
                            $insert_course_student->bind_param("iiss", $course_pk, $student_pk, $instructorName, $currentDateTime);
                            if($insert_course_student->execute()) {
                                ?>
                                <script>
                                    swal({
                                        title: "Success",
                                        text: "Course added for student successfully",
                                        icon: "success",
                                    }).then(function() {
                                        window.location.href = 'Instructor_add_course.php';
                                    });
                                </script>
                                <?php
                            } else {
                                echo "Error: " . $insert_course_student->error;
                            }
                        }
                    }
                    ?>

                    <!-- FORM CONTEXT -->
                    <h4 class="card-title">ADD COURSE FORM</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Student Name:<span class="text-danger">*</span></label>
                            <select class="form-select" id="student_name" name="student_name" required>
                                <option value="">Select Student</option>
                                <?php 
                                while($row = $result_students->fetch_assoc()) {
                                    echo "<option value='".$row['pk']."'>".$row['firstName']." ".$row['lastName']."</option>";
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo $studentNameErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="courseName" class="form-label">Course Name:<span class="text-danger">*</span></label>
                            <select class="form-select" id="courseName" name="course_name" required>
                                <option value="">Select Course</option>
                                <?php 
                                while($row = $result_courses->fetch_assoc()) {
                                    echo "<option value='".$row['pk']."'>".$row['name']."</option>";
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo $courseNameErr; ?></span>
                        </div>

                        <button class="btn btn-dark" type="submit" name="add_student_course" style="float: right;">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'layout/ins_footer.php'; ?>

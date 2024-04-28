<?php $page_name = "Add Student"; ?>
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
                    <span class="baslik">ADD STUDENT</span>
                    <br><br>
                    <!-- STUDENT FORM -->
                    <div class="card examForm">
                        <div class="card-body">
                            <?php 
                            $usernameErr = $passwordErr = $fNameErr = $lNameErr = $dobErr = $activeErr = "";
                            $instructorName = $_SESSION['name'];   
                            date_default_timezone_set('Europe/Istanbul');
                            $currentDateTime = date("Y-m-d H:i:s");
                            $role = "student";

                            function test_input($data) {
                                $data = trim($data);
                                $data = stripslashes($data);
                                $data = htmlspecialchars($data);
                                return $data;
                            }

                            if(isset($_POST['add_student'])){
                                if (empty($_POST['add_student_username'])) {
                                    $usernameErr = "Student Username is required";
                                } else {
                                    $username = test_input(isset($_POST['add_student_username']) ? $_POST['add_student_username'] : '');
                                }

                                if (empty($_POST['add_student_password'])) {
                                    $passwordErr = "Student Password is required";
                                } else {
                                    $password = md5(test_input($_POST["add_student_password"]));
                                }
    
                                if (empty($_POST['add_student_firstName'])) {
                                    $fNameErr = "Student First Name is required";
                                } else {
                                    $fName = test_input(isset($_POST['add_student_firstName']) ? $_POST['add_student_firstName'] : '');
                                }

                                if (empty($_POST['add_student_lastName'])) {
                                    $lNameErr = "Student Last Name is required";
                                } else {
                                    $lName = test_input(isset($_POST['add_student_lastName']) ? $_POST['add_student_lastName'] : '');
                                }
                                if (empty($_POST['add_student_dob'])) {
                                    $dobErr = "Date of Birth is required";
                                } else {
                                    $dob = test_input(isset($_POST['add_student_dob']) ? $_POST['add_student_dob'] : '');
                                }
                                if (empty($_POST['add_student_active_state'])) {
                                    $activeErr = "Active state is required";
                                } else {
                                    $active = isset($_POST['add_student_active_state']) && $_POST['add_student_active_state'] == 'Yes' ? 1 : 0;
                                }
                                
                                /*CHECK USERNAME İF IT ALREADY EXISTS*/
                                $check_username_query = $conn->prepare("SELECT username FROM users WHERE username = ?");
                                $check_username_query->bind_param("s", $username);
                                $check_username_query->execute();
                                $check_username_result = $check_username_query->get_result();

                                if($check_username_result->num_rows > 0) {
                                    ?>
                                    <script>
                                        swal({
                                            title: "Error",
                                            text: "Username already exists!",
                                            icon: "error",
                                        }).then(function() {
                                            window.location.href = 'Instructor_add_student.php';
                                        });
                                    </script>
                                    <?php
                                }else{
                                /*INSERT STUDENT to USERS*/   
                                $student_insert = $conn->prepare("INSERT INTO users (username, password, firstName, lastName, dob, active, role, updatedBy, updatedDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $student_insert->bind_param("sssssssss", $username, $password, $fName, $lName, $dob, $active, $role, $instructorName, $currentDateTime);

                                if ($student_insert->execute()) {
                                    ?>
                                    <script>
                                        swal({
                                            title: "Success",
                                            text: "You added the student",
                                            icon: "success",
                                        }).then(function() {
                                            window.location.href = 'Instructor_add_student.php';
                                        });
                                    </script>
                                    <?php
                                } else {
                                    echo "Error: " . $student_insert->error;
                                }
                                }
                                

                            }
                            ?>
                            <!-- FORM CONTEXT -->
                            <h4 class="card-title">ADD STUDENT FORM</h4>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" name="add_student_username" required>
                                    <span class="text-danger"><?php echo $usernameErr; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="add_student_password" required>
                                    <span class="text-danger"><?php echo $passwordErr; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="add_student_firstName" required>
                                    <span class="text-danger"><?php echo $fNameErr; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="lastName" name="add_student_lastName" required>
                                    <span class="text-danger"><?php echo $lNameErr; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth:<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="dob" name="add_student_dob" required>
                                    <span class="text-danger"><?php echo $dobErr; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="examType" class="form-label">Active:<span class="text-danger">*</span></label>
                                    <select class="form-select" id="active" name="add_student_active_state" required>
                                        <option value="">Select State</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <span class="text-danger"><?php echo $activeErr; ?></span>
                                </div>
                                <button class="btn btn-dark" type="submit" name="add_student" style="float: right;">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>

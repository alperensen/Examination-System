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
                                    </div>

                                    <div class="mb-3">
                                        <label for="examDateTime" class="form-label">Date and Time:<span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" value="<?= $row['date'];?>" id="examDateTime" name="update_examDateTime" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="percentGrade" class="form-label">Percent Grade:<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" value="<?= $row['percentgrade'];?>" id="percentGrade" name="update_percentGrade" placeholder="Enter percent grade" min="0" max="100" required>
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

                        <?php 
                        if (isset($_POST['update_exam'])) {
                            $examType = isset($_POST['update_examType']) ? $_POST['update_examType'] : '';
                            $examDateTime = isset($_POST['update_examDateTime']) ? $_POST['update_examDateTime'] : '';
                            $percentGrade = isset($_POST['update_percentGrade']) ? $_POST['update_percentGrade'] : '';
                            
                            $sql_update = "UPDATE exams SET type=?, date=?, percentgrade=? WHERE pk=?";

                            
                            $stmt = $conn->prepare($sql_update);

                            
                            $stmt->bind_param("sssi", $examType, $examDateTime, $percentGrade, $exams_pk);
                            
                            if ($stmt->execute()) {
                                ?>
                                <script>
                                    swal({
                                        title: "Success",
                                        text: "You updated the exam",
                                        icon: "success",
                                    }).then(function() {
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
                        ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>


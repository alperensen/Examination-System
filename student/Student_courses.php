<?php 
$page_name = "My Courses"; 
include 'layout/st_header.php'; 
?>

<div class="d-flex main-content" id="wrapper">
    <!-- Sidebar-->
    <?php include 'layout/st_sidebar.php'; ?>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        <?php include 'layout/st_navbar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <span class="baslik">MY COURSES</span>
            <br><br>
            <!--SHOWING COURSES TABLE-->
            <?php 
            
            $user_pk = $_SESSION['pk'];

            
            $sql_courses = "SELECT courses.name, courses.code, instructors.pk as instructor_pk, users.firstName, users.lastName 
                            FROM courses 
                            INNER JOIN course_student ON courses.pk = course_student.courseFk
                            INNER JOIN instructors ON courses.instructorFk = instructors.pk
                            INNER JOIN students ON course_student.studentFk = students.pk
                            INNER JOIN users ON instructors.userFK = users.pk
                            WHERE students.userFk = ?";
            $stmt_courses = $conn->prepare($sql_courses);
            $stmt_courses->bind_param("i", $user_pk);
            $stmt_courses->execute();
            $result_courses = $stmt_courses->get_result();

            if ($result_courses->num_rows > 0) { ?>
                <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Course Code</th>
                                <th scope="col">Instructor Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $var = 1; 
                            while ($row = $result_courses->fetch_assoc()) { ?>
                                <tr>
                                    <th scope="row"><?php echo $var; ?></th>
                                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["code"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["firstName"] . " " . $row["lastName"]); ?></td>
                                </tr>
                                <?php 
                                
                                $var++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else {
                echo "<p>No courses found</p>";
            }
            ?>
        </div>
    </div>
</div>
<?php include 'layout/st_footer.php'; ?>

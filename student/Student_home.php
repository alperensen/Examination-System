<?php $page_name = "Dashboard"; ?>
<?php include 'layout/st_header.php'; ?>

<div class="d-flex main-content" id="wrapper">
    <!-- Sidebar-->
    <?php include 'layout/st_sidebar.php'; ?>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        <?php include 'layout/st_navbar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <span class="baslik">DASHBOARD</span>
            <br><br>
            <span class="baslik">UPCOMING EXAMS</span>
            <?php 

            $user_pk = $_SESSION['pk'];

            $sql_exams = "SELECT exams.date, exams.type, exams.percentgrade, courses.name as course_name, instructors.pk as instructor_pk, users.firstName, users.lastName 
            FROM exams
            INNER JOIN courses ON exams.courseFk = courses.pk
            INNER JOIN instructors ON courses.instructorFk = instructors.pk
            INNER JOIN users ON instructors.userFK = users.pk
            INNER JOIN course_student ON exams.courseFk = course_student.courseFk
            INNER JOIN students ON course_student.studentFk = students.pk
            WHERE students.userFk = ? AND exams.date > NOW() AND course_student.studentFk = students.pk
            ORDER BY exams.date ASC";

            $stmt_exams = $conn->prepare($sql_exams);
            $stmt_exams->bind_param("i", $user_pk);
            $stmt_exams->execute();
            $result_exams = $stmt_exams->get_result();

            if ($result_exams->num_rows > 0) { ?>
                <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Percent Grade</th>
                                <th scope="col">Instructor Name</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $var = 1; 
                            while ($row = $result_exams->fetch_assoc()) { ?>
                                <tr>
                                    <th scope="row"><?php echo $var; ?></th>
                                    <td><?php echo htmlspecialchars($row["course_name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["type"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["percentgrade"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["firstName"] . " " . $row["lastName"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["date"]); ?></td>
                                </tr>
                                <?php 
                                
                                $var++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else {
                echo "<p>No upcoming exams found</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php include 'layout/st_footer.php'; ?>

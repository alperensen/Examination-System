<?php $page_name = "Courses"; ?>
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
                    <span class="baslik">MY COURSES</span>
                    <br><br>    
                    <!--COURSES TABLE-->
                    <div class="table-responsive-md">
                        <table class="table table-striped table-hover" style="margin-left: auto;margin-right: auto;">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Coure Code</th>
                                
                            </tr>
                            </thead>
                            <!--SHOWING COURSES TABLE-->
                            <?php

                            $instructor_user_pk = $_SESSION['pk'];
                            $sql_instructor = "SELECT pk FROM instructors WHERE userFk = ?";
                            $stmt_instructor = $conn->prepare($sql_instructor);
                            $stmt_instructor->bind_param("i", $instructor_user_pk);
                            $stmt_instructor->execute();
                            $result_instructor = $stmt_instructor->get_result();

                            $row_instructor = $result_instructor->fetch_assoc();
                            $instructor_pk = $row_instructor['pk'];

                            $var = 1;
                            $sql = "SELECT courses.pk, courses.name, courses.code FROM courses WHERE courses.instructorFk = $instructor_pk";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {

                                    ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $var ?>
                                            </th>
                                            <th scope="row">
                                                <?php echo $row["name"] ?>
                                            </th>
                                            <td>
                                                <a href="Instructor_courses_details.php?code=<?php echo $row["code"] ?>" class="code-design"><?php echo $row["code"] ?></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    $var++;
                                }
                            } else {
                                echo "<tr><td colspan='2'>No courses found</td></tr>";
                            }

                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>

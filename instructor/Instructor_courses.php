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
                    <div class="table-responsive-md">
                        <table class="table table-striped table-hover" style="max-width: 60rem;margin-left: 2%;">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Coure Code</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $instructor_pk = $_SESSION['pk'];
                            $var = 1;
                            $sql = "SELECT courses.name, courses.code FROM courses WHERE courses.instructorFk = $instructor_pk";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><th scope='row'>" . $var . "</th> <th scope='row'>" . $row["name"] . "</th><td>" . $row["code"] . "</td><td><button type='button' class='btn btn-secondary' data-bs-toggle='modalMembers' data-bs-target='#showMembers'>
                                    Members
                                    </button></td></tr>";
                                    $var++;
                                }
                            } else {
                                echo "<tr><td colspan='2'>No courses found</td></tr>";
                            }
                            
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>

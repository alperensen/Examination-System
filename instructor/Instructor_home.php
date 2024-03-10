<?php $page_name = "Dashboard"; ?>
<?php include 'layout/ins_header.php'; ?>
<?php
// Define a constant array of courses
$courses = [
    ['id' => 1, 'name' => 'Web Programming', 'numOfStudents' => 12, 'numOfExams' => 2],
    ['id' => 2, 'name' => 'Algorithm', 'numOfStudents' => 130, 'numOfExams' => 3],
    ['id' => 3, 'name' => 'Software Engineering', 'numOfStudents' => 110, 'numOfExams' => 1],
    ['id' => 4, 'name' => 'Database Management', 'numOfStudents' => 120, 'numOfExams' => 0],
    ['id' => 5, 'name' => 'Computer Organization', 'numOfStudents' => 101, 'numOfExams' => 5],
    ['id' => 6, 'name' => 'Discrete Mathematics II', 'numOfStudents' => 99, 'numOfExams' => 2]
    

];
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
                    <span class="mt-2 baslik">ONLINE EXAM SYSTEM</span>
                    <br><br>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title">0</h1>
                                    <h5 class="card-title">Tutorial</h5>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title">0</h1>
                                    <h5 class="card-title">Tutorial</h5>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title">0</h1>
                                    <h5 class="card-title">Tutorial</h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <table class="table table-borderless bg-light shadow-lg border border-4 position-relative md-2">
                                <thead class="table-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Number of Students</th>
                                    <th scope="col">Number of Exams</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($courses as $course): ?>
                                    <tr>
                                        <td scope="row"><?php echo $course['id']; ?></td>
                                        <td scope="row"><?php echo $course['name']; ?></td>
                                        <td scope="row"><?php echo $course['numOfStudents']; ?></td>
                                        <td scope="row"><?php echo $course['numOfExams']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>

<?php include 'layout/ins_footer.php'; ?>

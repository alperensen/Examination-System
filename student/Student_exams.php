<?php $page_name = "Exams"; ?>
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
                <span class="baslik">EXAMS</span>
                <br><br>    
                <div class="table-responsive-md ">
                    <table class="table table-striped table-hover" style="max-width: 90%;margin-left: 4%;">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Exam Name</th>
                            <th scope="col">Instructor Name</th>
                            <th scope="col">Exam Dates</th>
                            <th scope="col">Time</th>
                            
                            <th scope="col"></th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <th scope="row">CSE236(Web Programming)</th>
                            <td>Prof.Dr. Melih Günay</td>
                            <td>2024-03-02</td>
                            <td>01:30 Hrs</td>
                            <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addExamModal">
                                Join
                                </button></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <th scope="row">CSE332(Software Engineering)</th>
                            <td>Prof.Dr. Ümit Deniz Uluşar</td>
                            <td>2024-03-02</td>
                            <td>01:30 Hrs</td>
                            <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addExamModal">
                                Join
                                </button></td>
                            
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <th scope="row">CSE204(Database Management)</th>
                            <td>Asst.Prof.Dr. Joseph William Ledet</td>
                            <td>2024-03-02</td>
                            <td>01:30 Hrs</td>
                            <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addExamModal">
                                Join
                                </button></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <th scope="row">CSE206(Computer Organization)</th>
                            <td>Assoc.Prof.Dr. Taner Danışman</td>
                            <td>2024-03-02</td>
                            <td>01:30 Hrs</td>
                            <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addExamModal">
                                Join
                                </button></td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <th scope="row">CSE222(Discrete Mathematics II)</th>
                            <td>Asst.Prof.Dr. Murat Ak</td>
                            <td>2024-03-02</td>
                            <td>01:30 Hrs</td>
                            <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addExamModal">
                                Join
                                </button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include 'layout/st_footer.php'; ?>

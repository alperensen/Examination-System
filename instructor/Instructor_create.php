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
                    <div class="table-responsive-md">
                        <table class="table table-striped table-hover" style="max-width: 90%;margin-left: 5%;">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Names</th>
                                <th scope="col">Exam Dates</th>
                                <th scope="col"></th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <th scope="row">CSE236(Web Programming)</th>
                                <td>03/02/2024</td>
                                <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addExamModal">
                                    Add Exam
                                    </button></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <th scope="row">CSE332(Software Engineering)</th>
                                <td>03/03/2024</td>
                                <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addExamModal">
                                    Add Exam
                                    </button></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <th scope="row">CSE204(Database Management)</th>
                                <td>03/04/2024</td>
                                <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addExamModal">
                                    Add Exam
                                    </button></td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <th scope="row">CSE206(Computer Organization)</th>
                                <td>03/05/2024</td>
                                <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addExamModal">
                                    Add Exam
                                    </button></td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <th scope="row">CSE222(Discrete Mathematics II)</th>
                                <td>03/06/2024</td>
                                <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addExamModal">
                                    Add Exam
                                    </button></td>
                            </tr>
                            </tbody>
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
                    </div>
                </div>
            </div>
        </div>
<?php include 'layout/ins_footer.php'; ?>

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
                        <table class="table table-striped table-hover" style="max-width: 70rem;margin-left: auto;margin-right: auto;">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Names</th>
                                <th scope="col">Code</th>
                                <th scope="col"></th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $instructor_pk = $_SESSION['pk'];
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
                                                <?php echo $row["code"] ?>
                                            </td>
                                            <td><button type='button' class='btn btn-secondary' data-bs-toggle='modal'
                                                    data-bs-target='#addExamModal'>
                                                    Add Exam
                                                </button></td>
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

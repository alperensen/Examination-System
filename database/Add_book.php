<?php include 'layout/header.php'; ?>

<div class="d-flex main-content" id="wrapper">
    <!-- Sidebar-->
    <?php include 'layout/sidebar.php'; ?>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        <?php include 'layout/navbar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <h2 class="baslik">ADD NEW BOOK</h2>
            <div class="card examForm">
                <div class="card-body">

            <?php
            
            $libraryQuery = "SELECT libraryNo, libraryName FROM librarytable";
            $libraryResult = $conn->query($libraryQuery);
            
            $sectionQuery = "SELECT sectionNo, sectionGenre FROM sectiontable";
            $sectionResult = $conn->query($sectionQuery);
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="titleName">Title Name:</label>
                    <input type="text" class="form-control" id="titleName" name="titleName" required>
                </div>

                <div class="mb-3">
                    <label for="publisherName">Publisher Name:</label>
                    <input type="text" class="form-control" id="publisherName" name="publisherName" required>
                </div>

                <div class="mb-3">
                    <label for="publishYear">Publish Year:</label>
                    <input type="text" class="form-control" id="publishYear" name="publishYear" placeholder="1980" required>
                </div>

                <div class="mb-3">
                    <label for="bookState">Book State:</label>
                    <select class="form-control" id="bookState" name="bookState" required>
                        <option value="in">In</option>
                        <option value="out">Out</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="numOfPages">Number of Pages:</label>
                    <input type="text" class="form-control" id="numOfPages" name="numOfPages" required>
                </div>

                <div class="mb-3">
                    <label for="availableCopies">Available Copies:</label>
                    <input type="text" class="form-control" id="availableCopies" name="availableCopies" required>
                </div>

                <div class="mb-3">
                    <label for="checkedOutCopies">Checked Out Copies:</label>
                    <input type="text" class="form-control" id="checkedOutCopies" name="checkedOutCopies" required>
                </div>

                <div class="mb-3">
                    <label for="bookFee">Book Fee:</label>
                    <input type="text" class="form-control" id="bookFee" name="bookFee" placeholder="10$" required>
                </div>

                <div class="mb-3">
                    <label for="language">Language:</label>
                    <input type="text" class="form-control" id="language" name="language" placeholder="English" required>
                </div>

                <div class="mb-3">
                    <label for="returnTime">Return Time:</label>
                    <input type="date" class="form-control" id="returnTime" name="returnTime" required>
                </div>

                <div class="mb-3">
                    <label for="sectionFk">Section:</label>
                    <select class="form-control" id="sectionFk" name="sectionFk" required>
                        <option value="">Select Section</option>
                        <?php
                        if ($sectionResult->num_rows > 0) {
                            while ($row = $sectionResult->fetch_assoc()) {
                                echo "<option value='{$row['sectionNo']}'>{$row['sectionGenre']}</option>";
                            }
                        } else {
                            echo "<option value=''>No sections available</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="libraryFk">Library:</label>
                    <select class="form-control" id="libraryFk" name="libraryFk" required>
                        <option value="">Select Library</option>
                        <?php
                        if ($libraryResult->num_rows > 0) {
                            while ($row = $libraryResult->fetch_assoc()) {
                                echo "<option value='{$row['libraryNo']}'>{$row['libraryName']}</option>";
                            }
                        } else {
                            echo "<option value=''>No libraries available</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <button class="btn btn-dark" type="submit" name="save_exam" style="float: right;">Add</button>
                </div>
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $titleName = $_POST['titleName'];
                    $publisherName = $_POST['publisherName'];
                    $publishYear = $_POST['publishYear'];
                    $bookState = $_POST['bookState'];
                    $numOfPages = $_POST['numOfPages'];
                    $availableCopies = $_POST['availableCopies'];
                    $checkedOutCopies = $_POST['checkedOutCopies'];
                    $bookFee = $_POST['bookFee'];
                    $language = $_POST['language'];
                    $returnTime = $_POST['returnTime'];
                    $sectionFk = $_POST['sectionFk'];
                    $libraryFk = $_POST['libraryFk'];
                    
                    $sql = "INSERT INTO booktable (titleName, publisherName, publishYear, bookState, numOfPages, availableCopies, checkedOutCopies, bookFee, language, returnTime, sectionFk, libraryFk) 
                            VALUES ('$titleName', '$publisherName', '$publishYear', '$bookState', '$numOfPages', '$availableCopies', '$checkedOutCopies', '$bookFee', '$language', '$returnTime', '$sectionFk', '$libraryFk')";

                    // Sorguyu çalıştıralım
                    if ($conn->query($sql) === TRUE) {
                        echo "New book added successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>

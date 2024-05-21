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
            <span class="baslik">LIST OF ALL AUTHORS</span>
            <br><br>
            
            <form method="post">
                <button class="btn btn-dark" type="submit" name="list_authors">List All Authors</button>
            </form>
            <br><br>
            <?php
            

            
            $sql = "
                SELECT 
                    CONCAT(a.authorfName, ' ', a.authorlName) AS authorName, 
                    COUNT(ba.bookFk) AS bookCount 
                FROM 
                    authortable a 
                LEFT JOIN 
                    bookauthortable ba 
                ON 
                    a.authorIdList = ba.AuthorFk 
                GROUP BY 
                    a.authorIdList
                ORDER BY 
                    authorName
            ";

            if (isset($_POST['list_authors'])) {
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="table-responsive-md">';
                    echo '<table class="table table-striped table-hover" style="margin-left: auto;margin-right: auto;">';
                    echo '<thead class="table-dark">';
                    echo '<tr>';
                    echo '<th scope="col">Author Name</th>';
                    echo '<th scope="col">Book Count</th>';
                    echo '<th scope="col"></th>';  
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row["authorName"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["bookCount"]) . '</td>';
                        echo '<td></td>';  
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning" role="alert">Author not found.</div>';
                }
            }

            
            ?>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>

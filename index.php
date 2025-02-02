<?php 
  session_start();

  $servername = "";
  $username = "alperen";
  $password = "password";
  $db_name = "exam_system";
  $conn = mysqli_connect($servername,$username,$password,$db_name);
  if (!$conn) {
    die("Could not connect to database: " . mysqli_connect_error());
  }
  $page_name = "Login"

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Exam System | <?= $page_name ?></title>
        <link rel="icon" type="image/x-icon" href="assets/Akdeniz_university_logo.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        
    </head>
    <body style="background-color: gray;">
    <?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['login'])) { 

        if(isset($_POST['username']) && isset($_POST['password'])) { 

            if (empty($_POST["username"])) {
                $usernameErr = "Username is required";
              } else {
                $username = test_input($_POST["username"]);
              }
            
            if (empty($_POST["password"])) {
            $passwordErr = "Paswword is required";
            } else {
            $password = md5(test_input($_POST["password"]));
            }

            
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            
            $sql_instructors = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='instructor' AND active=1";
            $result_instructors = mysqli_query($conn, $sql_instructors);

            
            $sql_students = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='student' AND active=1";
            $result_students = mysqli_query($conn, $sql_students);

            if(mysqli_num_rows($result_instructors) == 1) { 
                $row = mysqli_fetch_assoc($result_instructors);
                $_SESSION['name'] = $row['firstName'] . ' ' . $row['lastName']; 
                $_SESSION['pk'] = $row['pk'];
                header("Location: instructor/Instructor_home.php"); 
                exit();
            }
            elseif(mysqli_num_rows($result_students) == 1) { 
                $row = mysqli_fetch_assoc($result_students);
                $_SESSION['name'] = $row['firstName'] . ' ' . $row['lastName']; 
                $_SESSION['pk'] = $row['pk']; 
                header("Location: student/Student_home.php"); 
                exit();
            }
            else {
                $status = "Login information is incorrect.";
            }
        }
    }
    mysqli_close($conn);
    ?>

        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container" style="margin-top: 2rem;">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card bg-dark text-white" style="border-radius: 1.5rem;">
                                    <div class="card-body p-4 text-center">
                
                                      <div class="mb-md-2 mt-md-1 pb-3">
                                        <img  class="mb-3" id="login_logo" src="assets/Akdeniz_university_logo.png" style="margin-left: auto;margin-right: auto;" alt="logo" width="120px" height="120px">
                        
                                        <h2 class="fw-bold mb-2">Login</h2>
                                        <p class="text-white-50 mb-5">Please enter your username and password!</p>
                                        <form action="" method="POST">
                                        <div class="mb-4">
                                          <label class="form-label" for="username">Username:<span class="text-danger">*</span></label>
                                          <input type="text" name="username" id="username" class="form-control form-control-lg" required/>
                                          
                                        </div>
                          
                                        <div class="mb-3">
                                          <label class="form-label" for="password">Password:<span class="text-danger">*</span></label>
                                          <input type="password" name="password" id="password" class="form-control form-control-lg" required/>
                                          
                                        </div>
                          
                                        <p class="small mb-4 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
                          
                                        <button class="btn btn-outline-light btn-lg px-5 fw-bold" type="submit" name="login">Login</button>
                                        </form>
                                        
                          
                                      </div>
                          
                                      
                          
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>


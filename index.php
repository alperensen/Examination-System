<?php 
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "";
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
    <body>
    <?php
      
      if(isset($_POST['email']) && isset($_POST['password'])){
      $status = "";
      $email = $_POST['email'];
      $password = md5($_POST['password']);
      

      $email = mysqli_real_escape_string($conn, $email);
      $password = mysqli_real_escape_string($conn, $password);

      $query_instructors = "SELECT * FROM instructors WHERE email='$email' AND password='$password'";
      $result_instructors = mysqli_query($conn, $query_instructors);

      $query_students = "SELECT * FROM students WHERE email='$email' AND password='$password'";
      $result_students = mysqli_query($conn, $query_students);

      if (mysqli_num_rows($result_instructors) == 1) {
        $row = mysqli_fetch_assoc($result_instructors);
        $_SESSION['user_type'] = 'instructor';
        $_SESSION['name'] = $row['name'];
        header("Location: instructor/Instructor_home.php");
        exit();
      }
      elseif (mysqli_num_rows($result_students) == 1) {
        $row = mysqli_fetch_assoc($result_students);
        $_SESSION['user_type'] = 'student';
        $_SESSION['name'] = $row['name'];
        header("Location: student/Student_home.php");
        exit();
      }else {
        $status = "Login information is incorrect.";
      } 
      mysqli_close($conn);
    }

    ?>
        <section class="vh-100" style="background: gray;">
            <div class="container py-4 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-4 text-center">

                      <div class="mb-md-5 mt-md-4 pb-5">
                        <img  class="mb-3" id="login_logo" src="assets/Akdeniz_university_logo.png" style="margin-left: auto;margin-right: auto;" alt="logo" width="120px" height="120px">
        
                        <h2 class="fw-bold mb-2">Login</h2>
                        <p class="text-white-50 mb-5">Please enter your email and password!</p>
                        <form action="" method="POST">
                        <div class="mb-4">
                          <label class="form-label" for="email">Email</label>
                          <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="example@gmail.com" />
                          
                        </div>
          
                        <div class="mb-3">
                          <label class="form-label" for="password">Password</label>
                          <input type="password" name="password" id="password" class="form-control form-control-lg" />
                          
                        </div>
          
                        <p class="small mb-4 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
          
                        <button class="btn btn-outline-light btn-lg px-5 fw-bold" type="submit" name="submit">Login</button>
                        </form>
                        
          
                      </div>
          
                      
          
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>


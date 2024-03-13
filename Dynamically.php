<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dynamically</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h5>Dynamically populate a table</h5>
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
    <table class="table table-borderless bg-light shadow-lg border border-4 position-relative md-2" style="width: 80rem;">
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

    <?php
        class Courses {
        
        public $name;
        public $code;
                
        function set_name($name) {
            $this->name = $name;
        }
        function get_name() {
            return $this->name;
        }
        function set_code_name($code) {
            $this->code = $code;
        }
        function get_code_name() {
            return $this->code;
        }
        
        }

        $web = new Courses();
        $algorithm = new Courses();
        $web->set_name('Web Programming');
        $algorithm->set_name('Algorithm');

        echo $web->get_name();
        echo "<br>";
        echo $algorithm->get_name();
        echo "<br>";
        echo $web->get_code_name();
        echo "<br>";
        echo $algorithm->get_code_name();
    ?>
    <h5>Encode</h5>
    <?php
    $courses = array("WebProgramming", "Algorithm", "Discrete"); 

    echo json_encode($courses);
    ?>
    
    <br>
    <h5>Decode</h5>
    <?php
    $courses = array("WebProgramming", "Algorithm", "Discrete"); 

    echo json_encode($courses);
    ?>
    <br><br>
    <h5>Decode</h5>
    <?php
    $jsonobj = '{"WebProgramming":1,"Algorithm":2,"Discrete":3}';
    
    var_dump(json_decode($jsonobj));
    
    ?>
    <br>
    <h5>Encode</h5>
    <?php
    $jsonobj = '{"WebProgramming":1,"Algorithm":2,"Discrete":3}';
    
    var_dump(json_encode($jsonobj));
    ?>
    <br>
    <h4>With JSON TABLE</h4>
    <?php
    $jsonobj = '{"WebProgramming":35,"Algorithm":37,"Discrete":43}';

    
    $courses = json_decode($jsonobj, true);
    ?>
    <table class="table table-borderless bg-light shadow-lg border border-4 position-relative md-2" style="width: 80rem;">
        <thead class="table-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Number of Students</th>
            
            
        </tr>
        </thead>
        <tbody>
        <?php foreach ($courses as $courseName => $duration): ?>
                <tr>
                    <td><?php echo $courseName; ?></td>
                    <td><?php echo $duration; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
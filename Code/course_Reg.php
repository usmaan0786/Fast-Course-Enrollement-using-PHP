<html>
    <head>
        <title>new Course Registration</title>
    </head>
    <body>
        <?php if (isset($_GET['form_submitted']))
        {
        //this code is executed when the form is submitted
            ?>
            <h3> <?php echo $_GET['course_code']; ?> has been registered</h3>
            <p>
                <?php
                $username = "root";
                $password = ""; 
                try 
                {
                    $conn = new PDO("mysql:host=localhost;dbname=university", $username, $password);
                     // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "Connected successfully <br>";
                } 
                
                catch (PDOException $e) {
                echo "Connection failed: \n" . $e->getMessage();
            }

            echo "<br>Your data has been inserted as";
            echo "<br>Course Code: ".$_GET['course_code'] . ' ' . "<br>Course Name: ".$_GET['course_name']. '  '. "<br>Credit Hours: ".$_GET['credit_hours'];

            $course_code= $_GET['course_code'];
            $course_name=$_GET['course_name'];
            $credit_hours=$_GET['credit_hours'];

            $query_1 = $conn->prepare("insert into courses values (?,?,?)");
            $query_1->execute([$course_code,$course_name,$credit_hours]);

            ?>
            </p>

            <p>Go <a href="/testphp/course_reg.php">back</a> to the form</p>
            <?php 
        }
        else 
        { 
            ?>
            <h2>FAST Student Registration Form</h2>
            <form action="/testphp/student_registration.php">
            <input type="submit" value="Student Registration" />
            </form>
            
            <form action="course_reg.php" method="GET">

            <label for="course_code">Course Code</label>
            &emsp;
            &emsp;
            &thinsp;
            &thinsp;
            &thinsp;
            <input type="text" id="course_code" name="course_code">
            <br>
            <br>
            <label for="course_name">Course Name</label>
            &emsp;
            &emsp;
            &emsp;
            <input type="text" name="course_name" id="course_name">
            <br>
            <br>
            <label for="credit_hours">Credit Hours</label>
            &emsp;
            &emsp;
            &thinsp;
            &emsp;
            <input type="text" name="credit_hours" id="credit_hours">
            <br>
            <br>
        
            <input type="hidden" name="form_submitted" value="1" />
            <button style="background-color:blue;border-color:blue;color:white" type="submit" value="Submit">Submit
            </form>
            <?php 
        } 
        ?>
    </body>
</html>
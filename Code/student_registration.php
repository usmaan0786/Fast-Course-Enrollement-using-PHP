
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAST Student Registration of Courses</title>
</head>
<body><?php 
    if (isset($_GET['form_submitted']))
        {
        //this code is executed when the form is submitted
            ?>
            <div class="container">
                <h1 style = "text-align: center;"> FAST STUDENT REGISTRATION</h1>
            </div>
            

            <div class="student" style = "text-align: center;">
                
                <form action="student_registration.php" method="post"> 
                    Roll No <input type="text", id = "roll_no", name = "roll_no">
                    <button class="btn">Search</button>
                    <input type="hidden" name="form_submitted" value="1" />
                </form>
            </div>

            <div class="course" style = "text-align:center;">
                <br>
                <form action="/course_reg.php">
                <input type="submit" value="Course Registration" />
                </form>
            </div>

            <p>
                <?php
                    $username = "root";
                    $password = ""; 
                    try 
                    {
                        $conn = new PDO("mysql:host=localhost;dbname=university", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } 
                    
                    catch (PDOException $e) 
                    {
                        echo "Connection failed: \n" . $e->getMessage();
                    }


                    $roll_no= $_GET['roll_no'];

                    $query_1 = $conn->prepare("select * from student where roll_no = ?");
                    $query_1->execute([$roll_no]);
                    $result=$query_1->fetchAll(PDO::FETCH_ASSOC);

                    if($result == NULL)
                    {
                        echo '<meta http-equiv="refresh" content="0; URL=student_registration.php?bad_input=1" />';
                    }

                    ?>
            </p>
        
            <div class="table">
            <table>
            <thead>
            <tr>
            <th ><h3 >Roll No &emsp;&emsp;&emsp;&emsp;<h3> </th>
            <th><h3>Name&emsp;&emsp;&emsp;&emsp; <h3> </th>
            <th ><h3>Family Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <h3></th>
            <th ><h3>Gender &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <h3></th>
            <th ><h3>Contact &emsp;&emsp;&emsp;&emsp; <h3></th>
            <th ><h3>Address<h3>  </th>
            </tr>

            </thead>


            <tbody>
            <?php
                foreach($result as $key=>$value)
                {
                    echo '<tr>
                <td>'.$value["roll_no"].'</td>
                <td>'.$value["st_name"].'</td>
                <td>'.$value["f_name"].'</td>
                <td>'.$value["gender"].'</td>
                <td>'.$value["contact"].'</td>
                <td>'.$value["address"].'</td>



                </tr>';
                }

                ?>

            </tbody>
            </table>
            </div>

                </div>
                <br><br>
                <div class="registered" style="border: 2px solid; border-color: black; padding : 20px;">
                    <h2 style = "text-align:center;">Registered Courses</h2>
                    <?php
                    $query_1 = $conn->prepare("select * from courses where course_code = any(select course_code from registration where roll_no = ?)");
                    $query_1->execute([$roll_no]);
                    $result=$query_1->fetchAll(PDO::FETCH_ASSOC);

                    ?>
                    </p>
                
                    <div class="table">
                    <table>
                    <thead>
                    <tr>
                    <th ><h3 >Course Code&emsp;&emsp;&emsp;&emsp;<h3> </th>
                    <th><h3>Course Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <h3> </th>
                    <th ><h3>Credit Hours&emsp;&emsp;&emsp;&emsp;&emsp; <h3></th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php
                        foreach($result as $key=>$value)
                        {
                            echo '<tr>
                        <td>'.$value["course_code"].'</td>
                        <td>'.$value["course_name"].'</td>
                        <td>'.$value["credit_hours"].'</td>

                        </tr>';
                        }

                        

                        ?>

                    </tbody>
                    </table>
                    </div>
                    
                </div>
                <br><br>
                <div class="unregistered" style="border: 2px solid; border-color: black; padding : 20px;">
                    <h2 style = "text-align:center;">Unregistered Courses</h2>
                    <?php
                    $query_1 = $conn->prepare("select * from courses where course_code != all(select course_code from registration where roll_no = ?)");
                    $query_1->execute([$roll_no]);
                    $result = $query_1->fetchAll(PDO::FETCH_ASSOC);

                    ?>
                    </p>
                
                    <div class="table">
                    <table>
                    <thead>
                    <tr>
                    <th ><h3 >Course Code&emsp;&emsp;&emsp;&emsp;<h3> </th>
                    <th><h3>Course Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <h3> </th>
                    <th ><h3>Credit Hours&emsp;&emsp;&emsp;&emsp;&emsp; <h3></th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php
                        foreach($result as $key=>$value)
                        {
                            echo '<tr>
                        <td>'.$value["course_code"].'</td>
                        <td>'.$value["course_name"].'</td>
                        <td>'.$value["credit_hours"].'</td>
                        <td><form action="student_registration.php" method="GET"> 
                        <input type = "hidden", name = "roll_no", id = "roll_no", value = '.$roll_no.'>
                        <input type = "hidden", name = "course_code", id = "course_code", value = '.$value["course_code"].'>
                        <input type="hidden" name="course_submitted" value="1" />
                        <button class="btn">Register</button>
                        
                    </form> </td>

                        </tr>';
                        }

                        

                        ?>

                    </tbody>
                    </table>
                    </div>

                </div>
            </p>
            <?php
        }
        else if(isset($_GET['course_submitted']))
        {
            ?>
            <h2> <?php echo $_GET['roll_no']; ?> has registered the course <?php echo $_GET['course_code']; ?></h2>
            
            <?php
                $username = "root";
                $password = ""; 
                try 
                {
                    $conn = new PDO("mysql:host=localhost;dbname=university", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } 
                
                catch (PDOException $e) 
                {
                    echo "Connection failed: \n" . $e->getMessage();
                }
                $roll_no= $_GET['roll_no'];
                $course_code = $_GET['course_code'];

                $query_1 = $conn->prepare("insert into registration values (?,?)");
                $query_1->execute([$roll_no,$course_code]);
            ?>

            <?php
            $folder_path = 'student_registration.php?roll_no='.$roll_no.'&form_submitted=1';
            echo 'Go <a href="' . $folder_path . '">back </a> to registrations form';?>

            <?php
        }
        else
        {
            ?>
            <div class="container">
                <h1 style = "text-align: center;"> FAST COURSE REGISTRATION</h1>
            </div>
            

            <div class="student" style = "text-align: center;">
                
                <form action="/student_registration.php" method="GET"> 
                    Roll No <input type="text", id = "roll_no", name = "roll_no">
                    <input type="hidden" name="form_submitted" value="1" />
                    <button class="btn">Search</button>
                    
                </form> 

                <div class="error" style = "text-align:center; color:red;">
                    <?php
                    if (isset($_GET['bad_input']))
                    {
                        ?>
                        Roll Number entered does not exist
                        <?php
                    }
                    ?>
                </div>

                <div class="course" style = "text-align:center;">
                    <br>
                    <form action="course_reg.php">
                    <input type="submit" value="Course Registration" />
                    </form>
                </div>

            <?php
        }
        ?>
</body>
</html>


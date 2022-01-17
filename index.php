<?php

/*----------Database Connection---------------*/

/*-----ways to  connect to a MySQL Database
1.MySQLi extension
2.PDO
*/

//Connecting to the database

$server="localhost";
$username="learn_php";
$password="12345";
$db="learn_php";
$conn=mysqli_connect($server, $username, $password, $db);

if(!$conn){
    die('Database Server not Connected'.mysqli_connect_error());
}
else{
    echo'Database Server Connected';
    mysqli_select_db($conn,$db);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CRUD</title>
</head>
<body>
    <div class="container">
    <div class="jumbotron">
        <h2>Php MySQl CURD</h2>
    </div>
    <?php
        if(isset($_GET['edit_id'])){
            $sql="SELECT * FROM users WHERE id='$_GET[edit_id]'";
            $run=mysqli_query($conn, $sql);

            while($rows=mysqli_fetch_assoc($run)){
                $user=$rows['name'];
                $email=$rows['email'];
                $password=$rows['password'];
                $contact_number=$rows['contact_number'];
            } 
            ?>
        <!-- Editing form starts-->
<h2>Edit User Data</h2>
    <form action="" method="POST">
        <div class="form-group mb-3">
            <label class="mb-2">Username</label>
            <input type="text" name="edit_user" value="<?php echo $user; ?>" class="form-control" placeholder="Enter your Username" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2">Email</label>
            <input type="email" name="edit_email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter your Email" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2">Password</label>
            <input type="password" name="edit_password" value="<?php echo $password; ?>"class="form-control" placeholder="Enter your password" required>
        </div>
        <div class="form-group  mb-3">
            <label class="mb-2">Contact Number</label>
            <input type="text" name="edit_contact_number" value="<?php echo $contact_number; ?>"class="form-control">
        </div>
        <div class="form-group">
            <input type="hidden" name="edit_user_id" value="<?php echo $_GET['edit_id']?>">
            <input type="submit" name="edit_user_btn" value="done editing" class="btn btn-primary">
        </div>
    </form>
    <!-- Editing form ends-->
           
           <?php
        }else{ ?>

<h2>Insert New User Data</h2>
    <form action="" method="POST">
        <div class="form-group mb-3">
            <label class="mb-2">Username</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your Username" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <div class="form-group  mb-3">
            <label class="mb-2">Contact Number</label>
            <input type="text" name="contact_number" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit_user" class="btn btn-danger">
        </div>
    </form>

            <?php


        }
    
    ?>
    
    <!-- /*how to retrieved data from Database */ -->
    <?php
        $sql="SELECT * FROM users";
        $run=mysqli_query($conn, $sql);

        echo"
        <table class='table table-primary table-striped'>
            <thead>
                <tr>
                    <td>S.No</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>password</td>
                    <td>Contact Number</td>
                    <td><button class='btn btn-success'>Edit</button></td>
                    <td><button class='btn btn-primary'>Delete</button></td>
                </tr>
            </thead>
            <tbody>
            ";
            $c=1;
            while($rows=mysqli_fetch_assoc($run)){
                echo"
                <tr>
                    <td>{$c}</td>
                    <td>{$rows['name']}</td>
                    <td>{$rows['email']}</td>
                    <td>{$rows['password']}</td>
                    <td>{$rows['contact_number']}</td>
                    <td><a href='index.php?edit_id=$rows[id]' class='btn btn-success'>Edit</a></td>
                    <td><a href='index.php?del_id=$rows[id]' class='btn btn-primary'>Delete</a></td>
                </tr>
                ";
                $c++;
            }
            echo"
            </tbody>
        </table>  
        ";
    ?>
    <!-- /*how to retrieved button */ -->

    </div>
   
    

     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>


<?php

//Inserting new user
if(isset($_POST['submit_user'])){
                // echo $userName=mysqli_real_escape_string($conn, strip_tags($_POST['name']));
                // echo $userEmail=mysqli_real_escape_string($conn, strip_tags($_POST['email']));
                // echo $userPassword=mysqli_real_escape_string($conn, strip_tags($_POST['password']));
                // echo $userPhoneNumber=mysqli_real_escape_string($conn, strip_tags($_POST['contact_number']));
                $userName=mysqli_real_escape_string($conn, strip_tags($_POST['name']));
                $userEmail=mysqli_real_escape_string($conn, strip_tags($_POST['email']));
                $userPassword=mysqli_real_escape_string($conn, strip_tags($_POST['password']));
                if(isset($_POST['contact_number'])){
                    $userPhoneNumber=mysqli_real_escape_string($conn, strip_tags($_POST['contact_number']));
                }

                $ins_sql="INSERT INTO users (name, email, password, contact_number) VALUES ('$userName', '$userEmail', '$userPassword', '$userPhoneNumber')";
                // $run=mysqli_query($conn, $ins_sql);
                if(mysqli_query($conn, $ins_sql)){ ?>
                    <script>window.location="./index.php";</script>
                <?php
                }
            }


            // Deleting New User

            if(isset($_GET['del_id'])){
                $del_sql="DELETE FROM users WHERE id ='$_GET[del_id]'";
                // $run_sql=mysqli_query($conn, $del_sql);

                if(mysqli_query($conn, $del_sql)){?>
                <script>window.location="./index.php";</script>
               <?php
                }
            }

            //Updating or editing an existing user
        

            if(isset($_POST['edit_user_btn'])){
                // echo $userName=mysqli_real_escape_string($conn, strip_tags($_POST['name']));
                // echo $userEmail=mysqli_real_escape_string($conn, strip_tags($_POST['email']));
                // echo $userPassword=mysqli_real_escape_string($conn, strip_tags($_POST['password']));
                // echo $userPhoneNumber=mysqli_real_escape_string($conn, strip_tags($_POST['contact_number']));
                $editUser=mysqli_real_escape_string($conn, strip_tags($_POST['edit_user']));
                $editEmail=mysqli_real_escape_string($conn, strip_tags($_POST['edit_email']));
                $editPassword=mysqli_real_escape_string($conn, strip_tags($_POST['edit_password']));
                if(isset($_POST['edit_contact_number'])){
                    $editPhoneNumber=mysqli_real_escape_string($conn, strip_tags($_POST['edit_contact_number']));
                }
                $edit_id=$_POST['edit_user_id'];

                $edit_sql="UPDATE users SET name='$editUser', email='$editEmail', password='$editPassword', contact_number='$editPhoneNumber' WHERE id ='$edit_id'";
                // $run=mysqli_query($conn, $ins_sql);
                if(mysqli_query($conn, $edit_sql)){ ?>
                    <script>window.location="./index.php";</script>
                <?php
                }
            }
            
        ?>    


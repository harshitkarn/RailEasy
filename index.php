<?php
    $insert = true;
    $server = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($server, $username, $password);
    if(!$con){
        die("connect failed");
    }
    #echo "success";
    
    $user_name = $_POST['user_name'];
    $pwd = $_POST['pwd'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    #echo "$user_id,$pwd,$fname,$lname,$gender,$dob,$mobile,$address,$city";


    $sql = "insert into project.user_details values(NULL,'$user_name','$pwd','$fname','$lname','$gender','$dob',$mobile,'$address','$city');";
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online ticket booking system</title>
</head>

<style>
    body
    {
        margin: 0px;
        padding: 0px;
        background-image: url('img/bg3.png');
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        height: 150px;
        width: 150px;
    }
    .table {
        color: purple;
        padding-top: 100px;
        font-size: larger;
        border-spacing: 20px 0px;
        margin-left: auto;
        margin-right: auto;
    }
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    .bg {
        width: 100%;
        position: absolute;
        z-index: -1;
        opacity: 0.4;
    }
    h1,h2,p {text-align: center;}
    div{font-weight: bold;
    text-align: center;}
</style>
<body>
    <!--<img src="img/bg1.jpg" alt="background image" class="bg">-->
    <img src="img/bg.jpg" alt="logo" class="center">
    <h2>RailEasy</h2>
    <h1>Welcome to online rail reservation</h1>
    <div>
        This is an online railway ticket reservation system
    </div>
    <div>
        Now book your tickets directly from anywhere.
    </div>
    <div>No need to stand in long queues for your rail tickets.</div>
    <table class="table">
        <tr>
            <th>If u are existing user</th>
            <th>If u are new user</th>
        </tr>
        <tr>
            <td>
                <a href="signin.html" class="button">Sign In</a>
            </td>
            <td><a href="signup.html" class="button">Sign Up</a></td>
        </tr>
    </table>
    <?php
        if($con->query($sql) == true){
            echo "<p>Sign Up Success</p>";
        }
        else{echo "<p>invalid initials</p>";}
    ?>
</body>
</html>
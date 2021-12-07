<?php
    $insert = true;
    $server = "localhost";
    $username = "root";
    $password = "";
    $db="project";

    $con = mysqli_connect($server, $username, $password ,$db);
    if(!$con){
        die("connect failed");
    }
    #echo "success";

    $pwd = $_POST['pwd'];
    $user_name = $_POST['user_name'];
    $sql222 = "select user_id from user_details where user_name = '$user_name' and pwd = '$pwd';";
    $res222 = mysqli_query($con, $sql222);
    $row222 = mysqli_fetch_array($res222, MYSQLI_ASSOC);
    if(gettype($row222) == 'NULL')
    {
        echo '
            <script>
                alert("Invalid username or password");
               window.location.href = "signin.html";
            </script>
       ';
        die();
    }
    $user_id = $row222['user_id'];

    $sql0 = "select fname from user_details where user_name='$user_name';";
    $res = mysqli_query($con,$sql0);
    $row0 = mysqli_fetch_array($res, MYSQLI_ASSOC);
    #echo $row0['fname'];

    echo "<h1>Welcome Back</h1>";
    echo "<h1>";
    echo $row0['fname'];
    echo "</h1>";

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RailEasy</title>
</head>
<style>
    body
    {
        margin: 0px;
        padding: 0px;
        background-image: url('img/bg3.png');
    }
    .submit {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 50px;
        margin-bottom: 50px;
        font-size: 16px;
        
        cursor: pointer;
    }
    h1,h2,p {text-align: center;}
    div{font-weight: bold;
    text-align: center;}
    a{
        margin-top: 40px;
        text-align: center;
        font-size: large;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
        width: 5%;
    }
</style>
<body>
    <form action="newbooking.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
        <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
        <input type="submit" value="New Booking" class="submit">
    </form>
    <form action="mybookings.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
        <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
        <input type="submit" value="My bookings" class="submit">
    </form>
    
    <a href="home.html">Log out</a>
</body>
</html>

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
    $user_id = $_POST['user_id'];
    $pwd = $_POST['pwd'];
    $user_name = $_POST['user_name'];
    $train_no=$_POST['train_no'];
    $seat=$_POST['seat'];
    $jrny_date = $_POST['jrny_date'];

    $sql2="select sleeper_cnf,sleeper_wait,AC_cnf,AC_wait from seats_avail where train_no=$train_no;";
    $res2 = mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);

    if($seat=='AC')
    {
        if($row2['AC_cnf']>0)
         {
            $seat_type="AC_cnfm";
            
         }
         else
         {
            $seat_type="AC_wait";
            
         }
         
    }
    else{
        if($row2['sleeper_cnf']>0)
         {
            $seat_type="SL_cnfm";
         }
         else
         {
            $seat_type="SL_wait";
                     }
    }

    $sql11="update seats_avail set sleeper_cnf=sleeper_cnf-1 where train_no=$train_no;";
    $sql22="update seats_avail set sleeper_wait=sleeper_wait-1 where train_no=$train_no;";
    $sql33="update seats_avail set AC_cnf=AC_cnf-1 where train_no=$train_no;";
    $sql44="update seats_avail set AC_wait=AC_wait-1 where train_no=$train_no;";
    $sql111 = "insert into bookings values('$user_id',$train_no,'$jrny_date','$seat_type');";
    

    if($seat=='AC')
    {
        if($row2['AC_cnf']>0)
         {
            $seat_type="AC_cnfm";
            if($con->query($sql111)){echo "<p>booking success</p>";
                $con->query($sql33);
            }
            else {echo "<p>Date out of booking period/More than 1 ticket for 1 train not allowed</p>";}
         }
         else if($row2['AC_wait']>0)
         {
            $seat_type="AC_wait";
            if($con->query($sql111)){echo "<p>booking success</p>";
                $con->query($sql44);
            }
            else {echo "<p>Date out of booking period/More than 1 ticket for 1 train not allowed</p>";}
         }
         else
         {
            echo "<p>seats not available</p>";
         }
    }
    else{
        if($row2['sleeper_cnf']>0)
         {
            $seat_type="SL_cnfm";
            if($con->query($sql111)){echo "<p>booking success</p>";
                $con->query($sql11);
            }
            else {echo "<p>Date out of booking period/More than 1 ticket for 1 train not allowed</p>";}
         }
         else if($row2['sleeper_wait']>0)
         {
            $seat_type="SL_wait";
            if($con->query($sql111)){echo "<p>booking success</p>";
                $con->query($sql22);
            }
            else {echo "<p>Date out of booking period/More than 1 ticket for 1 train not allowed</p>";}
         }
         else
         {
            echo "<p>seats not available</p>";
         }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm payment</title>
</head>
<style>
    p {text-align: center;
       font-size:larger;
       color:green;
     }
    div{font-weight: bold;
    text-align: center;}
    .button {
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
    form{
        display: block;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
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
<form action="userhome.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
    <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
    <input type="submit" value="home" class=button>
</form>
<a href="home.html">Log out</a>
</body>
</html>
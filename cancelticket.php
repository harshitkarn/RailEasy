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
    $user_id = $_GET['user_id'];
    $train_no = $_GET['train_no'];
    $pwd = $_GET['pwd'];
    $user_name = $_GET['user_name'];
    
    $sql="delete from bookings where user_id=$user_id and train_no=$train_no;";
    if($con->query($sql) == true)
    {
        echo '
            <p>Ticket cancel success</p>
       ';
    }
    else{
        echo '
        <p>Error cancelling ticket</p>
   ';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Message</title>
</head>
<style>
    p {text-align: center;
       font-size:larger;
       color: green;
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
<form action="mybookings.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
    <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
    <input type="submit" value="Go back to your bookings" class=button>
</form>
<a href="home.html">Log out</a>
</body>
</html>

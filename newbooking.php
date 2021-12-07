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
    $user_id = $_POST['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book new Ticket</title>
</head>
<style>
     body
    {
        margin: 0px;
        padding: 0px;
        background-image: url('img/bg3.png');
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
    input,select{
        margin-bottom: 20px;
        margin-top: 5px;
        border-radius: 3px;
        font-size: large;
    }
    form{
        display: block;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    
</style>
<body>
    <h2>Book New Ticket</h2>
<form action="payment.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
    <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
    <label for="from_stn">From</label>
    <select name="from_stn" id="from_stn">
        <option value="Bangalore">Bangalore</option>
        <option value="Delhi">Delhi</option>
        <option value="Patna">Patna</option>
        <option value="Howrah">Howrah</option>
    </select><br>
    <label for="to_stn">To</label>
    <select name="to_stn" id="to_stn">
        <option value="Delhi">Delhi</option>
        <option value="Mumbai">Mumbai</option>
        <option value="Indore">Indore</option>
        <option value="Bangalore">Bangalore</option>
    </select><br>
    <label for="jrny_date">Departure Date</label>
    <input type="date" id="jrny_date" name="jrny_date"><br>
    <input type="submit" value="Search for trains">
</form>
<form action="userhome.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
        <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
        <input type="submit" value="Cancel">
</form>
<a href="home.html">Log out</a>
</body>
</html>
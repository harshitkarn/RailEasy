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
    $from_stn = $_POST['from_stn'];
    $to_stn = $_POST['to_stn'];
    $jrny_date = $_POST['jrny_date'];
    $sql0="select train_no from train_det where from_stn='$from_stn' and to_stn='$to_stn';";
    $res0 = mysqli_query($con,$sql0);
    $row0 = mysqli_fetch_array($res0, MYSQLI_ASSOC);
    if(gettype($row0) == 'NULL')
    {
        echo '
            <p>no trains between selected stations
            Please try again</p>
        ';
        die();
       
    }
    $train_no=$row0['train_no'];
    $sql1="select train_no,train_name,dep_time,arr_time,jrny_dur from train_det where train_no=$train_no;";
    $res1 = mysqli_query($con,$sql1);
    echo "<table>";
    echo "<tr><th>Train no</th><th>Train name</th><th>Departure</th><th>Arrival</th><th>Journey duration</th>";
    while($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC))
         {  
            echo "<tr><td>";
            echo $row1['train_no'];
            echo "</td><td>";
            echo $row1['train_name'];
            echo "</td><td>";
            echo $row1['dep_time'];
            echo "</td><td>";
            echo $row1['arr_time'];
            echo "</td><td>";
            echo $row1['jrny_dur'];
            echo "</td></tr>";

         }
    echo "</table>";
    echo "<br><br>";
    $sql2="select sleeper_cnf,sleeper_wait,AC_cnf,AC_wait from seats_avail where train_no=$train_no;";
    $res2 = mysqli_query($con,$sql2);
    echo "<table>";
    echo "<tr><th>Available Sleeper</th><th>Waiting Sleeper</th><th>Available AC</th><th>Waiting AC</th>";
    while($row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC))
         {  
            echo "<tr><td>";
            echo $row2['sleeper_cnf'];
            echo "</td><td>";
            echo $row2['sleeper_wait'];
            echo "</td><td>";
            echo $row2['AC_cnf'];
            echo "</td><td>";
            echo $row2['AC_wait'];
            echo "</td></tr>";

         }
    echo "</table>";
    echo "<br><br>";

    $sql3="select fare_sleeper,fare_AC from train_fare where train_no=$train_no;";
    $res3 = mysqli_query($con,$sql3);
    echo "<table>";
    echo "<tr><th>Sleeper Price</th><th>AC Price</th>";
    while($row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC))
         {  
            echo "<tr><td>";
            echo $row3['fare_sleeper'];
            echo "</td><td>";
            echo $row3['fare_AC'];
            echo "</td></tr>";

         }
    echo "</table>";
    echo "<br><br>";
    
    echo $user_id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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
        font-size: large;
    }
    table {
        color: purple;
        padding-top: 5px;
        font-size: larger;
        border-spacing: 20px 0px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<body>
    <form action="booked.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
    <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
    <input type="hidden" name="train_no" value="<?php echo $train_no; ?>">
    <input type="hidden" name="jrny_date" value="<?php echo $jrny_date; ?>">
    <label for="seat">Choose ur seat type</label>
    <select name="seat" id="seat">
        <option value="AC">AC</option>
        <option value="sleeper">Sleeper</option>
    <input type="submit" value="Book Ticket">
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
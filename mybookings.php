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
 $userid = $user_id;
 $sql = "select t.train_no,t.train_name,b.jrny_date,t.dep_time,t.from_stn,t.to_stn,b.seat_type from train_det t,bookings b where t.train_no=b.train_no and b.user_id = $user_id;";
 $sql1 = "CALL `show bookings`($userid);";
    if($con->query($sql) == true){
        #echo "success";
    }
    else{echo "$con->error";
    }
 echo "<h2>My Bookings</h2>";
    $sqldata999 = mysqli_query($con,$sql);
    $row999 = mysqli_fetch_array($sqldata999, MYSQLI_ASSOC);
    if(gettype($row999)=='NULL'){
        echo "<p>No boookings yet</p>";
    }
    else{
        $sqldata = mysqli_query($con,$sql1);
    echo "<table>";
    echo "<tr><th>Train no</th><th>Train name</th><th>Journey date</th><th>departure</th><th>from</th><th>To</th><th>Seat Type</th><th>Cancel Ticket</th>";
    while($row1 = mysqli_fetch_array($sqldata, MYSQLI_ASSOC))
         {  
            echo "<tr><td>";
            echo $row1['train_no'];
            echo "</td><td>";
            echo $row1['train_name'];
            echo "</td><td>";
            echo $row1['jrny_date'];
            echo "</td><td>";
            echo $row1['dep_time'];
            echo "</td><td>";
            echo $row1['from_stn'];
            echo "</td><td>";
            echo $row1['to_stn'];
            echo "</td><td>";
            echo $row1['seat_type'];
            echo "</td><td>";
            echo "<a href='cancelticket.php?user_id=$user_id&train_no=$row1[train_no]&user_name=$user_name&pwd=$pwd'>Cancel";
            echo "</td></tr>";

         }
    echo "</table>";
    echo "<br><br>";
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My bookings</title>
</head>
<style>
    body
    {
        margin: 0px;
        padding: 0px;
        background-image: url('img/bg3.png');
    }
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
    h1,h2,p {text-align: center;}
    div{font-weight: bold;
    text-align: center;}
    .home{
        margin-top: 70px;
        text-align: center;
        font-size: large;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
        width: 5%;
    }
    table {
        text-align:center;
        color: purple;
        padding-top: 5px;
        font-size: larger;
        border-spacing: 20px 0px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<body>
<form action="userhome.php" method="POST">
    <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
    <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
    <input type="submit" value="Go Back" class=button>
</form>
<a href="home.html" class="home">Log Out</a>
</body>
</html>
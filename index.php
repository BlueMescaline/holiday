<?php
require('include/functions.php');
include('include/head.html');

//check for logged user
session_start();
if (isset($_SESSION['logged_user'])){
    echo "Hi your ID is: ".$_SESSION['logged_user'];
}
else{echo "not logged in";}

// error message
if(isset($_GET['error']) and !empty($_GET['error'])){
    switch ($_GET['error']){
        case 1: echo "<b>Invalid holiday ID!</b>"; break;
    }
}
?>
<h2>List of holidays</h2>
<table width='500px'>
    <thead>
    <tr>
        <th>Destination</th>
        <th>Start date</th>
        <th>End date</th>
        <th>Available seats</th>
    </tr>
    </thead>
    <tbody>
            <?php
            $holidays=listHolidays();

            foreach($holidays as $holiday){
               echo "<tr align='center'>";
                echo "<td><a href='view_holiday.php?id=".$holiday['holiday_id']."'>".$holiday['destination']."</a></td>";
                echo "<td><a href='view_holiday.php?id=".$holiday['holiday_id']."'>".$holiday['startDate']."</a></td>";
                echo "<td><a href='view_holiday.php?id=".$holiday['holiday_id']."'>".$holiday['endDate']."</a></td>";
                echo "<td><a href='view_holiday.php?id=".$holiday['holiday_id']."'>".$holiday['seat']."</a></td>";
            }
            echo"</tr>";

            ?>
    </tbody>
</table>
</body>
</html>

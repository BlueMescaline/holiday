<?php
include('include/head.html');
require('include/functions.php');
?>
<h2>User</h2>
<table width='500px'>
    <thead>
    <tr>
        <th>travel id</th>
        <th>destination</th>
        <th>start date</th>
        <th>end date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $travels=travelsByUser($_GET['user']);
    foreach($travels as $travel){
        echo "<tr align='center'>";
        echo "<td>".$travel['travel_id']."</td>";
        echo "<td>".$travel['destination']."</td>";
        echo "<td>".$travel['startDate']."</td>";
        echo "<td>".$travel['endDate']."</td>";
    }
    echo"</tr>";
    ?>
    </tbody>
</table>
</body>
</html>
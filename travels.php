<?php
include('include/head.html');
require('include/functions.php');
?>
<h2>List of travels</h2>
<table width='500px'>
    <thead>
    <tr>
        <th>travel id</th>
        <th>holiday</th>
        <th>client name</th>
        <th>seats left</th>
    </tr>
    </thead>
    <tbody>
            <?php
            $travels=listTravels();
            if (!empty($travels)){
            foreach($travels as $travel){
                echo "<tr align='center'>";
                echo "<td><a href='view_travel.php?id=".$travel['travel_id']."'>".$travel['travel_id']."</a></td>";
                echo "<td><a href='travels_destination.php?dest=".$travel['destination']."'>".$travel['destination']."</a></td>";
                echo "<td><a href='travels_user.php?user=".$travel['userId']."'>".$travel['name']."</a></td>";
                echo "<td><a href='travels_destination.php?user=".$travel['userId']."'>".$travel['seat']."</a></td>";
            }
            echo"</tr>";
            }
            else {echo "empty table";}
            ?>

</tbody>
</table>
</body>
</html>
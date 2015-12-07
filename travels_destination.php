<?php
include('include/head.html');
require('include/functions.php');
?>

<h2><?php echo $_GET['dest'] ?></h2>
<table width='500px'>
    <thead>
    <tr>
        <th>travel id</th>
        <th>user name</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $travels=travelsByDestination($_GET['dest']);
    foreach($travels as $travel){
        echo "<tr align='center'>";
        echo "<td>".$travel['travel_id']."</td>";
        echo "<td>".$travel['name']."</td>";

    }
    echo"</tr>";

    ?>
    </tbody>
</table>
</body>
</html>
<?php

require('include/functions.php');
include('include/head.html');
?>

<h2>List of users</h2>
<table width='500px'>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email address</th>
        <th>Phone number</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $users=listUsers();
    foreach($users as $user){
        echo "<tr align='center'>";
        echo "<td><a href='view_user.php?id=".$user['user_id']."'>".$user['name']."</a></td>";
        echo "<td><a href='view_user.php?id=".$user['user_id']."'>".$user['email']."</a></td>";
        echo "<td><a href='view_user.php?id=".$user['user_id']."'>".$user['phone']."</a></td>";
    }
    echo"</tr>";

    ?>
    </tbody>
</table>
</body>
</html>

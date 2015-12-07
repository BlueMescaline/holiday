<?php
require('include/functions.php');
include('include/head.html');

//we can only view the user if we get the id in the url and the id is stored in db
if(isset($_GET['id']) && userIsValid($_GET['id'])){
    $user = viewUser($_GET['id']);
}
else {
    header('Location:index.php?error=1');
}
?>
<h2>View</h2>
<table border="1" width="400">
    <tr><th>Name</th><td><?php echo $user['name']; ?></td></tr>
    <tr><th>Email address</th><td><?php echo $user['email']; ?></td></tr>
    <tr><th>Phone</th><td><?php echo $user['phone']; ?></td></tr>
</table>

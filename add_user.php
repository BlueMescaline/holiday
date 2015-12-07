<?php
include('include/head.html');
require('include/functions.php');

if (isset($_POST['reg'])){
    register();
}

//eror messages
if(isset($_GET['error']) and !empty($_GET['error'])){
    switch ($_GET['error'])
    {
        case 1: echo "<b>You must fill all fields to save!</b>"; break;
        case 2: echo "<b>'Confirm password' and 'Password' do not match.</b>"; break;
        case 3: echo "<b>Email address already exist!</b>"; break;
        case 4: echo "<b>User successfully added!</b>"; break;
    }
}
?>
<h2>register</h2>
<form method="post" action="add_user.php">
    <label for="name">Name:</label>
        <input type="text" name="name" required><br/><br/>
    <label for="email">Email:</label>
        <input type="email" name="email" required><br/><br/>
    <label for="name">Phone:</label>
        <input type="tel" name="phone" required><br/><br/>

    <label for="pass">Password</label>
        <input type="password" name="pass" required><br/><br/>

    <label for="confirm_pass">Confirm password</label>
        <input type="password" name="confirm_pass" required><br/><br/>

    <input type="submit" name="reg" value="Register">
</form>

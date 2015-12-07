<?php
include('include/head.html');
require('include/functions.php');

session_start();
//check the user is logged in or not and set the status
if (isset($_SESSION['logged_user'])){
    $status='loggedin';
    echo "Hi your ID is: ".$_SESSION['logged_user'];
}
else{ $status='loggedout';}

//check for pressed button (login or logout)
if (isset($_POST['login'])){login();}
if (isset($_POST['logout'])){logout();}



//error messages
if (isset($_GET['error']) && !empty($_GET['error'])){
    switch ($_GET['error']){
        case 1: echo "<b>You must fill both fields log in!</b>"; break;
        case 2: echo "<b>Incorrect username or password</b>"; break;
        case 3: echo "<b>You must be logged in, to join!</b>"; break;
    }
}
?>
<h2>Log in / Log out</h2>
<?php
$login="<form action='login_logout.php' method='post'>
    <label for='email'>Email address:</label>
    <input type='email' name='email' placeholder='address@example.com' required><br/><br/>
    <label for='password'>Password:</label>
    <input type='password' name='pass' required><br/><br/>
    <input type='submit' name='login' value='Log in'><br/><br/>
    </form>";
$logout="<form action='login_logout.php' method='post'> <input type='submit' name='logout' value='Log out'> </form>";

//if the user is logged in, there is just log out, otherwise print the login form
switch ($status){
    case 'loggedin': echo $logout; break;
    case 'loggedout': echo $login; break;
}
?>

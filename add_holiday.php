<?php
include('include/functions.php');
include('include/head.html');


if (isset($_POST['add'])){
    saveNewHoliday();
}

//error messages
if(isset($_GET['error']) and !empty($_GET['error'])){
    switch ($_GET['error'])
    {
        case 1: echo "<b>You mst fill all fields to save!</b>"; break;
        case 2: echo "<b>Holiday successfully added!</b>"; break;
    }
}
?>

<h2>Add holiday</h2>
<form  method=post action=add_holiday.php>

    <label for="destination">Destination:</label>
        <input type="text" name="destination"> <br/><br/>

    <label for="start">Start date:</label>
        <input type="date" name="start"> <br/><br/>

    <label for="start">End date:</label>
        <input type="date" name="end"> <br/><br/>

    <label for="seat">Seats:</label>
    <input type="number" name="seat" min="1" max="100"> <br/><br/>

    <input type="submit" name="add" value="Add"> <br/><br/>

</form>
</body>
</html>


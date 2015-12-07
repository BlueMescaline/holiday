
<?php
require('include/functions.php');
include('include/head.html');

//we can only view the holiday if we get the id in the url and the id is stored in db
if(isset($_GET['id']) && holidayIsValid($_GET['id'])){
    $holiday = viewHoliday($_GET['id']);
}
else {
    header('Location:index.php?error=1');
}

//call the join function if Join button is clicked
if(isset($_POST['join'])){
    joinToHoliday();
}

//error messages
if(isset($_GET['error']) and !empty($_GET['error'])){
    switch ($_GET['error']){
        case 1: echo "<b>Successfully joined!</b>"; break;
        case 2: echo "<b>You must enter a number!</b>"; break;
        case 3: echo "<b>Too much required seat, or there is no one left!</b>"; break;
    }
}
?>
    <h2>View</h2>
    <table border="1" width="400">
            <tr><th>Destination</th><td><?php echo $holiday['destination']; ?></td></tr>
            <tr><th>Start date</th><td><?php echo $holiday['startDate']; ?></td></tr>
            <tr><th>End date</th><td><?php echo $holiday['endDate']; ?></td></tr>
            <tr><th>Available</th><td><?php echo $holiday['seat']; ?></td></tr>
    </table>
    <form action="view_holiday.php" method="post">
        <input type="hidden" name="id" value="<?php echo $holiday['holiday_id'] ?>">
        <label for="seats">Seats:</label>
        <input type="number" name="seat" min="1"><br/>
        <input type="submit" name="join" value="Join">
    </form>




<?php
require('db_config.php');

////////////////////////////////-functions related to HOLIDAYS-\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/**
 * if every input field is filled and correct, insert a new row to Holidays table
 */
function saveNewHoliday(){
    global $connection;
    $dest=mysqli_real_escape_string($connection,$_POST['destination']);
    $start=mysqli_real_escape_string($connection,$_POST['start']);
    $end=mysqli_real_escape_string($connection,$_POST['end']);
    $seat=mysqli_real_escape_string($connection,$_POST['seat']);

    if (empty($dest) || empty($start) || empty($end) || empty($seat)){
        header('Location:add_holiday.php?error=1');
    }

    else{
        $sql = "INSERT INTO holidays(destination, startDate, endDate, seat) VALUES ('$dest','$start','$end','$seat')";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        header('Location:add_holiday.php?error=2');
    }
}

/**
 *Returns everything from Holidays table in associative array
 * @return array|null
 */
function listHolidays(){
    global $connection;
    $sql = "SELECT * FROM holidays";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result)>0){
        return mysqli_fetch_all($result, $resulttype = MYSQLI_ASSOC);
    }
}

/**
 * Returns the selected row in assoc. array from Holidays table by the holiday_id parameter
 * @param $holiday_id
 * @return array|null
 */
function viewHoliday($holiday_id){
    global $connection;
    $sql = "SELECT * from holidays WHERE holidays.holiday_id= '$holiday_id'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result)>0){
        //    return mysqli_fetch_all($result, $resulttype = MYSQLI_ASSOC);
        return mysqli_fetch_assoc($result);
    }
}

/**
 * Returns true if the Id is number, and stored in holidays table, otherwise returns false
 * @param $holiday_id
 * @return bool
 */
function holidayIsValid($holiday_id){
    global $connection;
    if (!is_numeric($holiday_id)){
        return false;
    }
    else {
        $sql="SELECT holiday_id FROM holidays WHERE holiday_id='$holiday_id'";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if (mysqli_num_rows($result)>0){
            return true;
        }
    }
}

/**
 * If there is available seat, every form input is submitted and there is a logged in user
 * we insert user and holiday id to travel table
 * decrease available seats by submitted value
 */
function joinToHoliday(){
     global $connection;
     $holiday_id=$_POST['id'];
     $seat_req=$_POST['seat'];

     if(!isset($holiday_id) or !isset($seat_req) or empty($holiday_id) or empty($seat_req)){
         header('Location:view_holiday.php?id='.$holiday_id.'&error=2');
     }
     elseif (!checkSeats($holiday_id,$seat_req)){
        header('Location:view_holiday.php?id='.$holiday_id.'&error=3');
        }
     else{
         session_start();
         if(!isset($_SESSION['logged_user'])){
             header('Location:login_logout.php?error=3');
         }
         elseif(isset($_SESSION['logged_user'])){
             $user_id=$_SESSION['logged_user'];
             $sql= "INSERT INTO travels(holidayId, userId) VALUES('$holiday_id','$user_id');";
             $sql .= "UPDATE holidays SET seat=seat-'$seat_req' WHERE holiday_id = $holiday_id";
             $result = mysqli_multi_query($connection, $sql) or die(mysqli_error($connection));
             header('Location:view_holiday.php?id='.$holiday_id.'&error=1');
         }
     }
 }

/**
 * check for available seats.
 * if the requested holiday stored in db, and its available seats are less than the request, returns false
 * @param $holiday_id
 * @param $seat_req
 * @return bool
 */
function checkSeats($holiday_id, $seat_req){
         global $connection;
         $sql="SELECT seat from holidays WHERE holiday_id='$holiday_id'";
         $result=mysqli_query($connection, $sql) or die(mysqli_error($connection));

         if (mysqli_num_rows($result)>0){
             $holiday=mysqli_fetch_assoc($result);
             if ($holiday['seat']<$seat_req){
                return false;
                }
             else{
                 return true;
             }
         }
     }

//////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


////////////////////////////////-functions related to USERS-\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/**
 *if all input field filled correctly, password=password confirmation, and email address does not stored yet, call saveNewUser() which inserts to db
 */
function register(){
    global $connection;
    $name = mysqli_real_escape_string($connection,$_POST['name']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $phone = mysqli_real_escape_string($connection,$_POST['phone']);
    $password = mysqli_real_escape_string($connection,$_POST['pass']);
    $confirm_password = mysqli_real_escape_string($connection,$_POST['confirm_pass']);

    if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($confirm_password)){
        header('Location:add_user.php?error=1');
    }
    elseif($password!==$confirm_password){
        header('Location:add_user.php?error=2');
    }
    elseif(checkUserExist($email)){
        header('Location:add_user.php?error=3');
    }
    else{
        saveNewUser($name, $email, $phone, $password );
    }
}

/**
 * Returns true, if the email address is stored in the users table
 * @param $email
 * @return bool
 */
function checkUserExist($email){
    global $connection;
    $sql="SELECT user_id FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    if (mysqli_num_rows($result)>0){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Insert a row to Users after password hashing
 * @param $name
 * @param $email
 * @param $phone
 * @param $password
 */
function saveNewUser($name, $email, $phone, $password){
    global $connection;
    $passwd = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name','$email','$phone', '$passwd' )";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        header('Location:add_user.php?error=4');
 /////////// //mysqli_insert_id() — Returns the auto generated id used in the last query\\\\\\\\\\\\\\\\\\\\\\\

}

/**
 * select all date from users table and returns as an assoc. array
 * @return array|null
 */
function listUsers(){
    global $connection;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result)>0){
        return mysqli_fetch_all($result, $resulttype = MYSQLI_ASSOC);
    }
}


/**
 * if login form filled correctly and if the email is stored in users table
 * verify thr submitted and the stored password
 * if it is done store user id in a session variable and redirect
 */
function login(){
    global $connection;
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['pass']);

    if((empty($email) || empty($password))){
        header('Location:login_logout.php?error=1');
    }
    else{
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ((mysqli_num_rows($result)>0)){
            $user = mysqli_fetch_assoc($result);

            if(password_verify($password, $user['password'])){
                //session_start();
                $_SESSION['logged_user']=$user['user_id'];
                header('Location:index.php');
            }
            else{
                header('Location:login_logout.php?error=2');
            }
        }
    }
}

/**
 * unset the session var which stores user_id
 * destroy session, redirect
 */
function logout(){
       unset($_SESSION['logged_user']);
        session_destroy();
    header('Location:index.php');

}

/**
 * Returns true if the Id is number, and stored in users table, otherwise returns false
 * @param $user_id
 * @return bool
 */
function userIsValid($user_id){
    global $connection;
    if (!is_numeric($user_id)){
        return false;
    }
    else {
        $sql="SELECT user_id FROM users WHERE user_id='$user_id'";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if (mysqli_num_rows($result)>0){
            return true;
        }
    }
}

/**
 * Returns the selected row in assoc. array from users table by the user_id parameter
 * @param $user_id
 * @return array|null
 */
function viewUser($user_id){
    global $connection;
    $sql = "SELECT * from users WHERE users.user_id= '$user_id'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result)>0){
        return mysqli_fetch_assoc($result);
    }
}


//////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


/**
 * select and return the details of the travel by joining the tables
 * @return array|null
 */
function listTravels(){
    global $connection;
    $sql="SELECT travels.travel_id, travels.userId, holidays.destination, holidays.seat, users.name
                        FROM travels
                        JOIN holidays ON travels.holidayId=holidays.holiday_id
                        JOIN users ON travels.userId=users.user_id
                        ";
    $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
    if (mysqli_num_rows($result)>0){
        return mysqli_fetch_all($result, $resulttype = MYSQLI_ASSOC);
    }
}

/**
 * returns all details of travel, to the selected destination
 * @param $destination
 * @return array|null
 */
function travelsByDestination($destination){
    global $connection;
    $sql="SELECT travels.travel_id, users.name
                        FROM travels
                        JOIN holidays ON travels.holidayId=holidays.holiday_id
                        JOIN users ON travels.userId=users.user_id
                        WHERE holidays.destination= '$destination';
                        ";
    $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
    if (mysqli_num_rows($result)>0){
        return mysqli_fetch_all($result, $resulttype = MYSQLI_ASSOC);
    }
}

/**
 * get the user id and returns every holiday, where the user is joined
 * @param $user_id
 * @return array|null
 */
function travelsByUser($user_id){
    global $connection;
    $sql="SELECT travels.travel_id, holidays.destination, holidays.startDate, holidays.endDate
                        FROM travels
                        JOIN holidays ON travels.holidayId=holidays.holiday_id
                        JOIN users ON travels.userId=users.user_id
                        WHERE travels.userId= '$user_id';
                        ";
    $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
    if (mysqli_num_rows($result)>0){
        return mysqli_fetch_all($result, $resulttype = MYSQLI_ASSOC);
    }

}

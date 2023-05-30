<?php
include_once("config.php");


$bqur = "SELECT * FROM borrow_book WHERE date_returned = '0000-00-00'";
$bqurres = mysqli_query($conn, $bqur);
$brow = mysqli_num_rows($bqurres);
while ($row = mysqli_fetch_assoc($bqurres)) {
    $squr = "SELECT * FROM student_master WHERE S_id = '$row[user_id]'";
    $squrres = mysqli_query($conn, $squr);
    $squrrow = mysqli_fetch_assoc($squrres);
    $curdate = date("Y-m-d");
    echo $squrrow['S_id'];
    echo $curdate, " + ", $row['due_date'], "/n";
    if ($brow > 0 and $row['due_date'] < $curdate) {
        $date1 = date_create($row['due_date']);
        $date2 = date_create(date("Y-m-d"));
        $diff = date_diff($date1, $date2);
        $diff = $diff->format("%a");
        if ($diff > 0) {
            $penalty = $diff * 100;
            $penalty = $penalty + $row['penalty'];
            $uqur = "UPDATE student_master SET penalty = '$penalty' WHERE S_id = '$squrrow[S_id]'";
            $uqurres = mysqli_query($conn, $uqur);
        }
    }
}

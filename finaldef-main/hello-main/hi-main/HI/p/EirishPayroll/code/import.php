<?php
// Load the database configuration file
include_once 'connection.php';

if (isset($_POST["importSubmit"])) {
    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $bug = 0;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $bug++;
            if ($getData[0] != '') {
                $time_in = strtotime($getData[4]);
                $time_out = strtotime($getData[5]);
                $total_seconds = $time_out - $time_in;
                $total_hours = round($total_seconds / 3600, 2);
                $formatted_time = gmdate("H:i:s", $total_seconds);

                $sql = "INSERT into attendancee (emp_id,name,date,time_in,time_out,total_hours) 
                        values ('" . $getData[1] . "','" . $getData[2] . "','" . $getData[3] . "','" . $getData[4] . "','" . $getData[5] . "','" . $formatted_time . "')";
                $result = mysqli_query($con, $sql);
            }
        }
        fclose($file);
    }
    $qstring = '?status=succ';
} else {
    $qstring = '';
}

header("Location: attendance.php" . $qstring);

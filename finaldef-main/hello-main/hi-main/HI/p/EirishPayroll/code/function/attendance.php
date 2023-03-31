<?php

function attendance($id, $rate)
{
    global $hours, $total_over, $overtimemins, $excesstime, $salary;

    // computing attendance per employee
    
    $query2 = mysqli_query($GLOBALS['con'], "SELECT * FROM attendancee WHERE isattendance = '0' AND emp_id = '$id' ");

    $time = [];
    $excess_time = [];

    $overtime = [];
    $overtime_mins = [];

    while ($row = mysqli_fetch_assoc($query2)) {
        $total_hours = $row['total_hours'];

        if ($total_hours <= '08:00:00') {
            array_push($time, $total_hours);

            $timestamp = strtotime($total_hours);

            if (date("i", $timestamp) > '0' && date("i", $timestamp) >= '30') {
                array_push($excess_time, 30);
            }
        } elseif ($total_hours > '08:00:00' && $total_hours  <= '08:59:00') {
            $timestamp = strtotime($total_hours);

            $timediff = ($timestamp - strtotime("08:00:00")) - strtotime("16:00:00");

            $th = strtotime($total_hours) - strtotime($timediff);
            $t = date("h:i:s", $th);
            array_push($time, $t);

            if (date("i", $timestamp) > '0' && date("i", $timestamp) >= '30') {
                array_push($overtime_mins, 30);
            }
        } else {
            $timediff = ((strtotime($total_hours) - strtotime("08:00:00")) - strtotime("16:00:00"));

            $th = strtotime($total_hours) - strtotime($timediff);
            $t = date("h:i:s", $th);
            array_push($time, $t);

            $timestamp = ($th - strtotime("08:00:00") - 3600);

            $h = date("h:00:00", $timestamp);
            array_push($overtime, $h);

            if (date("i", $timediff) > '0' && date("i", $timediff) >= '30') {
                array_push($overtime_mins, 30);
            }
        }
    }

    $sum = strtotime('00:00:00');

    $totaltime = 0;
    $excesstime = 0;

    $totalovertime = 0;
    $overtimemins = 0;

    // getting hours 
    foreach ($time as $element) {
        $timeinsec = strtotime($element) - $sum;
        $totaltime = $totaltime + $timeinsec;
    }

    $hours = intval($totaltime / 3600);

    // getting excess mins
    foreach ($excess_time as $excess) {
        $excesstime = $excesstime + $excess;

        if ($excesstime / 60 == 1) {
            $hours = $hours++;
            $excesstime = 0;
        } else {
            $excesstime = 30;
        }
    }

    // getting overtime
    foreach ($overtime as $over) {
        $timeinsec = strtotime($over) - $sum;
        $totalovertime = $totalovertime + $timeinsec;
    }

    $total_over = intval($totalovertime / 3600);

    // getting excess overtime
    foreach ($overtime_mins as $overmin) {
        $overtimemins = $overtimemins + $overmin;
        if ($overtimemins / 60 == 1) {
            $total_over = $total_over + 1;
            $overtimemins = 0;
        } else {
            $overtimemins = 30;
        }
    }

    // salary
    $salary = $hours * $rate;
    if ($excesstime || $overtimemins) {
        $half_rate = $rate / 2;
        $salary =  $salary + $half_rate;
    }

    deduction($id);
}

function deduction($id)
{
    global $ca_id, $ca_deduction;
    $cash_advance = mysqli_query($GLOBALS['con'], "Select * From cash_advance WHERE emp_id = '$id'");
    while ($rows = mysqli_fetch_assoc($cash_advance)) {
        $ca_id = $rows['emp_id'];
        $ca_deduction = $rows['ca_deduction'];
    }
}

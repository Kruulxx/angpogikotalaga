<?php
function add_deduction()
{
    if (isset($_POST['add'])) {
        $id = $_POST['emp-name'];
        $deduction = $_POST['deduction'];
        $date = date('Y-m-d');
        $total = 0;

        // select for name
        $select = mysqli_query($GLOBALS['con'], "SELECT * FROM employee WHERE emp_id = '$id'");
        while ($row = mysqli_fetch_assoc($select)) {
            $name = $row['name'];
        }

        // check for cash_advance
        $select_cash_advance = mysqli_query($GLOBALS['con'], "SELECT * FROM cash_advance WHERE emp_id = '$id'");
        while ($row = mysqli_fetch_assoc($select_cash_advance)) {
            $total = $total + $row['total_cash_advance'];
            $deduction = $deduction + $total;

            if ($deduction != 0) {
                $update = mysqli_query($GLOBALS['con'], "UPDATE cash_advance SET total_cash_advance = '$deduction' WHERE emp_id = '$id'");
            }
        }

        if (mysqli_num_rows($select_cash_advance) === 0 && $deduction != 0) {
            $insert = mysqli_query($GLOBALS['con'], "INSERT INTO cash_advance (emp_id,  name, total_cash_advance, date) VALUES ( '$id', '$name', '$deduction', '$date')");
        }
    };
}
add_deduction();

function edit_deduction()
{
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $deduction = $_POST['ca-deduction'];

        // check for cash_advance
        $select_cash_advance = mysqli_query($GLOBALS['con'], "SELECT * FROM cash_advance WHERE emp_id = '$id'");
        while ($row = mysqli_fetch_assoc($select_cash_advance)) {
            $cash_advance = $row['total_cash_advance'];
        }

        if ($deduction <= $cash_advance) {
            $total = $cash_advance - $deduction;

            $update_query = mysqli_query($GLOBALS['con'], "UPDATE cash_advance SET ca_deduction = '$deduction', total_cash_advance = '$total' WHERE emp_id = '$id'");

        }
    };
}
edit_deduction();

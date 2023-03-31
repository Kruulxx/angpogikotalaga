<?php

require_once('home.php');
include "connection.php";

// function
include 'function/deduction.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
  <title>Cash Advance</title>
</head>

<body>

  <div class="container-fluid">

    <div class="row my-5 mx-3">

      <h3 class="text-center">Cash Advance</h3>

      <div class="border-bottom my-3 hide"></div>
      <div class="dropdown my-3">

        <button type="button" class="btn btn-outline-primary" data-bs-target="#deductionModal" data-bs-toggle="modal">Add</button>

        <?php include 'modals/add-deduction.php' ?>

        <div style="padding-top: 10px;" class="dropdown-menu">

        </div>
        <div class="border-bottom my-3 hide"></div>

        <div class="overflow-auto">
          <table class="table table-hover ">
            <thead>
              <tr>

                <th>EmpID</th>
                <th>Name</th>
                <th>Cash Advance</th>
                <th>CA Deduction</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $cash_advance = mysqli_query($GLOBALS['con'], 'Select * From cash_advance');
              while ($rows = mysqli_fetch_assoc($cash_advance)) {
                $id = $rows['emp_id'];

              ?>
                <tr>
                  <td><?= $id ?></td>
                  <td><?= $rows['name'] ?></td>
                  <td><?= $rows['total_cash_advance'] ?></td>
                  <td><?= $rows['ca_deduction'] ?></td>
                  <td><?= $rows['date'] ?></td>
                  <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#caDeduction<?= $id ?>">Deduction</button></td>
                </tr>

              <?php
                include 'modals/add-deduction.php';
              } ?>
            </tbody>
          </table>
        </div>

        <br>
        <br>
        <br>
      </div>

    </div>

    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.table').DataTable();
      });
    </script>
  </div>
</body>

</html>
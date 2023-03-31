<?php

require_once('home.php');
include "connection.php";
$conn = mysqli_connect('localhost', 'root', '', 'eirish_payroll');

$sql = "SELECT * FROM employee WHERE isdeploy='1'";
$result = $conn->query($sql);


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datatable</title>
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
    .modal {
        display: none;
        /* Hide the modal by default */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black with opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
        border-radius: 10px;
        /* Add curved corners */
    }

    body.modal-open {
        overflow: hidden;
        /* Remove second scroll */
    }

    #open-modalkk {
        float: right;
    }
    </style>

</head>

<body>
    <div class="container" style="margin-top:50px;">
        <center>
            <h3>Field Employee</h3>
        </center>
        <div class="border-bottom my-3"></div>
        <button id="open-modal" class="btn btn-outline-primary">Add Deploy</button>


        <button type="button" class="btn btn-outline-success" onclick="location.href='export.php'">Export to CSV</button>
        <div class="border-bottom my-3"></div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['emp_id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['position'] ?></td>
                    <td>
                        <a href="deployremove.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-danger">Remove</a>

                    </td>
                </tr>


                <?php   } ?>

                </thead>

        </table>
        <div class="modal fade" id="viewmodal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Employee Informations</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-view">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require_once('addemployee.php'); ?>

    </div>
    <br>
    <br>
    <br>
    <br>
    <?php require_once('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
    </script>
    <script type='text/javascript'>
    $(document).ready(function() {
        $('.userinfo').click(function() {
            var userid = $(this).data('id');
            $.ajax({
                url: 'views.php',
                type: 'post',
                data: {
                    userid: userid
                },
                success: function(response) {
                    $('.modal-view').html(response);
                    $('#viewmodal').modal('show');
                }
            });
        });
    });
    </script>
</body>

</html>

<?php

// Select data from the database
$sql = "SELECT * FROM employee WHERE isdeploy != '1'";
$result = mysqli_query($conn, $sql);

// Count the number of rows
$count = mysqli_num_rows($result);

?>

<form method="post" id="frm">
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <?php $count = mysqli_num_rows($result); ?>
            <p class="lead">Total Employees: <?php echo $count; ?></p>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th width="15%"><input type="checkbox" onclick="select_all()" id="delete" /></th>
                            <th>EMP ID</th>
                            <th>Name</th>
                            <th>Job</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr id="box<?php echo $row['id'] ?>">
                            <td><input type="checkbox" id="<?php echo $row['id'] ?>" name="checkbox[]"
                                    value="<?php echo $row['id'] ?>" /></td>
                            <td><?php echo $row['emp_id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['position'] ?></td>

                        </tr>


                        <?php } ?>

                    </tbody>
                </table>
                <button id="open-modalkk" class="btn btn-primary" onclick="deploy_all()">Deploy</button>


            </div>
        </div>
    </div>
</form>

<!-- Add JavaScript to open and close the modal -->
<script>
var modal = document.getElementById("modal");
var btn = document.getElementById("open-modal");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
    document.body.style.overflow = "hidden";
}

span.onclick = function() {
    modal.style.display = "none";
    document.body.style.overflow = "auto";
}

function count_selected() {
    var checkboxes = jQuery('input[type=checkbox]');
    var checked_checkboxes = checkboxes.filter(':checked');
    return checked_checkboxes.length;
}

function select_all() {
    if (jQuery('#delete').prop("checked")) {
        jQuery('input[type=checkbox]').each(function() {
            jQuery(this).prop('checked', true);
        });
    } else {
        jQuery('input[type=checkbox]').each(function() {
            jQuery(this).prop('checked', false);
        });
    }
}

function deploy_all() {
    var checkboxes = jQuery('input[type=checkbox]');
    var checked_checkboxes = checkboxes.filter(':checked');
    var count = count_selected();

    if (count === 0) {
        alert('Please select at least one item to deploy.');
        return;
    }

    var check = confirm("Are you sure you want to Deploy " + count + " items?");
    if (check) {
        jQuery.ajax({
            url: 'deployemployee.php',
            type: 'post',
            data: jQuery('#frm').serialize(),
            success: function(result) {
                checked_checkboxes.each(function() {
                    jQuery('#box' + this.id).remove();
                });
            }
        });
    }
}

jQuery('#delete').on('change', function() {
    select_all();
});

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
}

// Get the "select-all" checkbox
const selectAllCheckbox = document.getElementById('select-all');

// Get all checkboxes in the table body
const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');

// Add an event listener to the "select-all" checkbox
selectAllCheckbox.addEventListener('change', (event) => {
    // If the "select-all" checkbox is checked, check all checkboxes in the table body
    if (event.target.checked) {
        checkboxes.forEach((checkbox) => {
            checkbox.checked = true;
        });
    } else { // Otherwise, uncheck all checkboxes in the table body
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        });
    }
});
</script>

<?php
// Close the database connection
mysqli_close($conn);
?>
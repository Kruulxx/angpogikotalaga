<?php

 require_once('home.php');  
 include "connection.php";
 $con=mysqli_connect('localhost','root','','eirish_payroll');
 $sql = "SELECT * FROM employee WHERE isarchive='0'";
 $result = $con->query($sql);

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
  .btn {
  font-size: 18px;
  padding: 12px 24px;
  border-radius: 4px;
  border-width: 2px;
  border-style: solid;
  text-transform: uppercase;
  transition: all 0.3s ease;

}

.btn-outline-danger {
  color: #dc3545;
  background-color: transparent;
  border-color: #dc3545;
}

.btn-outline-danger:hover {
  color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
}

</style>
</head>
<body>
 <div class="container" style="margin-top:50px;">    
 <center><h3>Master Lists</h3></center>
             <div class="border-bottom my-3"></div>
             
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Add Employee
                </button>
                <button class="btn btn-outline-danger" onclick="delete_all()">Archive</button>
                <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="importmasterlist.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />

            <input type="submit" class="btn btn-outline-primary" name="importSubmit" value="IMPORT">
            
        </form>
    </div>
    <form method="post" id="frm">
                <div class="border-bottom my-3"></div>
          <table class="table table-hover ">
                  <thead>
                      <tr>
                      <th width="20%"><input type="checkbox" onclick="select_all()"  id="delete"/>Checkbox</th>
                        <th>EmpID</th>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Rate per hour</th>
                        <th>Action</th>

                      </tr>

                </thead>
                    <tbody>
                    <?php while($row=mysqli_fetch_assoc($result)){?>
                      <tr id="box<?php echo $row['id']?>">
                     
                      <td><input type="checkbox" id="<?php echo $row['id']?>" name="checkbox[]" value="<?php echo $row['id']?>"/></td>
                          <td><?php echo $row['emp_id']?></td>
                          <td><?php echo $row['name']?></td>
                          <td><?php echo $row['position']?></td>
                          <td><?php echo $row['rate']?></td>
                          <td  >
                          <a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-primary">Edit</a>
                          <button data-id='<?php echo $row['id']; ?>' class="userinfo btn btn-outline-primary">View</button>
                   
      
                          </td>
                      </tr>
                          

                          <?php } ?>
                    
                </thead>
            
                <?php require_once('addemployee.php'); ?>
              </table>
    </form>
              
  <script>
function count_selected() {
  var checkboxes = jQuery('input[type=checkbox]');
  var checked_checkboxes = checkboxes.filter(':checked');
  return checked_checkboxes.length;
}

function select_all(){
  if(jQuery('#delete').prop("checked")){
    jQuery('input[type=checkbox]').each(function(){
      jQuery(this).prop('checked',true);
    });
  }else{
    jQuery('input[type=checkbox]').each(function(){
      jQuery(this).prop('checked',false);
    });
  }
}

function delete_all() {
  var checkboxes = jQuery('input[type=checkbox]');
  var checked_checkboxes = checkboxes.filter(':checked');
  var count = count_selected();

  if (count === 0) { 
    alert('Please select at least one item to delete.');
    return;
  }

  var check = confirm("Are you sure you want to Archive " + count + " items?");
  if (check) {
    jQuery.ajax({
      url: 'employeearchive.php',
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

// Add event listener to the "select all" checkbox
jQuery('#delete').on('change', function() {
  select_all();
});

</script>

<div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Informations</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-view">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        
              
   </div>
   <br>
   <br>
   <?php require_once('scripts.php'); ?>
   <?php require_once('footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
  <script type='text/javascript'>
            $(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');
                    $.ajax({
                        url: 'views.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-view').html(response); 
                            $('#viewmodal').modal('show'); 
                        }
                    });
                });
            });
            </script>
</body>
</html>
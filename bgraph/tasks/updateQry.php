
<?php

if (isset($_POST['task_name'])){
    $taskname = stripslashes($_POST['task_name']);
    $taskname = mysqli_real_escape_string($con,$taskname);
    $taskdesc = stripslashes($_POST['task_desc']);
    $taskdesc = mysqli_real_escape_string($con,$taskdesc);
    
    $start_date = stripslashes($_POST['starts_at']);
    $start_date = mysqli_real_escape_string($con,$start_date);
    $end_date = stripslashes($_POST['ends_at']);
    $end_date = mysqli_real_escape_string($con,$end_date);
    
    /*
    $username = stripslashes($_POST['2']);
    $username = mysqli_real_escape_string($con,$username);
    $email = stripslashes($_POST['3']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_POST['6']);
    $password = mysqli_real_escape_string($con,$password);
    $user_role = stripslashes($_POST['7']);
    $user_role = (int)mysqli_real_escape_string ($con,$user_role);
    $user_org = stripslashes($_POST['8']);
    $user_org = (int)mysqli_real_escape_string($con,$user_org);
    
    $project_id = stripslashes($_POST['9']);
    $project_id = (int)mysqli_real_escape_string($con,$project_id);*/
    
    
    
    $date = date("Y-m-d H:i:s");
    
    $id = stripslashes($_POST['id']);
    $id = mysqli_real_escape_string($con,$id);
    
    echo $id;
    $sql  = "UPDATE `tasks` SET `name`='$taskname', `assigned_to`='badmin', `created_by`='10006', `create_date`='$date' WHERE `id`='$id'"; 
   // `reassigned_to`, `status`, `check_list_id`, `projects_id`, `users_id`, `stations_id`,`start_date`,`end_date`)  
   
    
    //$result = mysqli_query($con,$query);
    if($con->query($sql) === TRUE) {
        echo "Task updated successfully";
    } else {
        echo "Error updating task: " . $con->error;
    }
}
?>


<?php include '../doc/header.php'; ?>


<form class="form w-50" role="form" action="" method="post"
	id="updateTaskForm">
	<div class="form-group ">
		<label for="task_name">Task Name</label> <input type="text"
			class="form-control" id="task_name" placeholder="Task name">
	</div>
	<div class="form-group ">
		<label for="task_desc">Task Desc</label>
		<textarea class="form-control" id="task_desc"
			placeholder="Task description"></textarea>
	</div>
	<div class="row">
		<div class="col-sm-6 mb-lg-2">
			<div class="form-group">
				<label for="starts_at">Starts at</label> <input type="text"
					class="form-control" id="starts_at" placeholder="Starts at">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="ends_at">Ends at</label> <input type="text"
					class="form-control" id="ends_at" placeholder="Ends at">
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="station_id">Station id</label> <input type="text"
					class="form-control" id="station_id" placeholder="Station">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="project_id">Project</label> <input type="text"
					class="form-control" id="project_id" placeholder="Project">
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="assigned_to">Assigned to</label> <input type="text"
					class="form-control" id="assigned_to" placeholder="Assigned to">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="reassigned_to">Reassigned toc</label> <input type="text"
					class="form-control" id="reassigned_to" placeholder="Ends at">
			</div>
		</div>
	</div>


	<div class="form-group">
		<div class="col-md-8">
			<button id="submit" name="submit" class="btn btn-primary">Save</button>
			<a href="./task_list" id="cancel" class="btn btn-default">Cancel</a>
		</div>
	</div>


</form>



<?php include '../doc/footer.php'; ?>

<script>

$("#starts_at,#ends_at").flatpickr({
	enableTime: true,	
});


$(function () {

    $('#updateTaskForm').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: './updateQry',
        data: $('form#updateTaskForm').serialize(),
        success: function (res) {
            console.log(res);
         window.location.href = "./task_list";
        }
      });

    });

  });


</script>
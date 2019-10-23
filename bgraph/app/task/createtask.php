<?php 
include '../doc/header.php';
?>

  <form role="form" method="post" id="task_createform">        
        <div class="form-group">
            <label for="taskname">
                Task Name:</label>
            <input type="text" class="form-control"
            id="taskname" name="taskname"   required maxlength="50">

        </div>
        <div class="form-group">
            <label for="task_desc">
                Task Description:</label>
            <input type="text" class="form-control"
            id="task_desc" name="task_desc" required maxlength="50">
        </div>
        <div class="form-group">
            <label for="scheduled_date">
                Scheduled Date:</label>
            <input class="form-control" type="date" name="scheduled_date" id="scheduled_date" 
            maxlength="6000" rows="7"></textarea>
        </div>
         <div class="form-group">
            <label for="location">
                Location:</label>  
  <select class="form-control" id="location">
    <option selected>Choose...</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
        </div>

        
  <input type="submit" name="submitRegister" value="Submit" class="btn btn-success mr-2">                     
                      <input type="button" class="btn btn-outline-dark" VALUE="Cancel"
        onclick="window.location.href='../doc/dashboard'"> 
                    </form>
    </form>
<?php 
include '../doc/footer.php';
?>


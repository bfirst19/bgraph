  <form role="form" method="post" id="task_createform">        
        <div class="form-group">
            <label for="taskname">
                UserName:</label>
            <input type="text" class="form-control"
            id="username" name="username"   required maxlength="50">

        </div>
        <div class="form-group">
            <label for="task_desc">
                First Name:</label>
            <input type="text" class="form-control"
            id="task_desc" name="task_desc" required maxlength="50">
			<label for="task_desc">
                Last NAme:</label>
            <input type="text" class="form-control"
            id="task_desc" name="task_desc" required maxlength="50">
        </div>
        <div class="form-group">
            <label for="scheduled_date">
                Work location:</label>
             <select class="form-control" id="location">
    <option selected>Choose...</option>
    <option value="1">Lakeside</option>
    <option value="2">Tampines</option>
    <option value="3">Bukit Batok</option>
	<option value="3">Chinese Garden</option>
  </select>
        </div>
         <div class="form-group">
            <label for="location">
                Organization Name:</label>  
  <select class="form-control" id="location">
    <option selected>Choose...</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
        </div>

    </form>
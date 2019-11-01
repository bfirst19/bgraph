<?php include '../doc/header.php'; ?>


<style>
  div.dt-buttons {
   float: left;
   margin-left:10px;
}
</style>
 <div><h6 align="center">Users List</h6></div>
 <table id="users_table_id" class="table table-striped table-bordered" style="width:100%" >
    <thead align="left">
        <tr>
            <!--th>User ID</th-->
            <th></th>
            <th>User id</th>
            <th>User Name</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Organization</th>
            <th>Create Date</th>
        </tr>
    </thead>
    <tbody>
    			
       
    </tbody>
</table>

<?php include '../doc/footer.php'; ?>

<!-- New User Modal-->
  <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newUserModalLabel">Create new user</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">       
        <form class="forms-sample" action="" method="post" id="userCreateForm">
        			<div class="form-group">
                        <label for="first_name">First Name</label>                        
						<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required />
                      </div>
                      <div class="form-group">
                        <label for="last_name">Last Name</label>                        
						<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required />
                      </div>
                      <div class="form-group">
                        <label for="username">User Name</label>                        
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>                        
						 <input type="text" class="form-control" id="email" name="email" placeholder="Email Adress">
						 
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>                        
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      </div>
                                          
                       <div class="form-group">
                        <label for="user_org">
                            Organization:</label>  
                              <select class="form-control" id="user_org" name="user_org">
                              <option value="notset" selected="selected">NotSet</option>
                              <?php 
                                require('../config/db.php');
                                $query2  = "select * from organizations";
                                $result2 = mysqli_query($con,$query2) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result2)) {
                              ?>
                                
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                
                                <?php }?>
                              </select>
        			</div> 
        			
                      <div class="form-group">
                        <label for="user_role">
                            Role:</label>  
                              <select class="form-control" id="user_role" name="user_role">
                                <option value="notset" selected="selected">NotSet</option>
                                <?php 
                                require('../config/db.php');
                                $query3  = "select * from roles";
                                $result3 = mysqli_query($con,$query3) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result3)) {
                              ?>
                                
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                
                                <?php }?>
                              </select>
        			</div>                   
                                           
					  <input type="submit" name="submitRegister" value="Register" class="btn btn-success mr-2">                     
                    	<input class="btn btn-outline-dark" type="button" data-dismiss="modal" aria-label="Cancel" value="Cancel">
                    </form>
        
        </div>
        <div class="modal-footer">
          <!-- button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>   
          <button class="btn btn-primary" type="submit" data-dismiss="modal">Save</button-->         
        </div>
      </div>
    </div>
 
</div>


<!-- New User Modal-->
  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit user</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">       
        <form class="forms-sample" action="" method="post" id="userEditForm">
        			<div class="form-group">
                        <label for="euser_id">User id</label>                        
						 <input type="text" class="form-control" id="euser_id" name="euser_id" placeholder="" readonly="readonly">						 
                      </div>
                      
        			<div class="form-group">
                        <label for="efirst_name">First Name</label>                        
						<input type="text" class="form-control" id="efirst_name" name="efirst_name" placeholder="First name" required />
                      </div>
                      <div class="form-group">
                        <label for="elast_name">Last Name</label>                        
						<input type="text" class="form-control" id="elast_name" name="elast_name" placeholder="Last name" required />
                      </div>
                      <div class="form-group">
                        <label for="eusername">User Name</label>                        
						<input type="text" class="form-control" id="eusername" name="eusername" placeholder="Username" required />
                      </div>
                      <div class="form-group">
                        <label for="eemail">Email address</label>                        
						 <input type="text" class="form-control" id="eemail" name="eemail" placeholder="Email Adress">
						 
                      </div>
                      <div class="form-group">
                        <label for="epassword">Password</label>                        
						<input type="password" class="form-control" name="epassword" id="epassword" placeholder="Password" required>
                      </div>
                    
                      <div class="form-group">
                        <label for="euser_org">
                            Organization:</label>  
                              <select class="form-control" id="euser_org" name="euser_org">
                              
                              <?php 
                                require('../config/db.php');
                                $query2  = "select * from organizations";
                                $result2 = mysqli_query($con,$query2) or die(mysqli_error($con));
                                while ($row2 = mysqli_fetch_array($result2)) {
                              ?>
                                
                                <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></option>
                                
                                <?php }?>
                              </select>
        			</div>
                      
                      <div class="form-group">
                        <label for="euser_role">
                            Role:</label>  
                              <select class="form-control" id="euser_role" name="euser_role">
                                
                                <?php 
                                require('../config/db.php');
                                $query3  = "select * from roles";
                                $result3 = mysqli_query($con,$query3) or die(mysqli_error($con));
                                while ($row3 = mysqli_fetch_array($result3)) {
                              ?>
                                
                                <option value="<?php echo $row3['id']; ?>"><?php echo $row3['name']; ?></option>
                                
                                <?php }?>
                              </select>
        			</div>        
        			                                           
					  <input type="submit" name="submitUpdate" value="Update" class="btn btn-success mr-2">                     
                    <input class="btn btn-outline-dark" type="button" data-dismiss="modal" aria-label="Cancel" value="Cancel">
                    </form>
        
        </div>
        <div class="modal-footer">
          <!-- button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>   
          <button class="btn btn-primary" type="submit" data-dismiss="modal">Save</button-->         
        </div>
      </div>
    </div>
 
</div>

<script type="text/javascript">

$(document).ready( function() {
	// after table aply filter
 	//$('#users_table_id').excelTableFilter();
 	
	 var table = $('#users_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": false,
          "processing": true,
          "serverSide": false,
          "ajax": {
              url: "./query_users", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'post',  // method  , by default get
          },
          columnDefs: [ {
              orderable: true,
              className: 'select-checkbox',
              targets:   0
          } ],
          select: {
              style:    'os',
              selector: 'td:first-child'
          },
          order: [[ 1, 'asc' ]],
		  buttons: {
			    buttons: [
			      {
			        text: "<i class='fas fa-user'>New</i>",
			        className:"btn btn-primary btn-xs dt-add",
			        action: function(e, dt, node, config) {
			        	$('#newUserModal').modal('show');			        				        	 
			        }
			      },
			      {
				        text: "<i class='fas fa-user-edit'>Edit</i>",
				        className:"btn btn-primary btn-xs dt-edit",
				        action: function(e, dt, node, config) {
				        	var data=table.rows( { selected: true }).data();
				        	 $(".modal-body #euser_id").val( data[0][1] );
				        	 $(".modal-body #eusername").val( data[0][2] );
				        	 $(".modal-body #eemail").val( data[0][3] );
				        	 $(".modal-body #efirst_name").val( data[0][4] );
				        	 $(".modal-body #elast_name").val( data[0][5] );

					        	 $.each($('.modal-body #euser_role').prop('options'), function () {					        		
					        		 if($(this).text() == data[0][6]){
				        		    	 $(".modal-body #euser_role").val( $(this).val());
				        		    }					        		      
					        	});					        	
				        	 //$(".modal-body #euser_role").val( 'Operator').change();
				        	 //$(".modal-body #euser_org ").val( data[0][6] );
				        	 $.each($('.modal-body #euser_org').prop('options'), function () {
				        		    if($(this).text() == data[0][7]){
				        		    	 $(".modal-body #euser_org").val( $(this).val());
				        		    }
				        		});
				        	 				        	 
				        	$('#editUserModal').modal('show');
				        }
				  },
			      {
				        text: "<i class='fas fa-user-times'>Delete</i>",
				        className:"btn btn-primary btn-xs dt-delete",
				        action: function(e, dt, node, config) {
				        	   						
				        	var data=table.rows( { selected: true }).data();				        	
				        	var username = data[0][2];
				        	if(username !=='badmin'){
				        	swal({
				        		  title: "Are you sure?",
				        		  text: "You can't retrieve user data once deleted!",
				        		  icon: "warning",
				        		  buttons: true,
				        		  dangerMode: true,
				        		})
				        		.then((willDelete) => {
				        		  if (willDelete) {
				        			   $.ajax({
						                 type:'POST',
						                 url:'./deleteUser',
						                 data:{'del_id':data[0][1]},
						                 success: function(res){					                 
							                 
							                	 var table = $('#users_table_id').DataTable();				
							     					table.ajax.reload();		
							     								     					
							     					if(res.indexOf('deleted') >-1){
							     						swal({
								     						  title: "Success",
								     						  text: res,
								     						  icon: "success",
								     						});
							     					}else
							     					{
							     						swal({
								     						  title: "Failed",
								     						  text: res,
								     						  icon: "error",
								     						});
							     					}
						                  }

						                 });
				        		  } else {
				        		    swal("User not deleted!");
				        		  }
				        		});
			        		
				        	
				        	}
				        }
				  }//,"copy","pdf","excel","print"
			    ],
			    dom: {
			      button: {
			        tag: "button",
			        className: "btn btn-primary"
			      },
			      buttonLiner: {
			        tag: null
			      }
			    }
			  }
		    
		});


	

		
	} );

$("#userCreateForm").submit(function(e){
	  e.preventDefault();
	console.log($('form#userCreateForm').serialize());		 
	 $.ajax({
			type: "POST",
			url: "./createUser",				
			data: $('form#userCreateForm').serialize(),
			success: function(res){
				$('#newUserModal').modal('hide');
				$("form#userCreateForm").trigger("reset");
				var table = $('#users_table_id').DataTable();				
				table.ajax.reload();
				if(res.indexOf('created') >-1){
					swal({
						  title: "Success",
						  text: res,
						  icon: "success",
						});
				}else
				{
					swal({
						  title: "Failed",
						  text: res,
						  icon: "error",
						});
				}			
               
			},
			error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});
		return false;
	});

$("#userEditForm").submit(function(e){
	  e.preventDefault();
	console.log($('form#userEditForm').serialize());		 
	 $.ajax({
			type: "POST",
			url: "./editUser",				
			data: $('form#userEditForm').serialize(),
			success: function(res){				
				$('#editUserModal').modal('hide');
				var table = $('#users_table_id').DataTable();				
				table.ajax.reload();
				$("form#userEditForm").trigger("reset");
				if(res.indexOf('updated') >-1){
					swal({
						  title: "Success",
						  text: res,
						  icon: "success",
						});
				}else
				{
					swal({
						  title: "Failed",
						  text: res,
						  icon: "error",
						});
				}		
			},
			error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});
		return false;
	});

</script>
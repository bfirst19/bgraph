<?php include '../doc/header.php'; ?>


<style>
  div.dt-buttons {
   float: left;
   margin-left:10px;
}
</style>
        
<table id="users_table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <!--th>User ID</th-->
            <th></th>
            <th>User Name</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User Role</th>
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
                        <label>File upload</label>
                        <!--input type="file" name="img[]" class="file-upload-default"-->
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" id="profieplaceholder">
                          <span class="input-group-append">
                            <input type="file" id="selectedProfilePic" class="file-upload-browse btn btn-info" placeholder="Upload Image" style="display:none;" oninput="document.getElementById('profieplaceholder').placeholder=document.getElementById('selectedProfilePic').files.item(0).name;" >
                           <button class="file-upload-browse btn btn-info" type="button"  onclick="document.getElementById('selectedProfilePic').click();">Upload</button>
                             
                          </span>
                        </div>
                      </div>   
                      <div class="form-group">
                        <label for="location">
                            User Group:</label>  
                              <select class="form-control" id="role">
                                <option value="notset" selected="selected">NotSet</option>
                                <option value="siteadmin">Site Admin</option>
                                <option value="orgadmin">Organization Admin</option>
                                <option value="manager">Manager</option>
                                 <option value="user">User</option>
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
<script type="text/javascript">

$(document).ready( function() {
	 var table = $('#users_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": false,
          "processing": true,
          "serverSide": false,
          "ajax": {
              url: "./queryusers", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'post',  // method  , by default get
          },
          columnDefs: [ {
              orderable: false,
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
			        text: "Create new user",
			        className:"btn btn-primary btn-xs dt-add",
			        action: function(e, dt, node, config) {
			        	$('#newUserModal').modal('show');
			        }
			      },
			      {
				        text: "Edit user",
				        className:"btn btn-primary btn-xs dt-edit",
				        action: function(e, dt, node, config) {
				        	var data=table.rows( { selected: true }).data();
				        	alert('selected row:'+data[0][1]);
				        }
				  },
			      {
				        text: "Delete user",
				        className:"btn btn-primary btn-xs dt-delete",
				        action: function(e, dt, node, config) {
				          //trigger the bootstrap modal
				        }
				  },"copy","pdf","excel","print"
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
			success: function(response){				
				$('#newUserModal').modal('hide');
				var table = $('#users_table_id').DataTable();				
				table.ajax.reload();
				$("form#userCreateForm").trigger("reset");
				$(".title").html("");
                $(".message").html(response.message)
                .hide().fadeIn(1000, function() {
                    $(".message").append("");
                    }).delay(1000).fadeOut("fast");
			},
			error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});
		return false;
	});

</script>
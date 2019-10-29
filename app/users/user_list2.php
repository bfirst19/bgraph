<?php include '../doc/header.php'; ?>


<style>
  div.dt-buttons {
   float: left;
   margin-left:10px;
}
</style>

<?php            
require('../config/db.php');
//session_start();
$query  = "select * from users";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
        ?>
        
<table id="users_table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <!--th>User ID</th-->
            <!--  th></th-->
            <th>User Name</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User Role</th>
            <th>Create Date</th>
        </tr>
    </thead>
    <tbody>
    			
       <?php 
       while ($row = mysqli_fetch_array($result)) {
                   echo "<tr>";
                   //echo "<td>".$row[user_id]."</td>";
                   //echo "<td></td>";
                   echo "<td>".$row[username]."</td>";
                   echo "<td>".$row[email]."</td>";
                   echo "<td>".$row[first_name]."</td>";
                   echo "<td>".$row[last_name]."</td>";
                   
                   /*
                   if ($row[user_role]=="siteadmin") {
                       echo "<td>Site Admin</td>";
                   }elseif ($row[user_role]=="orgadmin") {
                       echo "<td>Organization Admin</td>";
                   }elseif ($row[user_role]=="manager") {
                       echo "<td>Manager</td>";
                   }elseif ($row[user_role]=="user") {
                       echo "<td>Maintenance User</td>";
                   }else {
                       echo "<td>Role Notset</td>";
                   }*/
                   
                   echo "<td>".$row[user_role]."</td>";
                   echo "<td>".$row[create_date]."</td>";
                   echo "</tr>";
               }

            ?>
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
                      <input type="button" class="btn btn-outline-dark" VALUE="Cancel"    onclick="window.location.href='../doc/dashboard'"> 
                    	
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
		  "dom": '<"dt-buttons"fr><"clear">lBtip',
		  select: {
              style: 'single'
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

	//Add row button
		/*$('.dt-add').each(function () {
			$(this).on('click', function(evt){
				alert('adding data');
			});
		});
		//Edit row buttons
		$('.dt-edit').each(function () {
			var table =  $('#users_table_id');
			$(this).on('click', function(evt){
				//var data=table.rows( { selected: true }).data();
				//$('#myModal').modal('show');
				//alert(table);
			});
		});
		//Delete buttons
		$('.dt-delete').each(function () {
			$(this).on('click', function(evt){
				$this = $(this);
				var dtRow = $this.parents('tr');
				if(confirm("Are you sure to delete this row?")){
					var table = $('#example').DataTable();
					table.row(dtRow[0].rowIndex-1).remove().draw( false );
				}
			});
		});*/
		/*$('#myModal').on('hidden.bs.modal', function (evt) {
			$('.modal .modal-body').empty();
		});*/
	  /*var table = $('#users_table_id').DataTable();
	  
	  new $.fn.dataTable.Buttons( table, {
		    buttons: [
		        'copy', 'excel', 'pdf'
		    ]
		} );
		 
		/*table.buttons().container()
		    .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );*/
		
	} );

$("#userCreateForm").submit(function(e){
	  e.preventDefault();
	console.log($('form#userCreateForm').serialize());		 
	 $.ajax({
			type: "POST",
			url: "./createUser",				
			data: $('form#userCreateForm').serialize(),
			success: function(response){
				console.log('hello......'+response);
				$('#newUserModal').modal('hide');
				$('#users_table_id').bootstrapTable('refresh');
			},
			error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});
		return false;
	});

</script>
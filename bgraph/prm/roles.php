<?php include '../doc/header.php'; ?>


<style>
  div.dt-buttons {
   float: left;
   margin-left:10px;
}
</style>
 <div><h6 align="center">Roles List</h6></div>       
<table id="roles_table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <!--th>User ID</th-->
            <th></th>
            <th>Role id</th>
            <th>Role Name</th>
            <th>Created On</th>  
            <th>Created By</th>            
        </tr>
    </thead>
    <tbody>
    			
       
    </tbody>
</table>
<?php include '../doc/footer.php'; ?>



<!-- New Role Modal-->
  <div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newRoleModalLabel">Create new role</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">       
        <form class="forms-sample" action="" method="post" id="roleCreateForm">
        			<div class="form-group">
                        <label for="role_name">Name</label>                        
						<input type="text" class="form-control" id="role_name" name="role_name" placeholder="Role name" required />
                      </div>
                       
                      <div class="form-group">
                        <label for="created_by">Created by</label>                        
						<input type="text" class="form-control" id="created_by" readonly="readonly" name="created_by" placeholder="Created By"  value="<?php echo $_SESSION['username']; ?>" />
                      </div>
                                                        
					  <input type="submit" name="saveRole" value="Save" class="btn btn-success mr-2">                     
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
	 var table = $('#roles_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": false,
          "processing": true,
          "serverSide": false,
          "ajax": {
              url: "./queryRoles", // json datasource
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
			        text: "<i class='fas fa-user-tag'>New</i>",
			        className:"btn btn-primary btn-xs dt-add",
			        action: function(e, dt, node, config) {
			        	$('#newRoleModal').modal('show');			        				        	 
			        }
			      },
			      {
				        text: "<i class='fas fa-minus-circle'>Delete</i>",
				        className:"btn btn-primary btn-xs dt-edit",
				        action: function(e, dt, node, config) {
				        	var data=table.rows( { selected: true }).data();				        	
				        	var id = data[0][1];
				        	 $.ajax({
				                 type:'POST',
				                 url:'./deleteRole',
				                 data:{'del_id':id},
				                 success: function(res){
					                	 var table = $('#roles_table_id').DataTable();				
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
				        }
				  }			      
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


$("#roleCreateForm").submit(function(e){
	  e.preventDefault();
	console.log($('form#roleCreateForm').serialize());		 
	 $.ajax({
			type: "POST",
			url: "./createRole",				
			data: $('form#roleCreateForm').serialize(),
			success: function(response){
				$('#newRoleModal').modal('hide');
				$("form#roleCreateForm").trigger("reset");
				var table = $('#roles_table_id').DataTable();				
				table.ajax.reload();
				swal({
					  title: "Success",
					  text: "Role created successfully!",
					  icon: "success",
					});				
             
			},
			error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});
		return false;
	});
</script>
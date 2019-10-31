<?php include '../doc/header.php'; ?>


<style>
  div.dt-buttons {
   float: left;
   margin-left:10px;
}
</style>
        
<table id="orgs_table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <!--th>User ID</th-->
            <th></th>
            <th>Org id</th>
            <th>Org Name</th>
            <th>Created On</th>  
            <th>Created By</th>           
        </tr>
    </thead>
    <tbody>
    			
       
    </tbody>
</table>
<?php include '../doc/footer.php'; ?>



<!-- New Role Modal-->
  <div class="modal fade" id="newOrgModal" tabindex="-1" role="dialog" aria-labelledby="newOrgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newOrgModalLabel">Create new organization</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">       
        <form class="forms-sample" action="" method="post" id="orgCreateForm">
        			<div class="form-group">
                        <label for="org_name">Name</label>                        
						<input type="text" class="form-control" id="org_name" name="org_name" placeholder="Organization name" required />
                      </div>
                      
                      <div class="form-group">
                        <label for="created_by">Created by</label>                        
						<input type="text" class="form-control" id="created_by"  readonly="readonly" name="created_by" placeholder="Created By"  value="<?php echo $_SESSION['username']; ?>"/>
                      </div>
                                                         
					  <input type="submit" name="saveOrg" value="Save" class="btn btn-success mr-2">                     
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
	 var table = $('#orgs_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": false,
          "processing": true,
          "serverSide": false,
          "ajax": {
              url: "./queryOrgs", // json datasource
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
			        text: "Create new Organization",
			        className:"btn btn-primary btn-xs dt-add",
			        action: function(e, dt, node, config) {
			        	$('#newOrgModal').modal('show');			        				        	 
			        }
			      },
			      {
				        text: "Delete Organization",
				        className:"btn btn-primary btn-xs dt-edit",
				        action: function(e, dt, node, config) {
				        	var data=table.rows( { selected: true }).data();				        	
				        	var id = data[0][1];
				        	 $.ajax({
				                 type:'POST',
				                 url:'./deleteOrg',
				                 data:{'del_id':id},
				                 success: function(res){					                 
					                
					                	 var table = $('#orgs_table_id').DataTable();				
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


$("#orgCreateForm").submit(function(e){
	  e.preventDefault();
	console.log($('form#orgCreateForm').serialize());		 
	 $.ajax({
			type: "POST",
			url: "./createOrg",				
			data: $('form#orgCreateForm').serialize(),
			success: function(response){
				$('#newOrgModal').modal('hide');
				$("form#orgCreateForm").trigger("reset");
				var table = $('#orgs_table_id').DataTable();				
				table.ajax.reload();
				swal({
					  title: "Success",
					  text: "Organization created successfully!",
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
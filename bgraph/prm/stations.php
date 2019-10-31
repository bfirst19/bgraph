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
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Station Type</th>
            <th>Created On</th>  
            <th>Created By</th>           
        </tr>
    </thead>
    <tbody>
    			
       
    </tbody>
</table>
<?php include '../doc/footer.php'; ?>

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

</script>
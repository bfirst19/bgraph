<?php include '../doc/header.php'; ?>


<style>
  div.dt-buttons {
   float: left;
   margin-left:10px;
}
</style>
        
<table id="projects_table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <!--th>User ID</th-->
            <th></th>
            <th>Id</th>
            <th>Number</th>
            <th>Name</th>
            <th>Description</th>
            <th>Start date</th>  
            <th>End date</th> 
            <th>Manager</th> 
            <th>Customer name</th>           
        </tr>
    </thead>
    <tbody>
    			
       
    </tbody>
</table>
<?php include '../doc/footer.php'; ?>

<script type="text/javascript">
$(document).ready( function() {
	 var table = $('#projects_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": false,
          "processing": true,
          "serverSide": false,
          "ajax": {
              url: "./queryProjects", // json datasource
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
				        	var orgname = data[0][1];
				        	 $.ajax({
				                 type:'POST',
				                 url:'./deleteOrg',
				                 data:{'del_id':orgname},
				                 success: function(res){					                 
					                 if(res == 0){
					                	 var table = $('#orgs_table_id').DataTable();				
					     					table.ajax.reload();
					     					swal({
					     						  title: "Success",
					     						  text: "Organization deleted successfully!",
					     						  icon: "success",
					     						});	
				     											                	 
					                      }else{
					                	 	alert('Invalid ID.');
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
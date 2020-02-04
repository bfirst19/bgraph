

<?php include '../doc/header.php'; ?>

<div style="background-color: rgba(0,0,255,.1)" ><h6 align="left">Roles List</h6></div>       
<table id="roles_table_id" class="table table-striped table-bordered" style="width:100%">    
</table>





<?php include '../doc/footer.php'; ?>


<script type="text/javascript">

var columnDefs = [{
    title: "",
    id:"",
    type:"hidden"
  }, {
    title: "Id",
    name:"id",
    type: "readonly"    
  }, {
    title: "Role Name",
    name:"role_name"
  }, {
    title: "Created On",
    name:"created_on",
    type: "readonly"
  }, {
    title: "Created By",
    name:"created_by" ,
    type: "readonly"   
  }];


$(document).ready( function() {
	 var table = $('#roles_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": true,
          "processing": true,
          "serverSide": false,
          altEditor: true,
          "ajax": {
              url: "./queryRoles", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'post',  // method  , by default get
          },
          columns: columnDefs,
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
          buttons: [{
        	  //className: 'btn btn-secondary buttons-selected disabled',
              text: "<i class='fas fa-plus-circle'>Add</i>",
              name: 'add',
              className: 'btn-success btn-sm mr-1 disabled'        
          },
          {
             // extend: 'selected', 
              //className: 'btn btn-secondary buttons-selected disabled',
              text: "<i class='fas fa-edit'>Edit </i>",
              name: 'edit',
              className: 'btn-primary btn-sm mr-1 disabled'        
          },
          {
             // extend: 'selected', 
              //className: 'btn btn-secondary buttons-selected disabled',
              text: "<i class='fas fa-minus-circle'>Delete</i>",
              name: 'delete',
              className: 'btn-danger btn-sm mr-1 disabled'      
          }//,"copy","excel","pdf",""print"
          ],
          onAddRow: function(datatable, rowdata, success, error) {              
        	  $.ajax({
      			type: "POST",
      			url: "./createRole",				
      			data: rowdata,
      			success: function(resp){ 
      				var table = $('#roles_table_id').DataTable();				
    				table.ajax.reload();  	
    				 $(datatable.modal_selector).modal('hide');			
      				/*swal({
      					  title: "Success",
      					  text: resp,
      					  icon: "success",
      					});	*/			
                   
      			},
      			error: error
      		});
          },          
          onDeleteRow: function(datatable, rowdata, success, error) { 

        	  swal({
        		  title: "Are you sure?",
        		  text: "Are you sure want to delete the role?",
        		  icon: "warning",
        		  buttons: true,
        		  dangerMode: true,
        		})
        		.then((willDelete) => {
        		  if (willDelete) {
        			  $.ajax({
     	                 type:'POST',
     	                 url:'./deleteRole',
     	                 data:rowdata,
     	                 success: success,
     	        		 error: error	        		

     	                 });	
        		  } else {
        		    swal("Role not deleted");
        		  }
        		});
      		     
        	  
          },
          onEditRow: function(datatable, rowdata, success, error) {
        	  $.ajax({
        			type: "POST",
        			url: "./editRole",				
        			data: rowdata,
        			success: function(resp){   	
        				var table = $('#roles_table_id').DataTable();				
        				table.ajax.reload();
        				 $(datatable.modal_selector).modal('hide');			
        				/*swal({
        					  title: "Success",
        					  text: resp,
        					  icon: "success",
        					});				
                     */
        			},
        			error: error
        		});
          }			  
		    
		});
	
	} );



</script>
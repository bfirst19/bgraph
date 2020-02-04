

<?php include '../doc/header.php'; ?>



<div style="background-color: rgba(0,0,255,.1)" ><h6 align="left">Organization List</h6></div>       
<table id="orgs_table_id" class="table table-striped table-bordered" style="width:100%">    
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
    title: "Organization Name",
    name:"name",
    type:"text"    
  }, {
    title: "Created On",
    name:"create_date",
    type: "readonly"
  }, {
    title: "Created By",
    name:"created_by" ,
    type: "readonly"   
  }];


$(document).ready( function() {
	 var table = $('#orgs_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": true,
          "processing": true,
          "serverSide": false,
          altEditor: true,
          "ajax": {
              url: "./queryOrgs ", // json datasource
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
              text: "<i class='fas fa-plus-circle'>Add</i>",
              name: 'add', 
              className: 'btn-success btn-sm mr-1'       
          },
          {
              extend: 'selected', 
              text: "<i class='fas fa-edit'>Edit </i>",
              name: 'edit',
              className: 'btn-primary btn-sm mr-1'        
          },
          {
              extend: 'selected', 
              text: "<i class='fas fa-minus-circle'>Delete</i>",
              name: 'delete',
              className: 'btn-danger btn-sm mr-1'      
          }//,"copy","excel","pdf",""print"
          ],
          onAddRow: function(datatable, rowdata, success, error) {              
        	  $.ajax({
      			type: "POST",
      			url: "./createOrg",				
      			data: rowdata,
      			success: function(resp){ 
      				var table = $('#orgs_table_id').DataTable();				
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
          },          
          onDeleteRow: function(datatable, rowdata, success, error) { 

        	  swal({
        		  title: "Are you sure?",
        		  text: "Are you sure want to delete the Organization?",
        		  icon: "warning",
        		  buttons: true,
        		  dangerMode: true,
        		})
        		.then((willDelete) => {
        		  if (willDelete) {
        			  $.ajax({
     	                 type:'POST',
     	                 url:'./deleteOrg',
     	                 data:rowdata,
     	                 success: success,
     	        		 error: error	        		

     	                 });	
        		  } else {
        		    swal("Organization not deleted");
        		  }
        		});
      		     
        	  
          },
          onEditRow: function(datatable, rowdata, success, error) {
        	  $.ajax({
        			type: "POST",
        			url: "./editOrg",				
        			data: rowdata,
        			success: function(resp){   	
        				var table = $('#orgs_table_id').DataTable();				
        				table.ajax.reload();
        				 $(datatable.modal_selector).modal('hide');			
        				/*swal({
        					  title: "Success",
        					  text: resp,
        					  icon: "success",
        					});		*/		
                     
        			},
        			error: error
        		});
          }			  
		    
		});
	 
	} );



</script>

<?php include '../doc/header.php'; ?>



<div style="background-color: rgba(0,0,255,.1)" ><h6 align="left">Project List</h6></div>
<table id="projects_table_id" class="table table-striped table-bordered" style="width:100%">
    
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
    type: "hidden"    
  }, {
    title: "Number",
    name:"number",
    type: "readonly"   
  }, {
	    title: "Name",
	    name:"name"  
	},
	{
	    title: "Description",
	    name:"description"  
	},
	{
		    title: "Start Date",
		    name:"start_date",
		    type:"date",
		    pattern: "((?:19|20)\d\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])",
            placeholderMsg: "yyyy-mm-dd",
            errorMsg: "*Invalid date format. Format must be yyyy-mm-dd"
	},
	{
	    title: "End Date",
	    name:"end_date",
	    type:"date",
	    pattern: "((?:19|20)\d\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])",
        placeholderMsg: "yyyy-mm-dd",
        errorMsg: "*Invalid date format. Format must be yyyy-mm-dd"
	},
	{
	    title: "Manager",
	    name:"Manager"  
	},
	{
	    title: "Customer",
	    name:"customer_name"  
	}];
                    
$(document).ready( function() {
	 var table = $('#projects_table_id').DataTable({		  
		 "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": true,
          "processing": true,
          "serverSide": false,
          select: 'single',
          altEditor: true,
          "ajax": {
              url: "./queryProjects", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'post',  // method  , by default get
          },
          columns:columnDefs,
          columnDefs: [ {
              orderable: false,
              className: 'select-checkbox',
              targets:   0
          }, {              
              targets:   1,
              visible:false
          } ],
          
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
          }],//,"copy","excel","pdf",""print"],
          onAddRow: function(datatable, rowdata, success, error) {
        	  console.log(rowdata);              
        	  $.ajax({
      			type: "POST",
      			url: "./createProject",				
      			data: rowdata,
      			success: function(resp){ 
      				var table = $('#projects_table_id').DataTable();				
    				table.ajax.reload();  
    				 $(datatable.modal_selector).modal('hide');					
      				/*swal({
      					  title: "Success",
      					  text: resp,
      					  icon: "success",
      					});			*/	
                   
      			},
      			error: error
      		});
              
          },
          onDeleteRow: function(datatable, rowdata, success, error) {         	  
        	  swal({
        		  title: "Are you sure?",
        		  text: "Are you sure want to delete the Project?",
        		  icon: "warning",
        		  buttons: true,
        		  dangerMode: true,
        		})
        		.then((willDelete) => {            		
        		  if (willDelete) {
        			  $.ajax({
     	                 type:'POST',
     	                 url:'./deleteProject',
     	                 data:rowdata,
     	                 success: success,
     	        		 error: error	        		

     	                 });	
        		  } else {
        		    swal("Project not deleted");
        		  }
        		});
      		     
        	  
          },
          onEditRow: function(datatable, rowdata, success, error) { 
        	  console.log($(datatable.modal_selector));      	  
        	  $.ajax({
        			type: "POST",
        			url: "./editProject",				
        			data: rowdata,
        			success: function(resp){   	
        				var table = $('#projects_table_id').DataTable();				
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
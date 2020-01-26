
<?php include '../doc/header.php'; ?>


<div style="background-color: rgba(0, 0, 255, .1)">
	<h6 align="left">Users List</h6>
</div>
<table id="users_table_id" class="table table-striped table-bordered"
	style="width: 100%">

</table>

<?php

require ('../config/db.php');
//session_start();

$roleOptions;

$query = "select * from roles";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {
    $return_arr1[] = $row['name'];
    // $row['id'].":".$row['name'];
}
$roleOptions = json_encode(array_unique($return_arr1));

$projectOptions;

$query = "select * from projects";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {
    $return_arr2[] = $row['number'];
    // $row['id'].":".$row['name'];
}

$projectOptions = json_encode(array_unique($return_arr2));

$orgOptions;

$query = "select * from organizations";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {
    $return_arr3[] = $row['name'];
    // $row['id'].":".$row['name'];
}
$orgOptions = json_encode(array_unique($return_arr3));

?>



<?php include '../doc/footer.php'; ?>

<script type="text/javascript">

$(document).ready( function() {

var roles =<?php echo $roleOptions;?>;
var orgs =<?php echo $orgOptions;?>;
var projects =<?php echo $projectOptions;?>;


var columnDefs = [{
    title: "",
    id:"",
    type:"hidden"
  }, {
    title: "Id",
    name:"id",
    readonly:true,
    type:"hidden"    
  }, {
    title: "User Name",
    name:"username",
    required:"required"
  }, {
    title: "Email",
    name:"email"
  }, {
	    title: "First Name",
	    name:"first_name"
  }, {
	title: "Last Name",
	name:"last_name"  
  },
   {
		title: "Password",
		name:"password",
		type:"password"
   },
   {
    title: "Role",
    name:"role",
    type : "select",
    options : roles,
   /*select2 : {            
		width: "100%"
		},
    /*render: function (data, type, row, meta) {
    	 //if (data == null || !(data in roles)) return null;    	 
    	 return data;
    }*/
    
  }, {
	    title: "Organization",
	    name:"organization",
	    type : "select",
	    options : orgs,
	    //select2 : { width: "100%"},
	    /*render: function (data, type, row, meta) {
	    	// if (data == null || !(data in orgs)) return null;	    		    	 
	    	return data;
	    }*/
	     
	}, {
	    title: "Default Project",
	    name:"default_project",
	    	type : "select",
	    	options : projects,
		    //select2 : { width: "100%"},
		    /*render: function (data, type, row, meta) {
		    	// if (data == null || !(data in orgs)) return null;	    	 
		    	return data;
		    }*/
	}, {
	    title: "Create Date",
	    name:"create_date",
	    type:"hidden",
	    readonly:true   
}];



	// after table aply filter
 	//$('#users_table_id').excelTableFilter();
 	
	 var table = $('#users_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": true,
          "processing": true,
          "serverSide": false,
          altEditor: true,
          "ajax": {
              url: "./query_users", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'get',  // method  , by default get
          },
          columns: columnDefs,
          columnDefs: [ {
              orderable: true,
              className: 'select-checkbox',
              targets:   0
          },{
              orderable: true,
              targets:   6,
              visible:false
          } ],
          select: {
              style:    'os',
              selector: 'td:first-child'
          },
          order: [[ 1, 'asc' ]],
          buttons: [{
              text: "<i class='fas fa-plus-circle'>Add</i>",
              name: 'add',
              className: 'btn btn-success btn-sm mr-1'        
          },
          {
              extend: 'selected', 
              text: "<i class='fas fa-edit'>Edit </i>",
              name: 'edit',
              className: 'btn btn-primary btn-sm mr-1'
          },
          {
              extend: 'selected', 
              text: "<i class='fas fa-minus-circle'>Delete</i>",
              name: 'delete',
              className: 'btn btn-danger btn-sm mr-1'      
          }//,"copy","excel","pdf",""print"
          ],
          onAddRow: function(alteditor, rowdata, success, error) {
              console.log(rowdata);              
        	  $.ajax({
      			type: "POST",
      			url: "./createUser",				
      			data: rowdata,
      			success: function(resp){ 
      				var table = $('#users_table_id').DataTable();				
    				table.ajax.reload();  
    									
				if(resp.indexOf('Error')>-1){
      				swal({
      					  title: "Error",
      					  text: resp,
      					  icon: "error",
      					});	
					}else{
						$(alteditor.modal_selector).modal('hide');
					}			
                   
      			},
      			error: error
      		});
          },
          onDeleteRow: function(alteditor, rowdata, success, error) { 
        	  swal({
        		  title: "Are you sure?",
        		  text: "Are you sure want to delete the station?",
        		  icon: "warning",
        		  buttons: true,
        		  dangerMode: true,
        		})
        		.then((willDelete) => {            		
        		  if (willDelete) {
        			  $.ajax({
     	                 type:'POST',
     	                 url:'./deleteUser',
     	                 data:rowdata,
     	                 success: success,
     	        		 error: error	        		

     	                 });	
        		  } else {
        		    swal("Station not deleted");
        		  }
        		});
      		     
        	  
          },
          onEditRow: function(alteditor, rowdata, success, error) {              
        	  $.ajax({
        			type: "POST",
        			url: "./editUser",				
        			data: rowdata,
        			success: function(resp){   	
        				var table = $('#users_table_id').DataTable();				
        				table.ajax.reload();
        				if(resp.indexOf('Error') >-1){			
        				swal({
        					  title: "Error",
        					  text: resp,
        					  icon: "error",
        					});				
        				}else{
        					$(alteditor.modal_selector).modal('hide');	
        				}
        			},
        			error: error

        			
        		});
          }
		    
		});


	

		
	} );

</script>

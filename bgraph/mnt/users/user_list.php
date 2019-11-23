<?php include '../doc/header.php'; ?>


<div style="background-color: rgba(0, 0, 255, .1)">
	<h6 align="left">Users List</h6>
</div>
<table id="users_table_id" class="table table-striped table-bordered"
	style="width: 100%">

</table>

<?php include '../doc/footer.php'; ?>

<script type="text/javascript">

$(document).ready( function() {
	
jQuery.extend({
	getValues: function(url) {
        var result ={};
        result["0"] = "";
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'text',
            async:false,
            contentType: "application/json; charset=utf-8",
            success: function(data) {                 
                var json = $.parseJSON(data);
                $(json).each(function (i, val) { 
                    		result[val.id] = val.value;
                	}); 
            },
        	error: function(err) {            	
        		console.log(err);          
            }
        });
       return result;
    }
});

var roles =$.getValues('./roles');
var orgs =$.getValues('./orgs');
var projects = $.getValues('./projects');

	
var columnDefs = [{
    title: "",
    id:"",
    type:"hidden"
  }, {
    title: "Id",
    name:"id",
    readonly:true      
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
    select2 : { width: "100%"},
    render: function (data, type, row, meta) {
    	 //if (data == null || !(data in roles)) return null;    	 
    	 return data;
    }
    
  }, {
	    title: "Organization",
	    name:"organization",
	    type : "select",
	    options : orgs,
	    select2 : { width: "100%"},
	    render: function (data, type, row, meta) {
	    	// if (data == null || !(data in orgs)) return null;	    		    	 
	    	return data;
	    }
	     
	}, {
	    title: "Default Project",
	    name:"default_project",
	    	type : "select",
		    options : projects,
		    select2 : { width: "100%"},
		    render: function (data, type, row, meta) {
		    	// if (data == null || !(data in orgs)) return null;	    	 
		    	return data;
		    }
	}, {
	    title: "Create Date",
	    name:"create_date",
	    type:"datetime",
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
              name: 'add'        
          },
          {
              extend: 'selected', 
              text: "<i class='fas fa-edit'>Edit </i>",
              name: 'edit'
          },
          {
              extend: 'selected', 
              text: "<i class='fas fa-minus-circle'>Delete</i>",
              name: 'delete'      
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
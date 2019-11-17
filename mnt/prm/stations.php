<?php include '../doc/header.php'; ?>


<div style="background-color: rgba(0,0,255,.1)" ><h6 align="left">Stations List</h6></div>
<table id="stations_table_id" class="table table-striped table-bordered" style="width:100%">
   
</table>
<?php include '../doc/footer.php'; ?>

<script type="text/javascript">


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

var stypes =$.getValues('./statypes');

var columnDefs = [{
    title: "",
    id:"",
    type:"hidden"
  }, {
    title: "Id",
    name:"id",
    type: "hidden"    
  }, {
    title: "Station ID",
    name:"station_id"
  },{
	    title: "Station Name",
	    name:"name"
  }, {
    title: "Type",
    name:"type",
    type : "select",
    options : stypes,
    select2 : { width: "100%"},
    render: function (data, type, row, meta) {
    	// if (data == null || !(data in orgs)) return null;	    	 
    	return data;
    }
  }, {
	    title: "Station Address",
	    name:"address",
		type:"textbox"    
  }, {
	    title: "Latitude",
	    name:"lat"
		    
  }, {
	    title: "Longitude",
	    name:"lon"
		    
  }, {
	title: "Created By",
	name:"created_by" ,
	type: "readonly"   
  }, {
    title: "Created On",
    name:"create_date" ,
    type: "readonly"   
  }];
  
$(document).ready( function() {
	 var table = $('#stations_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": true,
          "processing": true,
          "serverSide": false,
          altEditor: true,
          "ajax": {
              url: "./queryStations", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'get',  // method  , by default get
          },
          columns: columnDefs,
          columnDefs: [ {
              orderable: false,
              className: 'select-checkbox',
              targets:   0
          },
          {
              visible: false,
              className: 'select-checkbox',
              targets:   1
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
          onAddRow: function(datatable, rowdata, success, error) {
             // console.log(rowdata);              
        	  $.ajax({
      			type: "POST",
      			url: "./createStation",				
      			data: rowdata,
      			success: function(resp){ 
      				var table = $('#stations_table_id').DataTable();				
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
          },
          onDeleteRow: function(datatable, rowdata, success, error) { 

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
     	                 url:'./deleteStation',
     	                 data:rowdata,
     	                 success: success,
     	        		 error: error	        		

     	                 });	
        		  } else {
        		    swal("Station not deleted");
        		  }
        		});
      		     
        	  
          },
          onEditRow: function(datatable, rowdata, success, error) {
        	  $.ajax({
        			type: "POST",
        			url: "./editStation",				
        			data: rowdata,
        			success: function(resp){   	
        				var table = $('#stations_table_id').DataTable();				
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
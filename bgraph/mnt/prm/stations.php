<?php include '../doc/header.php'; ?>

<link rel="stylesheet" href="../css/popupmodal.css">
<script src="../js/popupmodal-min.js"></script>

<div style="background-color: rgba(0, 0, 255, .1)">
	<h6 align="left">Stations List</h6>
</div>
<table id="stations_table_id" class="table table-striped table-bordered"
	style="width: 100%">

</table>

<div class="modal fade" id="file_upload_modal" tabindex="-1"
	role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="uploadModalLabel">File upload</h5>
				<div class="dt-buttons btn-group flex-wrap">
					<button class="btn btn btn-secondary" type="button"
						data-dismiss="modal" aria-label="Close">
						<i class="fa fa-window-close">Close</i>
					</button>

				</div>
			</div>
			<div class="modal-body">
				<form method="POST" action="" enctype="multipart/form-data"
					name="csvUploadForm" id="csvUploadForm">

					<div class="custom-file">
						<input type="file" class="custom-file-input" id="csvFile"
							name="csvFile" accept=".csv"> <label class="custom-file-label"
							for="csvFile">Choose file</label>
					</div>
					<div class="mt-3">
						<button type="submit" name="uploadCsvBtn" class="btn btn-primary"
							id="uploadCsvBtn">Upload</button>
					</div>

				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<?php include '../doc/footer.php'; ?>



<script type="text/javascript">

$(document).ready( function() {
	
$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

$('form#csvUploadForm').on('submit', function(event){
	  event.preventDefault();
	  $.ajax({
	   url:"./upload_stations",
	   method:"POST",
	   data:new FormData(this),
	   //dataType:'csv',
	   contentType:false,
	   cache:false,
	   processData:false,
	   success:function(res) {
		console.log("Added new file"+res);
			$("form#csvUploadForm").trigger("reset");
		 	$('#file_upload_modal').modal('hide');
		 	if(res.indexOf('error')!=-1){
		 		swal({
					  title: "Error",
					  text: res,
					  icon: "error",
					});	
		 		}		   
		 	var table = $('#stations_table_id').DataTable();				
			table.ajax.reload();
		}		 
	  });
});

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
          },{
              text: "<i class='fa fa-upload'>UploadCsv</i>",
              className:'btn btn-secondary',
              action: function ( e, dt, node, config ) {
                  loadFromCsv();
              }
          },{
              text: "<i class='fa fa-plus-circle' aria-hidden='true'>Create Station Type</i>",
              className:'btn btn-secondary',
              action: function ( e, dt, node, config ) {
            	  createStType();            	  
              }
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

		function loadFromCsv(){
			var selector = $('#file_upload_modal');
			 $(selector).modal('show');
		}

		function createStType(){
			swal("Enter station type:", {
      		  content: "input",
      		})
      		.then((value) => {
      			 $.ajax({
 	                 type:'POST',
 	                 url:'./addType',
 	                 data:{'type':value},
 	                 success: function(resp){
 	 	                 console.log(resp);
 	 	   			var table = $('#stations_table_id').DataTable();				
 	 	   			table.ajax.reload();
 	 	   			
 	                 },
 	        		 error: function(resp){
 	 	                 console.log(resp);
 	                 }	        		

 	                 });
      		});

		}
	
	} );

</script>
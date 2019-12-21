
<?php include '../doc/header.php'; ?>




<link rel="stylesheet" href="../css/popupmodal.css">
<script src="../js/popupmodal-min.js"></script>

<div style="background-color: rgba(0, 0, 255, .1)">
	<h6 align="left">Stations List</h6>
</div>
<table id="stations_table_id" class="table table-striped table-bordered"
	style="width: 100%">

</table>

<div style="background-color: rgba(0, 0, 255, .1);padding-top:15px;">
	<h6 align="left">Station types</h6>
</div>

<table id="stationtype_table_id" class="table table-striped table-bordered"
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

<?php 

require ('../config/db.php');
$stOptions;

$query = "select * from station_type";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {
    $return_arr1[] = $row['type_value'];
    // $row['id'].":".$row['name'];
}
$stOptions = json_encode(array_unique($return_arr1));

$projectOptions;

$query = "select * from projects";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {
    $return_arr2[] = $row['number'];
    // $row['id'].":".$row['name'];
}

$projectOptions = json_encode(array_unique($return_arr2));
?>

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

var stypes = <?php echo $stOptions;?>;
var projects =<?php echo $projectOptions?>;

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
    name:"st_type",
    type : "select",
    options : stypes,
    /*select2 : { width: "100%"},
    render: function (data, type, row, meta) {
    	// if (data == null || !(data in orgs)) return null;	    	 
    	return data;
    }*/
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
	    title: "Project",
	    name:"project_id",
	    type : "select",
	    options : projects,
		    
  }, {
	title: "Created By",
	name:"created_by" ,
	type: "hidden",
	readonly:true   
  }, {
    title: "Created On",
    name:"create_date" ,
    type: "hidden",
	readonly:true   
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
        name: 'add' ,
        className: 'btn btn-success btn-sm mr-1'       
    },
    {
        extend: 'selected', 
        text: "<i class='fas fa-edit'>Edit </i>",
        name: 'edit' ,
        className: 'btn btn-primary btn-sm mr-1'       
    },
    {
        extend: 'selected', 
        text: "<i class='fas fa-minus-circle'>Delete</i>",
        name: 'delete',
        className: 'btn btn-danger btn-sm mr-1'       
    },{
        text: "<i class='fa fa-upload'>UploadCsv</i>",
        className: 'btn btn-success btn-sm mr-1',
        action: function ( e, dt, node, config ) {
            loadFromCsv();
        }
    }//,"copy","excel","pdf",""print"
    ],
    onAddRow: function(alteditor, rowdata, success, error) {
       // console.log(rowdata);              
  	  $.ajax({
			type: "POST",
			url: "./createStation",				
			data: rowdata,
			success: function(resp){ 
				var table = $('#stations_table_id').DataTable();				
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
    onDeleteRow: function(DataTable, rowdata, success, error) { 

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
    onEditRow: function(alteditor, rowdata, success, error) {
  	  $.ajax({
  			type: "POST",
  			url: "./editStation",				
  			data: rowdata,
  			success: function(resp){   	
  				var table = $('#stations_table_id').DataTable();				
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
    }
	    
	});

		function loadFromCsv(){
			var selector = $('#file_upload_modal');
			 $(selector).modal('show');
		}

		

		//var templates =$.getValues('./chtemplates');		  

		var columnDefs2 = [{
		    title: "",
		    id:"",
		    type:"hidden"
		  },{
		    title: "Id",
		    name:"id",	
		    type:"hidden"	       
		  }, {
		    title: "Station type",
		    name:"type_value"
		  } /*{
			    title: "Checklist name",
			    id:"checklist_name",
			    name:"checklist_name",			    
			   	type : "select",
			    options : templates,
			    /*select2 : { width: "100%"},
			    render: function (data, type, row, meta) {
			       // if (data == null || !(data in orgs)) return null;    	
			      
			       return data;
			      }*/
			  /*}*/];


		 //$( "#checklist_name" ).autocomplete( "option", "appendTo",  $("altEditor-form") );
		
		 var table = $('#stationtype_table_id').DataTable({		  
			  "dom": '<"dt-buttons"lr><"clear">fBtip',
			  "responsive": true,
	          "processing": true,
	          "serverSide": false,
	           altEditor: true,	         
	          "ajax": {
	              url: "./stypes", // json datasource
	              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
	              type: 'get',  // method  , by default get
	          },
	          columns: columnDefs2,
	          columnDefs: [ {
	              orderable: false,
	              className: 'select-checkbox',
	              targets:   0
	          }],
	          select: {
	              style:    'os',
	              selector: 'td:first-child'
	          },
	          order: [[ 1, 'asc' ]],
	          buttons:[{
	              text: "<i class='fas fa-plus-circle'>Add</i>",
	              name: 'add',
	              className: 'btn btn-success btn-sm mr-1'        
	          },
	          {
	              extend: 'selected', 
	              text: "<i class='fas fa-minus-circle'>Delete</i>",
	              name: 'delete',
	              className: 'btn btn-danger btn-sm mr-1'      
	          }],
	          
	          onAddRow: function(alteditor, rowdata, success, error) {

	        	  $.ajax({
	 	                 type:'POST',
	 	                 url:'./addType',
	 	                 data:rowdata,
	 	                 success: function(resp){
	 	 	             console.log(resp);
	 	 	   			var table = $('#stationtype_table_id').DataTable();				
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
	 	        		 error: function(resp){
	 	 	                 console.log(resp);
	 	                 }	        		

	 	                 });
	      		     
	        	  
	          },onDeleteRow: function(alteditor, rowdata, success, error) { 
console.log(rowdata);
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
	     	                 url:'./deleteType',
	     	                 data:rowdata,
	     	                 success: success,
	     	        		 error: error	        		

	     	                 });	
	        		  } else {
	        		    swal("Station not deleted");
	        		  }
	        		});
	      		     
	        	  
	          }
		 });

		  
	} );

</script>
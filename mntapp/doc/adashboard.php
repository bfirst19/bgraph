<?php include 'header.php'; ?>


<div style="background-color: rgba(0, 0, 255, .1)">
	<h6 align="left">My Tasks</h6>
</div>

<style>
.selcls { 
    padding: 9px; 
    border: solid 1px #517B97; 
    outline: 0; 
    background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #CAD9E3), to(#FFFFFF)); 
    background: -moz-linear-gradient(top, #FFFFFF, #CAD9E3 1px, #FFFFFF 25px); 
    box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
    -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
    -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 

    } 
   
</style> 

<table id="mytasks_table_id" class="table table-striped table-bordered"
	style="width: 100%">
	<thead>

	</thead>
</table>


<?php include 'footer.php'; ?>




<script type="text/javascript">


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
    title: "Station Name",
    name:"stname",
    type:"text"    
  }, 
   {
    title: "Task Date",
    name:"start_date",
    type: "readonly"
  }, {
	    title: "Status",
	    name:"status",
	    type: "readonly"
  },{
	    title: "Remarks",
	    name:"comments",
	    type: "readonly"
  } ,{
	    title: "Location",
	    name:"location",
	    "mRender": function(data, type, full) {		  
		    var link = "https://www.google.com/maps?q=" + full[6]+","+full[7];
	        return '<a class="btn btn-success btn-sm mr-1" onClick="openMap('+full[6]+','+full[7] +');"><span class="fa fa-map-marker"></span></a>';	        
	      }
  	} ,{
  		
  	},
   {
	    title: "Station ID",
	    name:"station_id",
	    type: "readonly"
  },{
	    title: "Task Name",
	    name:"task_name",
	    type: "readonly"
}
  ];

function openMap(lat,lon){
	var link = "https://www.google.com/maps?q=" + lat+","+lon;
	window.open(link);	
}
$(document).ready( function() {
	
	var table = $('#mytasks_table_id').DataTable({				  
		  "dom": '<"dt-buttons"rl><"clear">fBtip',		  
		  "responsive": true,
        "processing": true,
        "serverSide": false,
        "bFilter": true,
       "ajax": {
           url: "./myTasksQry ", // json datasource
           //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
           type: 'post',  // method  , by default get
       },
       columns: columnDefs,
       columnDefs: [ {
           orderable: false,
           className: 'select-checkbox',
           targets:   0
       } ,{
           orderable: false,
           targets:   1,
           visible:false
       },{
           orderable: false,
           targets:   7,
           visible:false
       }],
       select: {
           style:    'os',
           selector: 'td:first-child'
       },
       order: [[ 1, 'asc' ]],
       buttons: [
      	 {
      	        text: "View",
      	        className: 'btn btn-success btn-sm mr-1',
      	        action: function ( e, dt, node, config ) {
      	        	 e.preventDefault();
      	        	var row = dt.rows( { selected: true } ).data();        	        	
      	        	//return '<a class="btn btn-info btn-sm dt-view" href=./complete?id=' + row[0][1] + '>' + 'View' + '</a>';
      	        	//window.location = './adcomp?id=' + row[0][1];
      	        	
      	        	var status = row[0][4];
    	        	
    	        	if(status==='Completed' || status==='For Approval'){
    	        		window.location = './adcomp?id=' + row[0][1];
    	        	}else{
    	        		window.location = './complete?id=' + row[0][1];
    	        	}
    	        	
      	        	
      	        }
      	    },{
    	        text: "<span><i class='fa fa-refresh'>Refresh</i></span>",
    	        className: 'btn btn-primary btn-sm',
    	        action: function (e, dt, node, config) {
    	            dt.ajax.reload(null, false);
    	        }
    	    },       	 		
           //"copy","excel","pdf","print"
           ],

	 });


		 	$('<label style="padding-left:20px;"> <b>Filter by:'+	 		 	
	            '<select class="form-control" id="dropdown1">'+
	            '<option value=""></option>'+
	            '<option value="Open">Open</option>'+	      		
	      		'<option value="Completed">Completed</option>'+	      		
	      		'<option value="Rejected">Rejected</option>'+
	      		'<option value="For Approval">For Approval</option>'+
	    		'</select>' + 
	            '</div>'+	            
	            '</label>').appendTo("#mytasks_table_id_wrapper .dataTables_length");

	    

	    /* $('<div class="pull-left form-group"><label for="dropdown2"> Filter by Date:</label>' +
		            '<select class="form-control selcls" id="dropdown2">'+
		            '<option value=""></option>'+
		            '<option value="bymonth">By Month</option>'+	      		
		      		'<option value="byweek">By Week</option>'+	      		
		      		'<option value="today">Today</option>'+
		    		'</select>' + 
		            '</div>').appendTo("#mytasks_table_id_wrapper .dataTables_filter");

		     $(".dataTables_filter label").addClass("pull-right");*/

		     

	 var oTable;
   oTable = $('#mytasks_table_id').dataTable();

   $('#dropdown1').change( function() { 
         //oTable.fnFilter( $(this).val() ); 
         table.columns(4).search( this.value ).draw();
    });
   
	/*  $('#dropdown2').on('change', function () {
        //table.columns(5).search( this.value ).draw();
        oTable.fnFilter( $(this).val() ); 
    } );*/


  
   
    
     

});

</script>
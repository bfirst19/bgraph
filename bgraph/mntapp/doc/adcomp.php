<?php include '../doc/header.php'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="../js/browser.js"></script>
<script src="../js/pdfmake.min.js"></script>
<script src="../js/vfs_fonts.js"></script>


<?php
require ('../config/db.php');
// session_start();
?>

<?php

// storing request (ie, get/post) global array to a variable
$requestData = $_REQUEST;

$id = $_GET['id'];

$query = "select * from tasks where id ='$id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

$st_id = $row["stations_id"];
$status = $row['status'];
$task_name=$row['name'];
$main_time=$row['start_date'];

$query_st = "select * from stations where station_id ='$st_id'";
$result_st = mysqli_query($con, $query_st) or die(mysqli_error($con));
$row_st = mysqli_fetch_assoc($result_st);

$st_name=$row_st['name'];
?>

<style>
body {
	margin: 0;
	padding: 0;
	background-color: #FAFAFA;
	font: 12pt "Tahoma";
}

* {
	box-sizing: border-box;
	-moz-box-sizing: border-box;
}

.page {
	width: 21cm;
	min-height: 29.7cm;
	padding: 2cm;
	margin: 1cm auto;
	border: 1px #D3D3D3 solid;
	border-radius: 5px;
	background: white;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.subpage {
	padding: 1cm;
	border: 5px red solid;
	height: 256mm;
	outline: 2cm #FFEAEA solid;
}

@page {
	size: A4;
	margin: 0;
}

@media print {
	.page {
		margin: 0;
		border: initial;
		border-radius: initial;
		width: initial;
		min-height: initial;
		box-shadow: initial;
		background: initial;
		page-break-after: always;
	}
}

.btn-danger {
	background: red;
}

.editField {
	margin-top: 10px;
}

hr.style1 {
	border-top: 2px solid black;
	margin-top: 2em !important;
	margin-bottom: 2em !important;
	border-width: 1px;
}

hr.style2 {
	border-top: 2px solid black;
	margin-top: 0.35em !important;
	margin-bottom: 0.35em !important;
	border-width: 1px;
}

.table-bordered {
	font-size: 14px;
}

p {
	margin-top: 0;
	margin-bottom: 1rem;
	font-size: 14px;
}
</style>

<div>
	<div class="pull-left">
		<button class="btn btn-outline-info btn-rounded btn-sm" tabindex="0"
			aria-controls="#builder" type="button"
			onclick="parent.history.back();">
			<span class="fas fa-arrow-left"></span>
		</button>
	</div>
	
	<?php

if (strcmp($status, "Completed") != 0) {
    ?>
	
	<div class="pull-right">
		<button class="btn btn-info btn-rounded" tabindex="0"
			aria-controls="#builder" type="button" name="approveTask"
			id="approveTask">
			<span class="fas">Approve</span>
		</button>
		<button class="btn btn-danger btn-rounded" tabindex="0"
			aria-controls="#builder" type="button" name="rejectTask"
			id="rejectTask">
			<span class="fas">Reject</span>
		</button>
	</div>
	<?php
} else {
    ?>
<div class="pull-right">
		<button class="btn btn-info btn-rounded" tabindex="0"
			aria-controls="#builder" type="button" name="printReport"
			id="printReport">
			<span class="fas">Print</span>
		</button>
		
	</div>
<?php
}
?>
</div>

<?php

$image = '../assets/images/logo.png';
// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC: data:{mime};base64,{data};
$src = 'data: ' . mime_content_type($image) . ';base64,' . $imageData;

?>


<pre id="msg"></pre>

<div id="container1" class="container">

	<div id="row1" class="row">
		<div class="col-md-4" align="left">
					<img alt="logo" src="../assets/images/logo.png">				
			</div>
		<div class="col-md-8" align="right">
			<section>
				<h1 style="color: #1872c8;padding:12px;">BluGraph Technologies Pte Ltd</h1>
				<h4>7 Gambas Crescent</h4>
				<h4>#09-24 Ark@ Gambas</h4>
				<h4>Singapore 757087</h4>
			</section>


		</div>
	</div>
	<div id="pContent">
		<div id="container4" title="title-task" style="font-size: 12px;">
			<h3 style="text-align: center;"><?php echo $task_name;?></h3>
		</div>
		<hr>
		<div id="container5">
			<div id="row3" class="row col-sm-12">
				<div class="col-sm-4">
					<div class="form-group">
						<p>
							Station ID:<?php echo $st_id;?>
						</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<p>
							Station name:<?php echo $st_name;?>
						</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<p>
							Maintenance Date &amp; Time: <?php echo $main_time;?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div id="container12">
	
	
<?php
$checklist_content;
if (isset($_GET['id'])) {
    $id = stripslashes($_GET['id']);
    $id = mysqli_real_escape_string($con, $id);

    $checklist_id = $row['checklist_id'];

    $qry2 = "SELECT * from mnt_report where checklist_id='$checklist_id'";
    $result2 = mysqli_query($con, $qry2) or die(mysqli_error($con));
    $row2 = mysqli_fetch_assoc($result2);
    $str = $row2["json"];
    // echo json_encode($checklist_content);
    // exit();

    // Convert JSON string to Array
    $someArray = json_decode($str, true);

    // print_r($someArray); // Dump all data of the Array

    // echo $someArray[0]["legend"]; // Access Array data

    // echo 'No of legend elements:' . count($someArray);

    // Convert JSON string to Object

    $someObject = json_decode($str);

    // print_r($someObject); // Dump all data of the Object

    // echo $someObject[0]->name; // Access Object data

    foreach ($someArray as $key => $value) {

        // echo $value["legend"] . ", " . $value["components"] . "<br>";
    }

    // $temp = "<div class='panel panel-default' style='padding: 10px;'>";
    // $temp .= "<div class='panel-body'><fieldset class='col-md-12'><legend>Checklist</legend>";
    $temp .= "<div class='table-responsive-sm'>";
    $temp .= "<table class='table table-bordered table-sm' id='checklist_table_id'>";
    $temp .= "<thead class='thead-light'>";
    $temp .= "<th>S.No</th>";

    $temp .= "<th>Item</th>";

    $temp .= "<th>Description</th>";

    $temp .= "<th>Remarks</th>";
    $temp .= "  </thead>";
    for ($i = 0; $i < sizeof($someArray); $i ++) {
        $rowdata = $someArray[$i];

        $els = sizeof($rowdata["components"]);
        $rc = $i + 1;

        for ($j = 0; $j < sizeof($rowdata["components"]); $j ++) {

            $temp .= "<tr>";

            if ($j == 0) {

                $temp .= "<td rowspan=" . (int) $els . ">" . $rc . "</td>";

                $temp .= "<td rowspan=" . (int) $els . ">" . $rowdata["legend"] . "</td>";
            }

            $temp .= "<td>" . $rowdata["components"][$j]["description"] . "</td>";

            $temp .= "<td>" . $rowdata["components"][$j]["currentValue"] . "</td>";
        }

        $temp .= "</tr>";
    }

    /* End tag of table */

    $temp .= "</table>";
    $temp .= "</div>";
    // $temp .= "</fieldset></div></div>";

    /* Printing temp variable which holds table */

    echo $temp;
}
?>

<?php
$assinged_to = $row['assigned_to'];
$usr1Qry = "SELECT * from users where username='$assinged_to'";
$usr1Rst = mysqli_query($con, $usr1Qry) or die(mysqli_error($con));
$usr1 = mysqli_fetch_assoc($usr1Rst);
$user1 = $usr1["first_name"] . ' ' . $usr1["last_name"];

$reassigned_to = $row['reassigned_to'];
$usr2Qry = "SELECT * from users where username='$reassigned_to'";
$usr2Rst = mysqli_query($con, $usr2Qry) or die(mysqli_error($con));
$usr2 = mysqli_fetch_assoc($usr2Rst);
$user2 = $usr2["first_name"] . ' ' . $usr2["last_name"];

?>
</div>
		<div id="container14">
			Remarks: <br>
			<hr>
			<hr>
		</div>
		<div id="container15">
			<div id="row2" class="row col-md-12">
				<div id="mainTeam" class="col-md-6" align="left">
					<p>Maintenance Team</p>
					<br>
					<p style="">
						Name:<?php echo $user1; ?>
					</p>
				</div>

				<div id="verifyTeam" class="col-md-6" align="left">
					<p>Verified By</p>
					<br>
					<p style="">
						Name: <?php echo $user2; ?>
					</p>
				</div>
			</div>
		</div>
	</div>

</div>


<?php include '../doc/footer.php'; ?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>


<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>
<script src="../js/jquery.ba-throttle-debounce.js"></script>

<script type="text/javascript" src="../js/jquery.googoose.js"></script>
<script type="text/javascript" src="../js/FileSaver.js"></script>
<script type="text/javascript" src="../js/jquery.wordexport.js"></script>
<script type="text/javascript" src="../js/canvasjs.min.js"></script>
<script type="text/javascript" src="../js/jquery.fileDownload.js"></script>

<?php 
$milliseconds = round(microtime(true) * 1000);
$fname =$milliseconds.'_'.$id.'.pdf';

?>
<script>

$(document).ready( function() {
	
	var task_id = "<?php echo $id ?>";
	var checklist_id= "<?php echo $checklist_id ?>";  
	
	$(document).on("click", "#printReport", function () {				
		downloadPdf();	
	});

	

	function printContent(){
		var doc2Html    = $("#pContent").html();
		var val = htmlToPdfmake(doc2Html);

		var table =  $("#container12").html();
		var tableContent = htmlToPdfmake(table);		
	
		var pageOrientation;

		var taskContent = [
			 	{
			        margin : [ 20, 10, 10,20],
			        alignment:'center',
			        fontSize:10,
			        text:'<?php echo $task_name;?>'
			        
			    },
			     {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.5 }]},
			    {
			      margin : [ 20, 10, 20,5],
			      fontSize : 8,
			      columns: [
			        {
			          // auto-sized columns have their widths based on their content
			          width: '*',
			          
			          text: 'Station ID: <?php echo $st_id;?>'
			        },
			        {
			          // star-sized columns fill the remaining space
			          // if there's more than one star-column, available width is divided equally
			          width: '*',
			          text: 'Station name: <?php echo $st_name;?>'
			        },
			        {
			          // fixed width
			          width: '*',
			          text: 'Maintenance Date & Time: <?php echo $main_time;?>'
			        }
			      ],
			      // optional space between columns
			      columnGap: 10
			    },
			     {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.5 }]},
		];
		
		pageOrientation = 'portrait';
		
		//pageOrientation = 'landscape';
		
		var dc =[
			   //comment remarks
			   {
			            margin:[20,10,10,10],
			            "width":"*",
			            "text":"Remarks:",
			            fontSize:8,
			            bold:true
			   },
			   {
			       "canvas":[
			         {
			            "type":"line",
			            "x1":0,
			            "y1":5,
			            "x2":515,
			            "y2":5,
			            "lineWidth":0.5
			         }
			      ]
			   },
			   {
			       "canvas":[
			         {
			            "type":"line",
			            "x1":0,
			            "y1":20,
			            "x2":515,
			            "y2":20,
			            "lineWidth":0.5
			         }
			      ]
			   },
			   {
			      "margin":[20,30,20,5],
			      "fontSize":8,
			      "columns":[
			         {
			            "width":"*",
			            "text":"Maintenance Team: \n\n Name: <?php echo $user1;?>"
			         },
			         {
			            "width":"*",
			            "text":"Verified By:\n\n Name: <?php echo $user2;?>"
			         }
			      ],
			      "columnGap":10
			   }
			   ];
		
		//var resultContent = pdfContent.concat(tableHtml);
		 var fcont = [].concat(taskContent, tableContent);
		 var resultContent = [].concat(fcont, dc);
		
		var docDefinition = {

			    pageSize : 'A4',
			    pageOrientation : 'portrait',
			    // [left, top, right, bottom] or [horizontal, vertical] or just a number
			    // for equal margins
			    pageMargins:[40,100,40,50],
			    footer : function(currentPage, pageCount) {
			        return {
			            margin : [ 20, 0, 20,20],
			            fontSize : 8,
			            columns : [
			                    {
			                        text : '' ,
			                        alignment : 'left',
			                        bold : true
			                    },
			                    {
			                        text : 'Page ' + currentPage.toString() + ' of '
			                                + pageCount,
			                        alignment : 'center',
			                        bold : true
			                    }, {
			                        text : '',
			                        alignment : 'right',
			                        bold : true
			                    } ]
			        };
			    },
			    header: function(currentPage, pageCount, pageSize) {
				         return {
				        	 margin : [ 20, 0, 20,20],
					         fontSize : 8,
			            columns : [
			                    {
                                    image: 'data: image/png;base64,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',
                                    alignment : 'left',                                                                     
			                       
			                    },
			                    
			                    {
                                width: '*',
                                alignment: 'right',
                                stack: [
                                    {
                                        margin: [0, 30, 10, 0],
                                        fontSize: 10,
                                        bold: true,
                                        alignment:'left',
                                        color:'#1872c8',
                                        text: 'BluGraph Technologies Pte Ltd'
                                    },
                                    {
                                         margin: [0, 5, 10, 0],
                                            fontSize: 8,
                                            bold: true,
                                            alignment:'left',
                                        text: '7 Gambas Crescent'
                                    },
                                    {
                                            margin: [0, 5, 10, 0],
                                            fontSize: 8,
                                            bold: true,
                                            alignment:'left',
                                        text: '#09-24 Ark@ Gambas'
                                    },
                                    {
                                        margin: [0, 5, 10, 0],
                                        fontSize: 8,
                                        bold: true,
                                        alignment:'left',
                                        text: 'Singapore 757087'
                                }
                                ]
                             }
                       
			             ]
			        };
			    },			    
			    content :
			    	resultContent,
			    	styles: {
			    		header: {
			    			fontSize: 8,
			    			bold: true
			    		},
			    		'table-bordered': {
			    			widths: ['*'],
			    			margin: [0, 5, 10, 0],
			    			fontSize: 8,
			    			bold: false
			    		},
			    		'table': {
			    			widths: ['*'],
			    			margin: [0, 5, 10, 0],
			    			fontSize: 8,
			    			bold: false
			    		},
			    		quote: {
			    			italics: true
			    		},
			    		small: {
			    			fontSize: 8
			    		}
			    	}	
				    	
			};

		return docDefinition;
		
	} 

	function downloadPdf(){
		var docDefinition = printContent();
	      pdfMake.createPdf(docDefinition).getBlob(function(outDoc) {		     
		      const data = window.URL.createObjectURL(outDoc);
		        var link = document.createElement('a');
		        link.href = data;
		        link.download="<?php echo $fname;?>";
		        link.click();
		        setTimeout(function(){
		          // For Firefox it is necessary to delay revoking the ObjectURL
		          window.URL.revokeObjectURL(data);
		        }, 100);
	      });
	     
	}
	
	function printmpdf(){
		console.log('im called..');
		var docDefinition = printContent();
	      pdfMake.createPdf(docDefinition).getBlob(function(outDoc) {		          
		   
			 	var fd = new FormData();     // To carry on your data  
		        fd.append('pdf',outDoc);
		        fd.append('task_id',task_id);
		        fd.append('checklist_id',checklist_id);
		        
			    $.ajax({
		        	url: './savepdf',   //here is also a problem, depends on your 
		           data: fd,           //backend language, it may looks like '/model/send.php'
		           dataType: 'text',
		           cache:false,
		           processData: false,
		           contentType: false,
		           type: 'POST',
		           success: function (response) {
		             //alert('Exit to send request');
		        	   parent.history.back();
		           },
		           error: function (jqXHR) {
		        	  // alert('Failure to send request');
		           }
		        });		        
	      });    
}

	$('#approveTask').on('click', function(e){
    	//e.preventDefault(); 	            	
        $('#approveTask').unbind('click');     
        //var doc2Html    = $("#container1").html();
       // console.log(doc2Html);   
                
			//save as pdf
        	printmpdf();
        
      /* $.ajax({
			type: "POST",
			url: "./task_actions",				
			data: {"action":"approveTask","task_id":task_id,"checklist_id":checklist_id,"doc2Html":doc2Html},
			success: function(res){
			console.log("approved task."+res);		
			//location.reload(true);			
			if(res.indexOf('Error')!=-1){
				swal({
				  title: "Error",
				  text: res,
				  icon: "error",
				});	
				}	else{
					swal({
						  title: "Info",
						  text: res,
						  icon: "info",
						});
				}
			$('#approveTask').prop('disabled', true);
			$('#rejectTask').prop('disabled', true);
			},error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});   		*/                   
		                          	
    });


		
	
	$('#rejectTask').on('click', async function(e){
    	e.preventDefault(); 	            	
    	
   
    	
                  swal("Enter reject comments:", {
         				 content: "input",
        			})
       				 .then((value) => { 
          				let data = {
                  				action:"rejectTask",
                  				task_id:task_id,
                  				comment:value
                  				}

          				 $.ajax({
          					type: "POST",
          					url: "./task_actions",				
          					data: {"action":"rejectTask","task_id":task_id,comment:value},
          					success: function(res){
          					console.log("approved task."+res);		
          					//location.reload(true);			
          					if(res.indexOf('Error')!=-1){
          						swal({
          						  title: "Error",
          						  text: res,
          						  icon: "error",
          						});	
          						}else{
          							swal({
                						  title: "Info",
                						  text: res,
                						  icon: "info",
                						});	
          						}
          					$('#approveTask').prop('disabled', true);
          					$('#rejectTask').prop('disabled', true);
          					},error: function(resp){
          						console.log("Error");
          						console.log(resp);
          					}
          				});   	
       			
           			 
       				 });
  
    	                   
		                          	
   });


});
  	
</script>
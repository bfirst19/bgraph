<?php include '../doc/header.php'; ?>

<?php
require ('../config/db.php');
// session_start();
?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>
<script src="../js/jquery.ba-throttle-debounce.js"></script>

<style>
fieldset {
	border: 1px solid #ddd !important;
	margin: 0;
	xmin-width: 0;
	padding: 10px;
	position: relative;
	border-radius: 4px;
	background-color: #f5f5f5;
	padding-left: 10px !important;
}

legend {
	font-size: 14px;
	font-weight: bold;
	margin-bottom: 0px;
	width: 20%;
	border: 1px solid #ddd;
	border-radius: 4px;
	padding: 5px 5px 5px 10px;
	background-color: #ffffff;
}

p {
	font-size: 0.80rem;
}

body {
	margin: 10px;
}

.btn-danger {
	background: red;
}

.editField {
	margin-top: 10px;
}
</style>

<?php

// storing request (ie, get/post) global array to a variable
$requestData = $_REQUEST;

$id = $_GET['id'];

$query = "select * from tasks where id ='$id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

$st_id = $row["stations_id"];

$query_st = "select * from stations where station_id ='$st_id'";
$result_st = mysqli_query($con, $query_st) or die(mysqli_error($con));
$row_st = mysqli_fetch_assoc($result_st);

?>

<div>
	<div class="pull-left">
		<button class="btn btn-outline-info btn-rounded btn-sm" tabindex="0"
			aria-controls="#builder" type="button"
			onclick="parent.history.back();">
			<span class="fas fa-arrow-left"></span>
		</button>
	</div>
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
</div>



<div id="taskDetailsDiv">
	<div class="panel panel-default" style="padding: 5px;">

		<!-- div class="panel-heading">Task Completion Activity</div-->
		<div class="panel-body">

			<fieldset class="col-md-12">
				<legend>Task Details</legend>

				<div class="panel panel-default">
					<div class="panel-body">
						<!-- 1 -->
						<div class='row'>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Station ID: <b><?php echo $st_id;?></b>
									</p>
								</div>
							</div>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Station name:<b> <?php echo $row_st["name"];?></b>
									</p>
								</div>
							</div>

							<!-- 2 -->

							<div class='col-sm-4'>
								<div class='form-group'>
									<p>
										Maintenance Date & Time: <b><?php echo $row["start_date"];?></b>
									</p>
								</div>
							</div>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Task Name:<b><?php echo $row["name"];?></b>
									</p>
								</div>
							</div>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Status:<b> <?php echo $row["status"];?></b>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>

			</fieldset>

			<div class="clearfix"></div>
		</div>

	</div>

</div>


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

  //  echo $someArray[0]["legend"]; // Access Array data

   // echo 'No of legend elements:' . count($someArray);

    // Convert JSON string to Object

    $someObject = json_decode($str);

    // print_r($someObject); // Dump all data of the Object

    // echo $someObject[0]->name; // Access Object data

    foreach ($someArray as $key => $value) {

        // echo $value["legend"] . ", " . $value["components"] . "<br>";
    }

    $temp  = "<div class='panel panel-default' style='padding: 10px;'>";
    $temp  .="<div class='panel-body'><fieldset class='col-md-12'><legend>Checklist</legend>";
    $temp .= "<div class='table-responsive-sm'>";
    $temp .= "<table class='table table-bordered '>";
    $temp .= "<thead class='thead-light'>";
    $temp .= "<th>S.No</th>";

    $temp .= "<th>Item</th>";

    $temp .= "<th>Description</th>";

    $temp .= "<th>Remarks</th>";
    $temp .= "  </thead>";
    for ($i = 0; $i < sizeof($someArray); $i ++) 
    {
        $rowdata = $someArray[$i];

        $els = sizeof($rowdata["components"]);
        $rc = $i+1;

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
    $temp .= "</fieldset></div></div>";

    /* Printing temp variable which holds table */

    echo $temp;
}
?>
 
<?php include '../doc/footer.php'; ?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>
<script src="../js/jquery.ba-throttle-debounce.js"></script>


<script>
$(document).ready( function() {

	var task_id = "<?php echo $id ?>"; 

	$('#approveTask').on('click', function(e){
    	//e.preventDefault(); 	            	
        $('#approveTask').unbind('click');                    
      $.ajax({
			type: "POST",
			url: "./task_actions",				
			data: {"action":"approveTask","task_id":task_id},
			success: function(res){
			console.log("approved task."+res);		
			location.reload(true);			
			if(res.indexOf('Error')!=-1){
				swal({
				  title: "Error",
				  text: res,
				  icon: "error",
				});	
				}	
            
			},error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});   		                   
		                          	
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


          			          				
          			/*fetch('./task_actions', {
          				    method: 'POST',
          				    mode: 'cors', 
          				    cache: 'no-cache', 
          				    credentials: 'same-origin', 
          				    headers: {
          				    	'Content-Type': 'application/json;charset=utf-8'
          				      // 'Content-Type': 'application/x-www-form-urlencoded',
          				    },
          				    redirect: 'follow', 
          				    referrer: 'no-referrer', 
          				    body: JSON.stringify(data)
          				  });
          				*/
      					
          				 $.ajax({
          					type: "POST",
          					url: "./task_actions",				
          					data: {"action":"rejectTask","task_id":task_id,comment:value},
          					success: function(res){
          					console.log("approved task."+res);		
          					location.reload(true);			
          					if(res.indexOf('Error')!=-1){
          						swal({
          						  title: "Error",
          						  text: res,
          						  icon: "error",
          						});	
          						}	
          		            
          					},error: function(resp){
          						console.log("Error");
          						console.log(resp);
          					}
          				});   	
       			
           			 
       				 });
  
    	                   
		                          	
   });

    

	
var json = <?php echo $checklist_content;?>;

function saveFormData(form){
	var jsonElement = document.getElementById('formio');
	console.log(jsonElement);
}



});
  	
</script>

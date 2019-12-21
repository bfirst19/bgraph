<?php include '../doc/header.php'; ?>
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
	width: 35%;
	border: 1px solid #ddd;
	border-radius: 4px;
	padding: 5px 5px 5px 10px;
	background-color: #ffffff;
}
</style>
<div class="container-rprt">
	<br />
	<div class="panel panel-default">

		<div class="panel-heading">
			<h1>
				<b>Reports: </b>
			
			</h1>
		</div>
		<br>
		<div class="panel-body">

			<fieldset class="col-md-12">
				<legend>Report Query Builder</legend>

				<div class="panel panel-default">
					<div class="panel-body">
						<form class="forms-sample" action="" method="post"
							id="reportForm">
							<div class="row col-sm-12">
								<div class="col-sm-2">
									<div class="form-group">
										<label for="starts_at">Starts From</label> <input
											data-format="dd/MM/yyyy hh:mm:ss" type="date"
											class="form-control" name="starts_at" id="starts_at"
											placeholder="Starts at" required="required" />
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label for="ends_at">Ends at</label> <input type="date"
											class="form-control" name="ends_at" id="ends_at"
											placeholder="Ends at" required="required" />
									</div>
								</div>								
							</div>
							<div class="col-sm-2">
									<div class="form-group">
										<button type="submit" class="btn btn-info" id="qryReport">Download Report</button>
									</div>
							</div>
						</form>
					</div>
				</div>

			</fieldset>

			<div class="clearfix"></div>
		</div>
	</div>
</div>

<?php include '../doc/footer.php'; ?>

<script>
$("#qryReport").on("click", function(e){
	$.ajax({    
        type: "post",   
        url: "./dwn_report",    
        data: $("#reportForm").serialize(),  
        success: function(response){    
            if(response == 'Success'){  
                $('#_err').html('Complete, Thank you!');        
            } else {    
                $('#_err').html('Error: '+response);    
            }   
        }
    }); 
});
</script>
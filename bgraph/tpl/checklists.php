<?php include '../doc/header.php'; ?>


	<!-- Bootstrap core JavaScript-->
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<link href="../css/form_builder.css" rel="stylesheet">
<script src="../js/flatpickr.js"></script>

<div class="form_builder" style="margin-top: 25px">

  <div class="row">
    <div class="col-sm-2">
      <nav class="nav-sidebar">
        <ul class="nav">
            
          <li class="form_bal_textfield"> <a href="javascript:;">Text Field <i class="fa fa-plus-circle pull-right"></i></a> </li>
          <li class="form_bal_textarea"> <a href="javascript:;">Text Area <i class="fa fa-plus-circle pull-right"></i></a> </li>
          <li class="form_bal_select"> <a href="javascript:;">Select <i class="fa fa-plus-circle pull-right"></i></a> </li>
          <li class="form_bal_radio"> <a href="javascript:;">Radio Button <i class="fa fa-plus-circle pull-right"></i></a> </li>
          <li class="form_bal_checkbox"> <a href="javascript:;">Checkbox <i class="fa fa-plus-circle pull-right"></i></a> </li>
          <!--li class="form_bal_email"> <a href="javascript:;">Email <i class="fa fa-plus-circle pull-right"></i></a> </li-->
          <!--li class="form_bal_number"> <a href="javascript:;">Number <i class="fa fa-plus-circle pull-right"></i></a> </li-->
          <!--li class="form_bal_password"> <a href="javascript:;">Password <i class="fa fa-plus-circle pull-right"></i></a> </li-->
           <li class="form_bal_date"> <a href="javascript:;">Date &Time<i class="fa fa-plus-circle pull-right"></i></a></li>
           
                              
          <li class="form_bal_button"> <a href="javascript:;">Button <i class="fa fa-plus-circle pull-right"></i></a> </li>
        </ul>
      </nav>
    </div>
    <div class="col-md-5 bal_builder">
      <div class="form_builder_area"></div>
    </div>
    <div class="col-md-5">
      <div class="col-md-12">
        <form class="form-horizontal">
          <div class="preview"></div>
          <div style="display: none" class="form-group plain_html">
            <textarea rows="50" class="form-control"></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<button style="cursor: pointer;display: none" class="btn btn-info export_html mt-2 pull-right">Save Template</button>


 

					
<script>
var dates = $('input[type="date"]');

		dates.each(function(index){
	 console.log(this);
	  this.flatpickr({
			enableTime: true,	
		});
	}
);
</script>							

<?php include '../doc/footer.php'; ?>
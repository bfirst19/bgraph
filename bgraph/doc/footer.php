

		</div>
		</div>

		 <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../user/login">Logout</a>
        </div>
      </div>
    </div>
  </div>
	</div>


          <!-- Modal -->
<div id="taskModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">

<h5 class="modal-title" id="taskModalLabel">Create new Task</h5>
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

        <form role="form" method="post" id="task_createform">        
        <div class="form-group">
            <label for="taskname">
                Task Name:</label>
            <input type="text" class="form-control"
            id="taskname" name="taskname"   required maxlength="50">

        </div>
        <div class="form-group">
            <label for="task_desc">
                Task Description:</label>
            <input type="text" class="form-control"
            id="task_desc" name="task_desc" required maxlength="50">
        </div>
        <div class="form-group">
            <label for="scheduled_date">
                Scheduled Date:</label>
            <input class="form-control" type="date" name="scheduled_date" id="scheduled_date" 
            maxlength="6000" rows="7"></textarea>
        </div>
         <div class="form-group">
            <label for="location">
                Location:</label>  
  <select class="form-control" id="location">
    <option selected>Choose...</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Submit →</button>

    </form>
    <div id="success_message" style="width:100%; height:100%; display:none; ">
        <h3>Sent your message successfully!</h3>
    </div>
    <div id="error_message"
    style="width:100%; height:100%; display:none; ">
        <h3>Error</h3>
        Sorry there was an error sending your form.

    </div>
</div>
</div>
</div>
</div>

	<!-- Bootstrap core JavaScript-->
  <script src="../assets/jquery/jquery.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../assets/chart.js/Chart.min.js"></script>
  <script src="../assets/datatables/jquery.dataTables.js"></script>
  <script src="../assets/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/bg-admin.min.js"></script>
  <script src="../js/buttons/dataTables.buttons.js"></script>
  <script src="../js/buttons/buttons.html5.js"></script>
  <script src="../js/buttons/buttons.flash.js"></script>
  <script src="../js/buttons/buttons.dataTables.js"></script>
  <script src="../js/buttons/buttons.print.js"></script>
  <script src="../js/buttons/buttons.bootstrap4.js"></script>
    <script src="../js/buttons/jszip.min.js"></script>
      <script src="../js/buttons/pdfmake.min.js"></script>
        <script src="../js/buttons/vfs_fonts.js"></script>
        
        <script src="../js/buttons/dataTables.fixedColumns.min.js"></script>
        <script src="../js/buttons/dataTables.select.min.js"></script>



  </body>

</html>

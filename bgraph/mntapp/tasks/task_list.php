<?php include '../doc/header.php'; ?>


<style>
.dropdown-menu {
	background-color: grey;
}
</style>

<script src="../js/popper.min.js"></script>
<script src="../js/tooltip.min.js"></script>
<script src="../js/flatpickr.js"></script>

<!--  script src='../js/fullcalendar/packages/moment/main.js'></script-->
<script src='../js/fullcalendar/packages/core/main.js'></script>

<script src='../js/fullcalendar/packages/moment/main.js'></script>
<script src='../js/fullcalendar/packages/moment-timezone/main.js'></script>
<script src='../js/fullcalendar/packages/bootstrap/main.js'></script>


<link href='../js/fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='../js/fullcalendar/packages/daygrid/main.css'
	rel='stylesheet' />
<link href='../js/fullcalendar/packages/timegrid/main.css'
	rel='stylesheet' />
<link href='../js/fullcalendar/packages-premium/timeline/main.css'
	rel='stylesheet' />
<link
	href='../js/fullcalendar/packages-premium/resource-timeline/main.css'
	rel='stylesheet' />
<link href='../js/fullcalendar/packages/list/main.css' rel='stylesheet' />

<link href='../js/fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='../js/fullcalendar/packages/daygrid/main.css'
	rel='stylesheet' />
<link href='../js/fullcalendar/packages/timegrid/main.css'
	rel='stylesheet' />
<link href='../js/fullcalendar/packages/list/main.css' rel='stylesheet' />
<script src='../js/fullcalendar/vendor/rrule.js'></script>
<script src='../js/fullcalendar/packages/core/main.js'></script>
<script src='../js/fullcalendar/packages/interaction/main.js'></script>
<script src='../js/fullcalendar/packages/daygrid/main.js'></script>
<script src='../js/fullcalendar/packages/timegrid/main.js'></script>
<script src='../js/fullcalendar/packages/list/main.js'></script>
<script src='../js/fullcalendar/packages/rrule/main.js'></script>


<!-- link href='../js/fullcalendar/packages/bootstrap/main.css'
	rel='stylesheet' /-->
<script src='../js/fullcalendar/packages-premium/timeline/main.js'></script>
<script
	src='../js/fullcalendar/packages-premium/resource-common/main.js'></script>
<script
	src='../js/fullcalendar/packages-premium/resource-timeline/main.js'></script>






<style>
html, body {
	margin: 0;
	padding: 0;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
		"Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji",
		"Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
	/*font-size: 0.70rem;*/
}

#calendar {
	max-width: 80%;
	max-height: 40%;
}
</style>

<style>
.label {
	display: inline-block;
	width: 200px;
	//
	or
	whatever
}
</style>


<div id='calendar'></div>

<!--Add event modal-->
<div id="createEventModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="createEventModalLabel">Create Task</h5>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="cmodalBody" class="modal-body">
				<form class="forms-sample" action="" method="post"
					id="createEventForm">
					<div class="form-group">
						<label for="task_name">Name</label> <input class="form-control"
							id="task_name" name="task_name" type="text"
							placeholder="Task Name" required="required">
					</div>
					<div class="form-group">
						<label for="task_desc">Description</label>
						<textarea class="form-control" id="task_desc" name="task_desc"
							rows="4" placeholder="Description"></textarea>
					</div>
					<div class="row col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="starts_at">Starts at</label> <input
									data-format="dd/MM/yyyy hh:mm:ss" type="date"
									class="form-control" name="starts_at" id="starts_at"
									placeholder="Starts at" required="required" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="ends_at">Ends at</label> <input type="date"
									class="form-control" name="ends_at" id="ends_at"
									placeholder="Ends at" required="required" />
							</div>
						</div>
					</div>

					<div class="row col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="station_id"> Station ID:</label> <select
									class="form-control" id="station_id" name="station_id"
									required="required">
									<option value="notset" selected="selected"></option>
                                <?php
                                require ('../config/db.php');
                                $query3 = "select * from stations";
                                $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result3)) {
                                    ?>
                                
                                <option
										value="<?php echo $row['station_id']; ?>"><?php echo $row['station_id']; ?></option>
                                
                                <?php }?>
                              </select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="assigned_to"> Assigned to:</label> <select
									class="form-control" id="assigned_to" name="assigned_to"
									required="required">
									<option value="notset" selected="selected"></option>
                                <?php
                                require ('../config/db.php');
                                $query3 = "select * from users";
                                $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result3)) {
                                    ?>
                                
                                <option
										value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
                                
                                <?php }?>
                              </select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Recurring Series</label> <select id="ddRecurring"
							name="ddRecurring" class="form-control">
							<option value="singleEvent">Single Task</option>
							<option value="firstmondayofmonth">First Monday of every month</option>
							<option value="firstdateofmonth">First date of every month</option>
							<option value="everyweekmonday">Every week Monday</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button type="submit" class="btn btn-primary" id="saveEvent">Save</button>
			</div>
		</div>
	</div>
</div>

<!--Edit event modal-->
<div id="editEventModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editEventModalLabel">Edit Task</h5>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="cmodalBody" class="modal-body">
				<form class="forms-sample" action="" method="post"
					id="editEventForm">
					<div class="form-group">
						<input class="form-control" id="task_id" name="task_id"
							type="hidden" placeholder="Task id">
					</div>

					<div class="form-group">
						<label for="task_name">Name</label> <input class="form-control"
							id="task_name" name="task_name" type="text"
							placeholder="Task Name" required="required"
							data-title="Please enter task name">
					</div>
					<div class="form-group">
						<label for="task_desc">Description</label>
						<textarea class="form-control" id="task_desc" name="task_desc"
							rows="4" placeholder="Description"></textarea>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="starts_at">Starts at</label> <input
									data-format="dd/MM/yyyy hh:mm:ss" type="date"
									class="form-control" name="starts_at" id="starts_at"
									placeholder="Starts at" required="required" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="ends_at">Ends at</label> <input type="date"
									class="form-control" name="ends_at" id="ends_at"
									placeholder="Ends at" required="required" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="station_id"> Station id:</label> <select
									class="form-control" id="station_id" name="station_id"
									required="required" data-title="Please enter station id">
									<option value="notset" selected="selected"></option>
                                <?php
                                require ('../config/db.php');
                                $query3 = "select * from stations";
                                $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result3)) {
                                    ?>
                                
                                <option
										value="<?php echo $row['station_id']; ?>"><?php echo $row['station_id']; ?></option>
                                
                                <?php }?>
                              </select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="assigned_to"> Assigned to:</label> <select
									class="form-control" id="assigned_to" name="assigned_to"
									required="required">
									<option value="notset" selected="selected"></option>
                                <?php
                                require ('../config/db.php');
                                $query3 = "select * from users";
                                $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result3)) {
                                    ?>
                                
                                <option
										value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
                                
                                <?php }?>
                              </select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<label class="checkbox-inline"> <input type="radio"
							name="eventEditingStyle" id="eventEditingStyle"
							value="thisEventOnly">Edit only this event
						</label> <label class="checkbox-inline" checked="checked"> <input type="radio"
							name="eventEditingStyle" id="eventEditingStyle"
							value="thisSeriesOnly">Edit this series
						</label> <input type="text" class="form-control" name="group_id"
							id="group_id" placeholder="Group id" required="required"
							hidden="true" />
					</div>
				</form>
			</div>
			<div class="modal-footer">

				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button type="submit" class="btn btn-primary" id="updateEvent">Save</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="altViewer-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="calendarModalLabel">Task Details</h5>

				<div>
				<button class="btn btn-primary btn-sm mr-1" type="button"
					id="edit-in-modal">Edit</button>
				<button class="btn btn-danger btn-sm mr-1" type="button"
					id="delete-in-modal">Delete</button>
				<button class="btn btn-info btn-sm mr-1 " type="button"
					data-dismiss="modal" aria-label="Close">
					<i class="fas fa-window-close"></i>
				</button>
				</div>

			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>


<?php include '../doc/footer.php'; ?>


<script>

$("#starts_at,#ends_at").flatpickr({
	enableTime: true,	
});


$(function() {
	  var availableTags = [
	    "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++",
	    "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran",
	    "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl",
	    "PHP", "Python", "Ruby", "Scala", "Scheme"];
	  
	  $("#form-autocomplete-2").autocomplete({
	    source: availableTags
	  });
	  $( "#form-autocomplete-2" ).autocomplete( "option", "appendTo", "#createEventModal" );


	  
	});

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
    	plugins: [ 'interaction', 'dayGrid', 'timeGrid','list','moment','bootstrap','rrule'],
       //themeSystem: 'materia',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek,listMonth'
        	//right: 'dayGridMonth,timeGridWeek,timeGridDay,listDay,listWeek,listMonth'
      },
      //defaultDate: '2019-11-02',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      unselectAuto:false, 
      views: {            	
      	dayGridMonth: { buttonText: 'Monthly Tasks' },
      	timeGridWeek: { buttonText: 'Weekly Tasks' },
      	//timeGridDay: { buttonText: 'Daily Tasks' },
          //listDay: { buttonText: 'List day' },
          listWeek: { buttonText: 'List week' },
          listMonth: { buttonText: 'List month' }
        },
        select: function(info) {
            console.log(info);           
            console.log(new Date(info.start).toString());
              
            $("#starts_at").flatpickr({
                defaultDate:info.start.toISOString(),
            	enableTime:true
            });
            $("#ends_at").flatpickr({
                defaultDate:info.end.toISOString(),
                enableTime:true
            });

           
            	             
            $('#createEventModal').modal('show'); 
            console.log('modal :'+ $('form#createEventForm').serialize());	
            $('#saveEvent').on('click', function(e){
            	//e.preventDefault(); 	            	
                $('#saveEvent').unbind('click');
                            
              $.ajax({
      			type: "POST",
      			url: "./create",				
      			data: $('form#createEventForm').serialize(),
      			success: function(res){
      			console.log("created task."+res);	
      			calendar.refetchEvents();  	
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
            
  				 $('#createEventModal').modal('hide');
  				 $("form#createEventForm").trigger("reset");  					                   
        		                          	
            });

            calendar.unselect();         
          },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      eventClick: function(info) {  
    	 	info.jsEvent.preventDefault();     
    	 	console.log(info.event);      	 	           

    	 	   	  
    	 	 var data = "<form name='altDeletor-form' role='form'>";
				
            var taskob;
             $.ajax({
					type:"POST",
					async:false,
					url:"./get_task",
					data:{'id':info.event.id},
					success:function(resp){
						//console.log("response "+ resp);
						taskob = resp;
						///console.log("ttassk "+ task);
					}	
       	 	});

             var task = $.parseJSON (taskob)[0];

             if(info.event.end ==null) info.event.end = info.event.start;
                                              
   			data += 	"<div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='Task_Name'><b>Task Name:&nbsp</b></label>"+                       
     		"<div class='wrapper'><input  type='hidden'  id='Task_Name' name='Task_Name' placeholder='Task Name' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ task.title +"'></input><span>"+ task.title +"</span></div></div>";
     		data += 	"<div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='Task_Desc'><b>Task Description:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='Task_Desc' name='Task_Desc' placeholder='Task Description' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ "Hello33" +"'></input>"+ "Hello" +"</div>";
     		
     		data += 	"<div class='row'><div class='col-sm-6'><div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='Starts_at'><b>Starts at:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='Starts_at' name='Starts_at' placeholder='Starts at' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ task.start +"'></input>"+  task.start +"</div></div>";
     		data += 	"<div class='col-sm-6'><div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='Ends_at'><b>Ends at:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='Ends_at' name='Ends_at' placeholder='Ends at' "+"style='overflow:hidden'  class='form-control'"+ 
     		
     		"value='"+  task.end +"'></input>"+  task.end +"</div></div></div>";

     		data += 	"<div class='row'><div class='col-sm-6'><div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='station_id'><b>Station id:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='station_id' name='station_id' placeholder='Station id' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ task.station_id +"'></input>"+ task.station_id +"</div></div>";
     		/*data += 	"<div class='col-sm-6'><div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='sroject_id'><b>Project id:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='project_id' name='project_id' placeholder='Project' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ task.project_id +"'></input>"+ task.project_id +"</div></div></div>";*/
     		
     		data += 	"<div class='col-sm-6'><div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='Status_task'><b>Status:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='Status_task' name='Status_task' placeholder='Status' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ task.status +"'></input>"+ task.status +"</div></div></div>";                    		
     		data += 	"<div class='row'><div class='col-sm-6'><div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='assigned_to'><b>Assigned to:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='assigned_to' name='assigned_to' placeholder='Assigned to' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ task.assigned_to +"'></input>"+ task.assigned_to +"</div</div></div></div></div></form>";
     		
     		/*data += 	"<div class='row'><div class='col-sm-6'><div style='margin-left: initial;margin-right: initial;' class='form-group row'> <label for='checklist_id'><b>Check List id:&nbsp</b></label>"+                       
     		"<input  type='hidden'  id='checklist_id' name='checklist_id' placeholder='Check List' "+"style='overflow:hidden'  class='form-control'"+ 
     		"value='"+ task.checklist_id +"'></input>"+ task.checklist_id+"</div></div></div></form>";*/
     		
      	 			

                            //date += "</form>";

                              
                             var selector = $('#altViewer-modal');
                             var select2or = this.modal_selector;
                             console.log('data:'+select2or);
                             
                             $(selector).on('show.bs.modal', function () { 
                                             				
                                 var btns = '<div class="dt-buttons btn-group flex-wrap"><button class="btn btn-secondary" id="edit-in-modal" type="button" aria-label="Edit"><i class="fa fa-edit">Edit</i></button>' +
                                     '<button class="btn btn-secondary" id="delete-in-modal" type="button" aria-label="Delete"> <i class="fa fa-trash">Delete</i> </button>'+
                                     '<button class="btn btn-secondary" type="button" data-dismiss="modal" aria-label="Close"> <i class="fa fa-window-close">Close</i> </button></div>';
                                 $(selector).find('.modal-title').html("Task Details");                                
                          	 	
                                 $(selector).find('.modal-body').html(data);
                                // $(selector).find('.modal-header').html(btns);
                             });

                                                       
                             $(selector).modal('show');                           
                             $(selector).trigger("alteditor:some_dialog_opened").trigger("alteditor:delete_dialog_opened");

                              //edit modal open on button click
                             $("#edit-in-modal").on('click', function(e){  
                            	 //e.preventDefault(); 
                            	
                            	 var editor = $('#editEventModal');
                            	 
                            	 $(editor).find("#starts_at").flatpickr({
                                    defaultDate:task.start,
                                 	enableTime:true,
                                 	//dateFormat:'Y-m-d H:i:s'
                                 });
                            	 $(editor).find("#ends_at").flatpickr({
                                     defaultDate:task.end,
                                     enableTime:true,
                                     //dateFormat:'Y-m-d H:i:s'
                                 });
                            	console.log(task);
                            	/* if(info.event.end==null){                            		                             	 
                                	 $(editor).find(".modal-body #ends_at").val(dt_start);
                            	 }else{
                            		 dts = info.event.end.toISOString();
                                	 dt_end = moment(dts).format("YYYY-MM-DD HH:mm");   
                            		 $(editor).find(".modal-body #ends_at").val(dt_end);
                            	 }*/
                            	 
                            	 $(editor).find(".modal-body #starts_at").val(task.start);
                            	 $(editor).find(".modal-body #ends_at").val(task.end);
                            	 
                            	$(editor).find(".modal-body #task_id").val(info.event.id);
                              	$(editor).find(".modal-body #task_name").val(info.event.title);
                             	$(editor).find(".modal-body #task_desc").val(task.description);
                             	$(editor).find(".modal-body #station_id").val(task.station_id);
                             	$(editor).find(".modal-body #assigned_to").val(task.assigned_to);
                             	$(editor).find(".modal-body #checklist_id").val(task.checklist_id);
                             	$(editor).find(".modal-body #project_id").val(task.project_id);
                             	$(editor).find(".modal-body #group_id").val(task.group_id);
                             	//$(editor).find(".modal-body #eventEditingStyle").val();
                             	
                             	$('#altViewer-modal').modal('hide');
                             	$('#edit-in-modal').unbind('click');
                             	                             	 
                            	$(editor).modal('show');                             	

                   	         	//on Save button click
                            	 $('#updateEvent').on('click', function(e){
                                 	//e.preventDefault();
                                 	 $('#updateEvent').unbind('click');
                                 	
                                   $.ajax({
                           			type: "POST",
                           			url: "./edit",				
                           			data: $('form#editEventForm').serialize(),
                           			success: function(res){
                           			calendar.refetchEvents();                                    
                           			console.log("created task."+res);                           			                          			
                                    
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
                                    
                                   $("form#editEventForm").trigger("reset"); 
                                   $('#editEventModal').modal('hide');                                           
                             		                          	
                                 });
                            	 
                             });                  
        
          //delete modal
          $("#delete-in-modal").on('click', function(e){             
              console.log("added to root"+info.event.id);

              $('#delete-in-modal').unbind('click');

              swal("Want to delete?", {
            	  buttons:{
                	  delAll : "Delete all tasks in this series",
                	  delSingle:"Delete only this task"
            	  }
            	})
            	.then((value) => {               	
            		 
            		 $.ajax({
		                 type:'POST',
		                 url:'./delete',
		                 data:{'del_id':info.event.id,'deleteAction':value},
		                 success: function(res){
		                	 		$('#altViewer-modal').modal('hide');				                 
		                	 		calendar.refetchEvents();               	 				                	 				                	 	     								     					
			     				
		                  }

		                 });
	                 
            	});
          	
           /*   
          	swal({
      		  title: "Are you sure?",
      		  text: "You can't retrieve data once deleted!",
      		  icon: "warning",
      		  buttons: true,
      		  dangerMode: true,
      		})
      		.then((willDelete) => {
      		  if (willDelete) {
      			   $.ajax({
		                 type:'POST',
		                 url:'./delete',
		                 data:{'del_id':info.event.id},
		                 success: function(res){
		                	 		$('#altViewer-modal').modal('hide');				                 
		                	 		calendar.refetchEvents();               	 				                	 				                	 	     								     					
			     				
		                  }

		                 });
      		  } 
      		});*/
              
          });          
          
    	}, 
    	 eventRender: function(info) {             
             /*var tooltip = new Tooltip(info.el, {
                 title: info.event.extendedProps.title,
                 placement: 'top',
                 trigger: 'hover',
                 container: 'body'
               });*/			
            	 //console.log("info:");
            	// console.log(info);
             },
      events:[ ],            	             
      eventSources:[{
          url:'./query_tasks',
          //color: 'yellow',
          textColor: 'black',
       	  startEditable:false
          
      }]

             //end of calendar   
     });

    calendar.render(); 
    
  });



 </script>



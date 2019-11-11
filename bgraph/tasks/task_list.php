<?php include '../doc/header.php'; ?>





<!--  script src='../js/fullcalendar/packages/moment/main.js'></script-->
<script src='../js/fullcalendar/packages/core/main.js'></script>

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


<!-- link href='../js/fullcalendar/packages/bootstrap/main.css'
	rel='stylesheet' /-->




<script src='../js/fullcalendar/packages/interaction/main.js'></script>
<script src='../js/fullcalendar/packages/daygrid/main.js'></script>
<script src='../js/fullcalendar/packages/timegrid/main.js'></script>
<script src='../js/fullcalendar/packages-premium/timeline/main.js'></script>
<script
	src='../js/fullcalendar/packages-premium/resource-common/main.js'></script>
<script
	src='../js/fullcalendar/packages-premium/resource-timeline/main.js'></script>
<script src='../js/fullcalendar/packages/list/main.js'></script>





<style>
html, body {
	margin: 0;
	padding: 0;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
		"Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji",
		"Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
	font-size: 0.70rem;
}

#calendar {
	max-width: 80%;
	max-height: 60%;
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
							placeholder="Task Name">
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
									placeholder="Starts at" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="ends_at">Ends at</label> <input type="date"
									class="form-control" name="ends_at" id="ends_at"
									placeholder="Ends at" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="station_id"> Station id:</label> <select
									class="form-control" id="station_id" name="station_id">
									<option value="notset" selected="selected">NotSet</option>
                                <?php
                                require ('../config/db.php');
                                $query3 = "select * from roles";
                                $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result3)) {
                                    ?>
                                
                                <option
										value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                
                                <?php }?>
                              </select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="assigned_to"> Assigned to:</label> <select
									class="form-control" id="assigned_to" name="assigned_to">
									<option value="notset" selected="selected">NotSet</option>
                                <?php
                                require ('../config/db.php');
                                $query3 = "select * from roles";
                                $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_array($result3)) {
                                    ?>
                                
                                <option
										value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                
                                <?php }?>
                              </select>
							</div>
						</div>
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


<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog"
	aria-labelledby="calendarModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="calendarModalLabel">Task Details</h5>
				<div>					
					<a href="./edit" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit">Edit</i></a>
					<button class="btn btn-primary btn-sm" id="delete-in-modal" type="button"
						aria-label="Delete">
						<i class="fa fa-trash">Delete</i>
					</button>
					<button class="btn btn-primary btn-sm" type="button" data-dismiss="modal"
						aria-label="Close">
						<i class="fa fa-window-close">Close</i>
					</button>									
					
				</div>

			</div>
			<div class="modal-body" id="calendarModalBody">...</div>
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



/*
 var eventObject = {
		    title: title,
		    start: start,
		    end: end,
		    id: id,
		    color: colour
		    };
*/
 
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
    	plugins: [ 'interaction', 'dayGrid', 'timeGrid','list','moment','bootstrap'],
       //themeSystem: 'materia',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek,listMonth'
        	//right: 'dayGridMonth,timeGridWeek,timeGridDay,listDay,listWeek,listMonth'
      },
      defaultDate: '2019-11-02',
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
            	var title = $(".modal-body #task_name").val();
            	var desc = $(".modal-body #task_desc").val();
            	var start = $(".modal-body #starts_at").val();
            	var end = $(".modal-body #ends_at").val();
            	var assigned = $(".modal-body #assigned_to").val();
            	var station = $(".modal-body #station_id").val();            	            	
            	if (title) {            	
                calendar.addEvent({
                  title: title,
                  start: info.start,
                  end: info.end, 
                  allDay:info.allDay         
                })
              }
              $('#saveEvent').unbind('click');
              
              $.ajax({
      			type: "POST",
      			url: "./create",				
      			data: $('form#createEventForm').serialize(),
      			success: function(res){
      				if(res.indexOf('created') >-1){
      					swal({
      						  title: "Success",
      						  text: res,
      						  icon: "success",
      						});
      				}else
      				{
      					swal({
      						  title: "Failed",
      						  text: res,
      						  icon: "error",
      						});
      				}			
                     
      			},
      			error: function(resp){
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
    	 	//console.log(info);        	                            
    	  $('#calendarModalTitle').html(info.event.title);
          $('#calendarModalBody').html(info.event.title);
          $('#calendarModal').modal();

          //delete modal
          $("#delete-in-modal").on('click', function(e){             
              console.log("added to root"+info.event.id);
              
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
		                	 		$('#calendarModal').modal('hide');				                 
		                	 		calendar.refetchEvents();		                	 				                	 				                	 	     								     					
			     					if(res.indexOf('deleted') >-1){
			     						swal({
				     						  title: "Success",
				     						  text: res,
				     						  icon: "success",
				     						});
			     					}else
			     					{
			     						swal({
				     						  title: "Failed",
				     						  text: res,
				     						  icon: "error",
				     						});
			     					}
		                  }

		                 });
      		  } 
      		});
              
          });          
          
    	}, 
      events: [],
      eventSources:[{
          url:'./query_tasks',
          //color: 'yellow',
          textColor: 'black'
          
      }]
        
    });

    calendar.render();    

    
  });



 </script>




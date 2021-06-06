<div class="row">
	<div class="space-6"></div>
	<div class="col-sm-5 infobox-container">
		<div class="infobox infobox-green">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-users"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(id) as total from tbguru where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Guru</a></div>
			</div>
		</div>

		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-users"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(id) as total from mssiswa where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Siswa</a></div>
			</div>
		</div>

		<div class="infobox infobox-pink">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-users"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(id_pengawas) as total from tbpengawas where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Karyawan</a></div>
			</div>
		</div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-users"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(IDRKP) as total from rkpaktvsiswa where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Lulusan</a></div>
			</div>
		</div>

		<div class="infobox infobox-orange2">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-calendar"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(id) as total from tbjadwal where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Jadwal Aktif</a></div>
			</div>
		</div>

		<div class="infobox infobox-brown">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-book"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(id_krs) as total from tbkrs where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Kurikulum</a></div>
			</div>
		</div>
		<div class="infobox infobox-blue2">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-book"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(ID) as total from trmka where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Mata ajar Aktif</a></div>
			</div>
		</div>
		<div class="infobox infobox-blue2">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-home"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(ID) as total from msruang where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Ruangan</a></div>
			</div>
		</div>
		<div class="infobox infobox-blue2">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-calendar"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(id) as total from tbjadwal where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Jadwal Aktif</a></div>
			</div>
		</div>
		<div class="infobox infobox-blue2">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-calendar"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(id) as total from tbjadwal where isdeleted != 1')->result_array();
																echo $guru[0]['total']; ?></a></span>
				<div class="infobox-content"><a href="#">Jumlah Jadwal Aktif</a></div>
			</div>
		</div>
	</div>
	<div class="col-sm-7 infobox-container">
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5 class="widget-title">
					<i class="ace-icon fa fa-signal"></i>
					Jumlah Siswa
				</h5>
			</div>

			<div class="widget-body">
				<div class="widget-main">
					<div id="piechart-placeholder"></div>

					<div class="hr hr8 hr-double"></div>

					<div class="clearfix">

						<div class="grid2">
							<div class="infobox infobox-red">
								<div class="infobox-chart">
									<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
								</div>
								<div class="infobox-data">
									<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query(
																						'select count(NMSISWA) as total from mssiswa where PS = 01 or PS = 02 or PS = 03 or PS = 04
									 or PS = 05 or PS = 06 or PS = 07 or PS = 08 or PS = 09
									 or PS = 10 or PS = 11 or PS = 12
									 or PS = 13 or PS = 14 or PS = 15
									 or PS = 16 or PS = 17'
																					)->result_array();
																					echo $guru[0]['total']; ?></a></span>
									<div class="infobox-content"><a href="#">TK</a></div>
								</div>
							</div>
						</div>

						<div class="grid2">
							<div class="infobox infobox-green">
								<div class="infobox-chart">
									<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
								</div>
								<div class="infobox-data">
									<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 18 or PS = 19 or PS = 20')->result_array();
																					echo $guru[0]['total']; ?></a></span>
									<div class="infobox-content"><a href="#">SD</a></div>
								</div>
							</div>
						</div>

						<div class="grid2">
							<div class="infobox infobox-blue">
								<div class="infobox-chart">
									<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
								</div>
								<div class="infobox-data">
									<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 21')->result_array();
																					echo $guru[0]['total']; ?></a></span>
									<div class="infobox-content"><a href="#">SMP</a></div>
								</div>
							</div>
						</div>

						<div class="grid2">
							<div class="infobox infobox-purple">
								<div class="infobox-chart">
									<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
								</div>
								<div class="infobox-data">
									<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 22 or PS = 23')->result_array();
																					echo $guru[0]['total']; ?></a></span>
									<div class="infobox-content"><a href="#">SMA</a></div>
								</div>
							</div>
						</div>

						<div class="grid2">
							<div class="infobox infobox-pink">
								<div class="infobox-chart">
									<span class="sparkline" data-values="196,111,111,177,154,94,111,111,111"></span>
								</div>
								<div class="infobox-data">
									<span class="infobox-data-number"><a href="#"><?php $guru = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 26 or PS = 27')->result_array();
																					echo $guru[0]['total']; ?></a></span>
									<div class="infobox-content"><a href="#">QUBA</a></div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.widget-main -->
			</div><!-- /.widget-body -->
		</div><!-- /.widget-box -->
	</div><!-- /.col -->
</div><!-- /.row -->
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-sm-12">
				<div class="space"></div>
				<div id="calendar"></div>
			</div>
		</div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
<script type="text/javascript">
	jQuery(function($) {
		$('.easy-pie-chart.percentage').each(function() {
			var $box = $(this).closest('.infobox');
			var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
			var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
			var size = parseInt($(this).data('size')) || 50;
			$(this).easyPieChart({
				barColor: barColor,
				trackColor: trackColor,
				scaleColor: false,
				lineCap: 'butt',
				lineWidth: parseInt(size / 10),
				animate: ace.vars['old_ie'] ? false : 1000,
				size: size
			});
		})

		$('.sparkline').each(function() {
			var $box = $(this).closest('.infobox');
			var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
			$(this).sparkline('html', {
				tagValuesAttribute: 'data-values',
				type: 'bar',
				barColor: barColor,
				chartRangeMin: $(this).data('min') || 0
			});
		});


		//flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
		//but sometimes it brings up errors with normal resize event handlers
		$.resize.throttleWindow = false;

		var placeholder = $('#piechart-placeholder').css({
			'width': '90%',
			'min-height': '150px'
		});
		var data = [{
				label: "TK",
				data: <?php $tbakadmk = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 01 or PS = 02 or PS = 03 or PS = 04
									 or PS = 05 or PS = 06 or PS = 07 or PS = 08 or PS = 09
									 or PS = 10 or PS = 11 or PS = 12
									 or PS = 13 or PS = 14 or PS = 15
									 or PS = 16 or PS = 17')->result_array();
						echo $tbakadmk[0]['total']; ?>,
				color: "red"
			},
			{
				label: "SD",
				data: <?php $tbakadmk2 = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 18 or PS = 19 or PS = 20')->result_array();
						echo $tbakadmk2[0]['total']; ?>,
				color: "green"
			},
			{
				label: "SMP",
				data: <?php $tbakadmk3 = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 21')->result_array();
						echo $tbakadmk3[0]['total']; ?>,
				color: "blue"
			},
			{
				label: "SMA",
				data: <?php $tbakadmk3 = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 22 or PS = 23')->result_array();
						echo $tbakadmk3[0]['total']; ?>,
				color: "purple"
			},
			{
				label: "QUBA",
				data: <?php $tbakadmk3 = $this->db->query('select count(NMSISWA) as total from mssiswa where PS = 26 or PS = 27')->result_array();
						echo $tbakadmk3[0]['total']; ?>,
				color: "pink"
			},
		]

		function drawPieChart(placeholder, data, position) {
			$.plot(placeholder, data, {
				series: {
					pie: {
						show: true,
						tilt: 1,
						highlight: {
							opacity: 0.25
						},
						stroke: {
							color: '#fff',
							width: 3
						},
						startAngle: 3
					}
				},
				legend: {
					show: true,
					position: position || "ne",
					labelBoxBorderColor: null,
					margin: [-30, 15]
				},
				grid: {
					hoverable: true,
					clickable: true
				}
			})
		}
		drawPieChart(placeholder, data);

		/**
		we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
		so that's not needed actually.
		*/
		placeholder.data('chart', data);
		placeholder.data('draw', drawPieChart);


		//pie chart tooltip example
		var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
		var previousPoint = null;

		placeholder.on('plothover', function(event, pos, item) {
			if (item) {
				if (previousPoint != item.seriesIndex) {
					previousPoint = item.seriesIndex;
					var tip = item.series['label'] + " : " + item.series['percent'] + '%';
					$tooltip.show().children(0).text(tip);
				}
				$tooltip.css({
					top: pos.pageY + 10,
					left: pos.pageX + 10
				});
			} else {
				$tooltip.hide();
				previousPoint = null;
			}

		});

	})

	//calendar

	jQuery(function($) {

		/* initialize the external events
			-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true, // will cause the event to go back to its
				revertDuration: 0 //  original position after the drag
			});

		});




		/* initialize the calendar
		-----------------------------------------------------------------*/

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();


		var calendar = $('#calendar').fullCalendar({
			//isRTL: true,
			//firstDay: 1,// >> change first day of week 

			buttonHtml: {
				prev: '<i class="ace-icon fa fa-chevron-left"></i>',
				next: '<i class="ace-icon fa fa-chevron-right"></i>'
			},

			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			events: <?php echo json_encode($calendar); ?>,
			
			// [{
			// 		title: 'All Day Event',
			// 		start: new Date(y, m, 1),
			// 		className: 'label-important'
			// 	},
			// 	{
			// 		title: 'Long Event',
			// 		start: moment().subtract(5, 'days').format('YYYY-MM-DD'),
			// 		end: moment().subtract(1, 'days').format('YYYY-MM-DD'),
			// 		className: 'label-success'
			// 	},
			// 	{
			// 		title: 'Some Event',
			// 		start: new Date(y, m, d - 3, 16, 0),
			// 		allDay: false,
			// 		className: 'label-info'
			// 	}
			// ],

			/**eventResize: function(event, delta, revertFunc) {

				alert(event.title + " end is now " + event.end.format());

				if (!confirm("is this okay?")) {
					revertFunc();
				}

			},*/

			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				var $extraEventClass = $(this).attr('data-class');


				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = false;
				if ($extraEventClass) copiedEventObject['className'] = [$extraEventClass];

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {

				bootbox.prompt("New Event Title:", function(title) {
					if (title !== null) {
						calendar.fullCalendar('renderEvent', {
								title: title,
								start: start,
								end: end,
								allDay: allDay,
								className: 'label-info'
							},
							true // make the event "stick"
						);
					}
				});


				calendar.fullCalendar('unselect');
			},
			eventClick: function(calEvent, jsEvent, view) {

				//display a modal
				var modal =
					'<div class="modal fade">\
			  <div class="modal-dialog">\
			   <div class="modal-content">\
				 <div class="modal-body">\
				   <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
				   <form class="no-margin">\
					  <label>Change event name &nbsp;</label>\
					  <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
					 <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
				   </form>\
				 </div>\
				 <div class="modal-footer">\
					<button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
					<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
				 </div>\
			  </div>\
			 </div>\
			</div>';


				var modal = $(modal).appendTo('body');
				// modal.find('form').on('submit', function(ev) {
				// 	ev.preventDefault();

				// 	calEvent.title = $(this).find("input[type=text]").val();
				// 	calendar.fullCalendar('updateEvent', calEvent);
				// 	modal.modal("hide");
				// });
				// modal.find('button[data-action=delete]').on('click', function() {
				// 	calendar.fullCalendar('removeEvents', function(ev) {
				// 		return (ev._id == calEvent._id);
				// 	})
				// 	modal.modal("hide");
				// });

				// modal.modal('show').on('hidden', function() {
				// 	modal.remove();
				// });


				//console.log(calEvent.id);
				//console.log(jsEvent);
				//console.log(view);

				// change the border color just for fun
				//$(this).css('border-color', 'red');

			}

		});


	})
</script>

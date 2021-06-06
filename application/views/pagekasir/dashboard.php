<!-- <div class="hr hr32 hr-dotted"></div> -->
<div class="row">
	<form class="form-horizontal" role="form" id="formSearch" action="<?= base_url() ?>modulkasir/dashboard" method="POST">
		<div class="col-xs-3">
			<select class="form-control" name="ta" id="ta">
				<option value=<?= $tahun ?>>-- Pilih Tahun --</option>
				<?php foreach ($tahun_akademik as $value) { ?>
					<option value=<?= $value['TAHUN'] ?>><?= $value['TAHUN'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-xs-1">
			<button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
				<a class="ace-icon fa fa-search bigger-120"></a>Periksa
			</button>
		</div>
		<br>
		<br>
	</form>
</div>
<hr>
<div class="col-md-11">
	<canvas id="lineChart"></canvas>
</div>
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
<script>
	//line
	var ctxL = document.getElementById("lineChart").getContext('2d');
	var myLineChart = new Chart(ctxL, {
		type: 'line',
		data: {
			labels: <?php echo json_encode($bulan) ?>,
			datasets: [{
					label: "SPP",
					data: <?php echo json_encode($spp) ?>,
					backgroundColor: [
						'rgba(105, 0, 132, .2)',
					],
					borderColor: [
						'rgba(200, 99, 132, .7)',
					],
					borderWidth: 2
				},
				{
					label: "Seragam",
					data: <?php echo json_encode($srg) ?>,
					backgroundColor: [
						'rgba(240, 255, 240, .2)',
					],
					borderColor: [
						'rgba(249, 0, 255, .7)',
					],
					borderWidth: 2
				},
				{
					label: "Gedung",
					data: <?php echo json_encode($gdg) ?>,
					backgroundColor: [
						'rgba(127, 255, 1, .2)',
					],
					borderColor: [
						'rgba(27, 128, 1, .7)',
					],
					borderWidth: 2
				},
				{
					label: "Kegiatan",
					data: <?php echo json_encode($kgt) ?>,
					backgroundColor: [
						'rgba(222, 184, 135, .2)',
					],
					borderColor: [
						'rgba(75, 0, 130, .7)',
					],
					borderWidth: 2
				},
				{
					label: "Lain-Lain",
					data: <?php echo json_encode($lain) ?>,
					backgroundColor: [
						'rgba(0, 255, 254, .2)',
					],
					borderColor: [
						'rgba(115, 255, 216, .7)',
					],
					borderWidth: 2
				}
			]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Pemasukan Tahun Keuangan '+<?php echo "'".$th_akdmk."'"; ?>
			},
			scales: {
				// xAxes: [{
					// type: 'logarithmic',
					// position: 'bottom',
				// 	ticks: {
				// 		userCallback: function(tick) {
				// 			var remain = tick / (Math.pow(10, Math.floor(Chart.helpers.log10(tick))));
				// 			if (remain === 1 || remain === 2 || remain === 5) {
				// 				return tick.toString() + 'Hz';
				// 			}
				// 			return '';
				// 		},
				// 	},
				// 	scaleLabel: {
				// 		labelString: 'Frequency',
				// 		display: true,
				// 	}
				// }],
				yAxes: [{
					type: 'linear',
					ticks: {
						userCallback: function(tick) {
							// return tick.toString() + 'dB';
							return formatRupiah3(tick.toString(), 'Rp. ');
						}
					},
					scaleLabel: {
						labelString: 'Jumlah Pemasukan',
						display: true
					}
				}]
			}
		}
	});

	//Sample
	//https://mdbootstrap.com/docs/jquery/javascript/charts/



function formatRupiah3(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah3 = split[0].substr(0, sisa),
        ribuan3 = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan3) {
        separator = sisa ? '.' : '';
        rupiah3 += separator + ribuan3.join('.');
    }

    rupiah3 = split[1] != undefined ? rupiah3 + ',' + split[1] : rupiah3;
    return prefix == undefined ? rupiah3 : (rupiah3 ? 'Rp. ' + rupiah3 : '');
}

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

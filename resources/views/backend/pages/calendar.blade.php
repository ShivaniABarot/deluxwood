@extends(backendView('layouts.app'))

@section('title', 'Calendar')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom">
				<h3 class="fw-bold mb-0">Calendar</h3>
				<div class="col-auto d-flex">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addevent"><i class="icofont-plus-circle me-2 fs-6"></i>Add Event</button>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		<div class="col-lg-12 col-md-12 ">
			<!-- card: Calendar -->
			<div class="card">
				<div class="card-body" id='my_calendar'></div>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						var calendarEl = document.getElementById('my_calendar');

						var calendar = new FullCalendar.Calendar(calendarEl, {
							timeZone: 'UTC',
							initialView: 'dayGridMonth',
							events: 'https://fullcalendar.io/demo-events.json',
							editable: true,
							selectable: true
						});

						calendar.render();
					});
				</script>
			</div>
		</div>
	</div><!-- Row End -->
</div>
@endsection

@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/fullcalendar/main.min.css') !!}">
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Plugin Js-->
<script src="{!! backendAssets('dist/assets/plugin/fullcalendar/main.min.js') !!}"></script>
@endpush

@push('custom_scripts')
@endpush

@push('modals')
<!-- Add Event-->
<div class="modal fade" id="addevent" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title  fw-bold" id="eventaddLabel">Add Event</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<label for="exampleFormControlInput99" class="form-label">Event Name</label>
					<input type="text" class="form-control" id="exampleFormControlInput99">
				</div>
				<div class="mb-3">
					<label for="formFileMultipleone" class="form-label">Event Images</label>
					<input class="form-control" type="file" id="formFileMultipleone">
				</div>
				<div class="deadline-form">
					<form>
						<div class="row g-3 mb-3">
							<div class="col">
								<label for="datepickerded" class="form-label">Event Start Date</label>
								<input type="date" class="form-control w-100" id="datepickerded">
							</div>
							<div class="col">
								<label for="datepickerdedone" class="form-label">Event End Date</label>
								<input type="date" class="form-control w-100" id="datepickerdedone">
							</div>
						</div>
					</form>
				</div>
				<div class="mb-3">
					<label for="exampleFormControlTextarea78" class="form-label">Event Description (optional)</label>
					<textarea class="form-control" id="exampleFormControlTextarea78" rows="3" placeholder="Add any extra details about the request"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
				<button type="button" class="btn btn-primary">Create</button>
			</div>
		</div>
	</div>
</div>
@endpush
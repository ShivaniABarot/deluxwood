@extends(backendView('layouts.app'))

@section('title', 'SpecBook Pdf Edit')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">SpecBook Pdf Edit</h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/specbook-pdf')}}">SpecBook Pdf</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit SpecBook Pdf</li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				
				<div class="card-body">
					<form action='{{url("admin/specbook-pdf/update/$specbook->specbook_pdf_id")}}' method="POST" id="customergroupForm" enctype="multipart/form-data" onsubmit="return validateForm()">
					@method('PATCH')
                            @csrf
						<div class="row g-3 align-items-center">
						    <div class="col-md-6">
						        <label class="form-label">PDF <span class="text-danger">*</span></label>
						        <input type="file" class="form-control" name="pdf"  accept=".pdf" id="pdfInput" onchange="updatePdfName()">
						        <span class="text-danger kt-form__help error pdf"></span>
						    </div>
						</div>
						<div class="row g-3 align-items-center">
						    <div class="col-md-2">
						    </div>
						    <div class="col-md-5">
						        <span id="pdfNameDisplay" class="text-center">{{ $specbook->pdf }}</span>
						    </div>
						</div>
						<button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div><!-- Row End -->
</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script> 
<script>
    function updatePdfName() {
        const pdfInput = document.getElementById('pdfInput');
        const pdfNameDisplay = document.getElementById('pdfNameDisplay');
        
        if (pdfInput.files.length > 0) {
            pdfNameDisplay.style.display = 'none'; // Hide the PDF name
        } else {
            pdfNameDisplay.style.display = 'inline'; // Show the PDF name
        }
    }
</script>

@endpush

@push('modals')
@endpush
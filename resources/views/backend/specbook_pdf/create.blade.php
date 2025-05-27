@extends(backendView('layouts.app'))
@section('title', 'SpecBook Pdf Add')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">SpecBook Pdf Add</h3>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('admin/specbook-pdf')}}">SpecBook Pdf</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add SpecBook Pdf</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12">
         <div class="card mb-3">
            <div class="card-body">
               <form action="{{ url('admin/specbook-pdf/store') }}" method="POST" id="customergroupForm" enctype="multipart/form-data">
                  @csrf
                  <div class="row g-3 align-items-center">
                     <div class="col-md-6">
                        <label class="form-label">PDF <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="pdfInput" name="pdf" accept=".pdf" onclick="pdfClicked()">
                        <span class="text-danger pdf_error"></span>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Row End -->
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
<script type="text/javascript">
   function validateForm() {
       var isValid = true;
       var pdf = $('#pdfInput');
   
       if (pdf[0].files.length === 0) {
           isValid = false;
           $('.pdf_error').html("Please Select PDF");
       } else {
           $('.pdf_error').empty();
       }
   
       return isValid;
   }
   
   $('form').on('submit', validateForm);
   
   function pdfClicked() {
       $('.pdf_error').empty();
   }
</script>
@endpush
@push('modals')
@endpush
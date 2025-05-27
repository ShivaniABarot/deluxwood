@extends(backendView('layouts.app'))
@section('title', 'Customers')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">Customers Approvals</h3>
            <!-- <div class="col-auto d-flex w-sm-100">
               <a href="{{url('admin/customer-create')}}" class="btn btn-primary btn-set-task w-sm-100" ><i class="icofont-plus-circle me-2 fs-6"></i>Add Customers</a>
            </div> -->
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="flash-message-container">
                         @if(session('success'))
                             <div class="flash-message">{{ session('success') }}</div>
                         @endif
                         @if (session('error'))
                         <div class="flash-message-error">{{ session('error') }}</div>
                         @endif
                     </div>
   <div class="row clearfix g-3">
      <div class="col-sm-12">
         <div class="card mb-3">
            <div class="card-body">
               <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Company Name</th>
                        <th>Email </th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($customer_details as $customer)
                     <tr>
                        <td>{{$customer->customer_id}}</td>
                        <td><a  href="{{url('admin\customer-approval-view')}}\{{$customer->customer_id}}">
                           {{$customer->company_name}}
                        </td>
                        <td>
                           {{$customer->email}}
                        </td>
                        <td>{{$customer->contact_number}}</td>
                        <td>
                           @if($customer->reg_status == "Approved")
                           <span class="badge bg-success">Approved</span>
                           @elseif($customer->reg_status == "Pending")
                           <span class="badge bg-warning">Pending</span>
                           @else
                           <span class="badge bg-danger">Rejected</span>
                           @endif
                        </td>
                        <td>
                           <div class="btn-group" role="group" aria-label="Basic outlined example">
                              <a type="button" class="btn btn-outline-secondary" href="{{url('admin\customer-approval-view')}}\{{$customer->customer_id}}" ><i class="icofont-eye text-warning"></i></a>
                              
                              @if(is_null($customer->tax_group))
                              <a type="button" class="btn btn-outline-secondary" href="javascript:void(0)" class="btn btn-info" onclick="taxgroup('{{$customer->customer_id}}');">
                              <i class="icofont-ui-check text-success"></i>
                              </a>
                              @elseif($customer->reg_status == 'Pending' || $customer->reg_status == 'Rejected')
                              <a type="button" class="btn btn-outline-secondary" href="javascript:void(0)" class="btn btn-info" onclick="approve('{{$customer->customer_id}}');">
                              <i class="icofont-ui-check text-success"></i>
                              </a>
                              @endif

                              @if($customer->reg_status == 'Pending' || $customer->reg_status == 'Approved')
                              <a href="javascript:void(0)" onclick="reject('{{$customer->customer_id}}');" class="btn btn-outline-secondary">
                              <i class="icofont-ui-close text-danger"></i>
                              </a>
                              @endif
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <!-- Row End -->
</div>
@endsection
@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush
@push('custom_styles')
@endpush
@push('scripts')
<!-- Plugin Js-->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
@endpush
@push('custom_scripts')
<script>
   // project data table
$(document).ready(function() {
   $('#myProjectTable')
      .addClass('nowrap')
      .dataTable({
         responsive: true,
         columnDefs: [{
            targets: [-1, -3],
            className: 'dt-body-right'
         }],
         order: [[0, 'desc']]
      });
   $('.deleterow').on('click', function() {
      var tablename = $(this).closest('table').DataTable();
      tablename
         .row($(this)
            .parents('tr'))
         .remove()
         .draw();

   });
});
</script>
<script>
   $(function(){
   
     // showing modal with effect
     $('.modal-effect').on('click', function(e){
       e.preventDefault();
   
       var effect = $(this).attr('data-effect');
       $('#exampleModalLivetaxgroup').addClass(effect);
       $('#exampleModalLivetaxgroup').modal('show');
     });
   
     // hide modal with effect
     $('#exampleModalLivetaxgroup').on('hidden.bs.modal', function (e) {
       $(this).removeClass (function (index, className) {
           return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
       });
     });
   });
   
      function taxgroup(id) {
         
        $("#exampleModalLivetaxgroup").modal('show');
           
        $('#yestax').on('click', function(event){
            document.getElementById("yestax").disabled = true;
            $("#conformation-modal").modal('hide');
             window.location.href = '/admin/tax-grouping/edit/' + id;
        });
   }
   $(function(){
   
     // showing modal with effect
     $('.modal-effect').on('click', function(e){
       e.preventDefault();
   
       var effect = $(this).attr('data-effect');
       $('#exampleModalLive').addClass(effect);
       $('#exampleModalLive').modal('show');
     });
   
     // hide modal with effect
     $('#exampleModalLive').on('hidden.bs.modal', function (e) {
       $(this).removeClass (function (index, className) {
           return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
       });
     });
   });
   
      function approve(id) {
         
        $("#exampleModalLive").modal('show');
           
        $('#yes').on('click', function(event){
            document.getElementById("yes").disabled = true;
            $("#conformation-modal").modal('hide');
            $("#noteModal").modal('show');
            $("#exampleModalLive").modal('hide');
             var company_note ="";
             var pay_later ="";
            
           
            $('.note_button').on('click', function(event){
               var attr_id = $(this).attr('id');
               var agent_id  = $('#agent_id').val();
                //alert(agent_id);
               if(attr_id =="submitNote"){
                  company_note = $('#company_note').val();
                  pay_later = $('#pay_later').val();
                  if(company_note == ""){
                     company_note = "none";
                  }
               }else{
                  company_note = "none";
                  pay_later = "No";
               }
            //    note_button" id="skipNote" 

            //   company_note = $('#company_note').val();
            //   if(company_note == ""){
            //    company_note = "none";
            //   }
              console.log(pay_later);
            $.ajax({
                url: "{{ url('admin/customer/approve') }}"+'/'+id+'/'+company_note+'/'+pay_later+'/'+agent_id,
                type: 'GET',
                dataType: 'html',
                success:function(response) {
                   var obj = JSON.parse(response);
                    if (obj.status == 'success') {

                           location.reload();
                            $('.flash-message').text(response.message).fadeIn().delay(2000).fadeOut();
                    }else{
                        // alert(obj.msg);
                         location.reload();
                          $('.flash-message').text(response.message).fadeIn().delay(2000).fadeOut();
                    }
                   
                }
   
            });
            });
        });
   }
   
   $(function(){
   
     // showing modal with effect
     $('.modal-effect').on('click', function(e){
       e.preventDefault();
   
       var effect = $(this).attr('data-effect');
       $('#exampleModalLivereject').addClass(effect);
       $('#exampleModalLivereject').modal('show');
     });
   
     // hide modal with effect
     $('#exampleModalLivereject').on('hidden.bs.modal', function (e) {
       $(this).removeClass (function (index, className) {
           return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
       });
     });
   });
   
   function reject(id) {
         
        $("#exampleModalLivereject").modal('show');
           
        $('#yesre').on('click', function(event){
            document.getElementById("yesre").disabled = true;
            $("#conformation-modal").modal('hide');
            $.ajax({
                url: "{{ url('admin/customer/reject') }}"+'/'+id,
                type: 'GET',
                dataType: 'html',
                success:function(response) {
                   var obj = JSON.parse(response);
                    if (obj.status == 'success') {
                           location.reload();
                           $('.flash-message').text(response.message).fadeIn().delay(2000).fadeOut();
                    }else{
                        // alert(obj.msg);
                         location.reload();
                         $('.flash-message').text(response.message).fadeIn().delay(2000).fadeOut();
                    }
                   
                }
   
            });
        });
   }
</script>
@endpush
@push('modals')
<!-- Approve -->
<div class="modal fade" id="exampleModalLive" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Approve</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to approve this customer ?</p>
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-primary" id="yes">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>
<!-- Second Modal (Add Note) -->
<div class="modal fade" id="noteModal" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="noteModalLabel">Add Note (optional)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <input type="text" id="company_note" class="form-control" placeholder="Add a note..."><br>
            <label class="form-label">Pay Later  </label>
            <select class="form-control category"  id="pay_later"   >
               <option value="">Please Select</option>
               <option value="Yes">Yes</option>
               <option value="No"> No</option>
            </select>
            <br>
            <label class="form-label">Account Manager  </label>
            <select class="form-control category"  id="agent_id"   >
               <option value="">Please Select</option>
               @foreach($agents as $agent)
               <option value="{{$agent->id}}">{{$agent->name}}</option>
               @endforeach
            </select>
         </div>
         
         <div class="modal-footer">
            <button type="button" class="btn btn-primary note_button" id="submitNote">Add</button>
            <button type="button" class="btn btn-secondary note_button" id="skipNote" data-bs-dismiss="modal">Skip</button>
         </div>
      </div>
   </div>
</div>
<!-- Rejected -->
<div class="modal fade" id="exampleModalLivereject" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Rejected</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to reject this customer ?</p>
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-primary" id="yesre">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>
<!-- Tax Group -->
<div class="modal fade" id="exampleModalLivetaxgroup" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Tax Group</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Please Select Tax Group ?</p>
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-primary" id="yestax">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>
@endpush
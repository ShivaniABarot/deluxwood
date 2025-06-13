@extends(backendView('layouts.app'))
@section('title', 'Process Manage')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-3">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">Order Manage</h3>
            <!-- <a href="{{url('admin/item-add')}}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add Item</a> -->
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
   <div class="row g-3 mb-3">
      <div class="col-md-12">
         <div class="card">
            <div class="row" style=" margin-top:30px; margin-left:10px;">
                  <div class="col-2">
                        <label class="form-label">Account Type : </label>
                        <select class="form-control category" name="tax_group" id="tax_group">
                              <option value="">Please Select</option>
                              <option value="Without Tax">Without Tax</option>
                              <option value="With Tax">With Tax</option>
                        </select>
                  </div>
                  <div class="col-2">
                        <label class="form-label">Start Date : </label>
                        <input type="date" class="form-control"  id="startDate" name="startDate">
                  </div>
                  <div class="col-2">
                        <label class="form-label">End Date : </label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                  </div>
                  <div class="col-2">
                        <label class="form-label">Payment Method : </label>
                        <select class="form-control category" name="payment_method" id="payment_method">
                              <option value="">Please Select</option>
                              <option value="Card">Card</option>
                              <option value="Pay Later">Pay Later</option>
                        </select>
                  </div>
                  @if( Auth::user()->role_id == 1)
                  <div class="col-2">
                        <label class="form-label">Account Manager : </label>
                        <select class="form-control category"  id="agent_id"   >
                           <option value="">Please Select</option>
                           @foreach($agents as $agent)
                           <option value="{{$agent->name}}">{{$agent->name}}</option>
                           @endforeach
                        </select>
                  </div>
                  @endif
            </div>
             <div class="card-body">
               <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                  <thead>
                     <tr>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>Company (Note)</th>
                        <th>Style</th>
                        <th>Status</th>
                        <th>Tax Group</th>
                        <th>Payment Method </th>
                        @if( Auth::user()->role_id == 1)
                        <th style="display:none">Account Manager</th>
                        @endif
                        <th>Total Price</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  
                     @foreach($customer_orders as $val)
                     <tr>
                        <td><strong>{{$val->customer_draft_id}}</strong></td>
                        <td>{{$val->order_date}}</td>
                         <td>{{$val->company_name}} @if($val->company_note != null || $val->company_note != "") ( {{$val->company_note}} ) @endif</td>
                         <td>
                                 @foreach(explode(',', $val->door_style_names) as $door_style_name)
                                     {{ $door_style_name }}<br>
                                 @endforeach
                             </td>
                        <td>@if($val->draft_status == "Inprogress")
                           {{"In Progress"}}
                           @else 
                         {{$val->draft_status}}
                           @endif
                        </td>
                        <td>{{$val->tax_group}}</td>
                        <td>{{$val->payment_method}}</td>
                        @if( Auth::user()->role_id == 1)
                        @php $agent =  DB::table('agent')->select('users.name')->leftjoin('users', 'users.id', 'agent.user_id')->where('id',$val->agent_id)->first();  @endphp 
                        <td style="display:none">@if($agent != null){{$agent->name}} @endif</td>
                        <td>{{ number_format($val->original_price, 2, '.', ',') }}</td>
                        <td>
                           <div class="btn-group" role="group" aria-label="Basic outlined example">
                              <a type="button" class="btn btn-outline-secondary" href="{{url('admin\process-manage-view')}}\{{$val->customer_draft_id}}" ><i class="icofont-eye text-warning"></i></a>

                              <!-- <button type="button" onclick="deleteModal('{{$val->customer_draft_id}}');" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button> -->
                              <!-- <a href="javascript:void(0)" onclick="deleteModal('{{$val->customer_draft_id}}');" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a> -->
                           </div>
                        </td>
                        @endif
                        @if( Auth::user()->role_id == 3)
                        <td>{{$val->original_price}}</td>
                        <td>
                           <div class="btn-group" role="group" aria-label="Basic outlined example">
                              <a type="button" class="btn btn-outline-secondary" href="{{url('process-manage-view')}}\{{$val->customer_draft_id}}" ><i class="icofont-eye text-warning"></i></a>

                             </div>
                        </td>
                        @endif
                     </tr>
                  
                     @endforeach
                  </tbody>
               </table>
               <div class="row" style="margin-top:30px"><div class="col-9"> </div> <label id="totalPriceSum" class="col-3" style="font-size: 19px; border:solid 2px black; "></label> </div>

            </div>
         </div>
      </div>
   </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalLive" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Process Manage</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to delete this order manage record ?</p>
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-warning" id="yes">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
         </div>
      </div>
   </div>
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
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
@endpush
@push('custom_scripts')
<script>
      $(document).ready(function() {
         function total_sum(){
        var total = 0;
        @if( Auth::user()->role_id == 1)
        table.column(8, { search: 'applied' }).data().each(function(value) {
            total += parseFloat(value.replace(/[^\d.-]/g, '')) || 0; 
        });
        @else
        table.column(7, { search: 'applied' }).data().each(function(value) {
            total += parseFloat(value.replace(/[^\d.-]/g, '')) || 0; 
        });
        @endif
        $('#totalPriceSum').text('TOTAL : $' + total.toFixed(2)); 

    }

        var table = $('#myDataTable').DataTable({
            responsive: true,
            columnDefs: [{
                targets: [-1, -3],
                className: 'dt-body-right'
            }],
            order: [[0, 'desc']]
        });

        // Add a date range filter
      //   $('#tax_group').on('change', function() {
      //    var tax_group = $(this).val();
      //    console.log(tax_group);
      //    table.column(5).search(tax_group).draw();
      //    total_sum();
      //   });
      $('#tax_group').on('change', function() {
            var tax_group = $(this).val();
            console.log(tax_group);

            if (tax_group === "") {
               table.column(5).search('').draw();
            } else {
                table.column(5).search('^' + tax_group + '$', true, false).draw();
               //  console.log('^' + tax_group + '$');
               // table.column(5).search(tax_group).draw();
            }

            total_sum();
         });
         $('#myDataTable_filter input').on('keyup', function() {
            table.search(this.value).draw();
            total_sum();
         });
         $('#payment_method').on('change', function() {
         var payment_method = $(this).val();
         console.log(payment_method);
         table.column(6).search(payment_method).draw();
         total_sum();
        });
        $('#agent_id').on('change', function() {
         var agent_id = $(this).val();
         console.log(agent_id);
         table.column(7).search(agent_id).draw();
         total_sum();
        });
        
        $('#startDate, #endDate').on('change', function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            // Clear existing custom search functions
    $.fn.dataTable.ext.search = [];

            $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var minDate = startDate ? new Date(startDate) : null;
            var maxDate = endDate ? new Date(endDate) : null;
            var currentDate = new Date(data[1]); // Assuming date is in the second column (index 1)

            if ((minDate === null || currentDate >= minDate) && (maxDate === null || currentDate <= maxDate)) {
                return true;
            }
            return false;
        }
    );
    table.draw();
    total_sum();
      });
     
      total_sum();
    });
  
   $('.deleterow').on('click', function() {
   	var tablename = $(this).closest('table').DataTable();
   	tablename
   		.row($(this)
   			.parents('tr'))
   		.remove()
   		.draw();
   
   });
</script>
<script>
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
   
   function deleteModal(id) {
      
   $("#exampleModalLive").modal('show');
   
   $('#yes').on('click', function(event){
    $("#conformation-modal").modal('hide');
    $.ajax({
     url: "{{ url('admin/process-manage/delete') }}"+'/'+id,
     type: 'GET',
     dataType: 'html',
     success:function(response) {
   	 location.reload();
   	 $('.flash-message').text(response.message).fadeIn().delay(2000).fadeOut();
     }
    });
   });
   }
</script>
@endpush
@push('modals')
@endpush
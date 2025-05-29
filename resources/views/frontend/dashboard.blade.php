@extends(backendView('layouts.app'))

@section('title', 'Dashboard')

@section('content')
<div class="container-xxl">
    <div class="row g-3">
        <div class="mt-4">
            <a href="{{ url('customer-draft') }}" class="btn btn-lg btn-block btn-dark text-uppercase" style="float: right;">Add Draft</a>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="tab-content mt-1">
                <div class="tab-pane fade show active" id="summery-today">
                    <div class="row g-1 g-sm-3 mb-3 row-deck" id="draft-container">
                        @if($customer_draft->isNotEmpty())
                            @foreach($customer_draft as $data)
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4" id="draft-{{ $data->customer_draft_id }}">
                                <div class="card">
                                    <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="left-info">
                                            <div><span class="fs-6 fw-bold me-2">Draft : {{ $data->customer_draft_id }}</span></div>
                                            <table>
                                                <tr>
                                                    <td style="width: 70%;">
                                                        <div>
                                                            <span><b>PO :</b> {{ $data->po_number }}</span><br>
                                                            <span><b>Total :</b> ${{ $data->total_price }}</span><br>
                                                            @php
                                                                $doorStyle = \App\Models\DoorStyle::find($data->door_style_id);
                                                                $doorStyleName = $doorStyle ? $doorStyle->name : 'Unknown Style';
                                                                $doorStyleImage = $doorStyle ? $doorStyle->image : 'default-image.jpg';
                                                            @endphp
                                                            <span><b>Style :</b> {{ $doorStyleName }}</span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 30%;">
                                                        <div>
                                                            <div class="items-image">
                                                                <img src="{{ asset('img/door_style/' . $doorStyleImage) }}" alt="product" style="width: 60px; height:80px; border-radius: 8px; margin-left:10px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color); cursor: pointer;">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    @if($data->draft_status == "Save" || $data->draft_status == "Pending")
                                        <a href="{{ url('add-cart') }}/{{ $data->customer_draft_id }}" class="btn btn-white-border btn-lg btn-block db_cls mb-2">See Details</a>
                                    @else
                                        <a href="{{ url('tracking-status/view') }}/{{ $data->customer_draft_id }}" class="btn btn-white-border btn-lg btn-block db_cls mb-2">See Details</a>
                                    @endif
                                    <div style="display: flex; gap: 10px;">
                                        <button type="button" onclick="duplicateModal('{{ $data->customer_draft_id }}');" class="btn btn-white-border btn-lg db_cls" style="flex: 1;">Duplicate</button>
                                        <button type="button" onclick="deleteModal('{{ $data->customer_draft_id }}');" class="btn btn-white-border btn-lg db_cls button1" style="flex: 1;">Delete</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLive" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-body-text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="confirm-action">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
@endpush

@push('custom_styles')
<style>
    .btn-white-border {
        background-color: white;
        border-top: 1px solid gray;
        border-bottom: 1px solid black;
        color: black;
    }
    .button1:hover {
        color: red !important;
    }
</style>
@endpush

@push('scripts')
<script src="{{ backendAssets('dist/assets/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ backendAssets('dist/assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{ backendAssets('dist/assets/js/page/index.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
@endpush

@push('custom_scripts')
<script>
$(function() {
    $('.modal-effect').on('click', function(e) {
        e.preventDefault();
        var effect = $(this).attr('data-effect');
        $('#exampleModalLive').addClass(effect);
        $('#exampleModalLive').modal('show');
    });

    $('#exampleModalLive').on('hidden.bs.modal', function(e) {
        $(this).removeClass(function(index, className) {
            return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
        });
        $('#exampleModalLiveLabel').text('');
        $('#modal-body-text').text('');
        $('#confirm-action').off('click');
    });
});

function deleteModal(id) {
    $('#exampleModalLiveLabel').text('Delete Draft');
    $('#modal-body-text').text('Are you sure you want to delete this draft?');
    $('#exampleModalLive').modal('show');

    $('#confirm-action').on('click', function(event) {
        $('#exampleModalLive').modal('hide');
        $.ajax({
            url: "{{ url('draft/delete') }}/" + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#draft-' + id).remove();
                } else {
                    alert('Error deleting draft: ' + response.message);
                }
            },
            error: function(xhr) {
                let errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                alert('Error deleting draft: ' + errorMsg);
            }
        });
    });
}

function duplicateModal(id) {
    $('#exampleModalLiveLabel').text('Duplicate Draft');
    $('#modal-body-text').text('Are you sure you want to duplicate this draft?');
    $('#exampleModalLive').modal('show');

    $('#confirm-action').on('click', function(event) {
        $('#exampleModalLive').modal('hide');
        $.ajax({
            url: "{{ url('draft/duplicate') }}/" + id,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = "{{ url('dashboard') }}";
                } else {
                    console.error('Duplicate failed:', response);
                    alert('Error duplicating draft: ' + response.message);
                }
            },
            error: function(xhr) {
                let errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                console.error('AJAX error details:', xhr.responseText, xhr.status, xhr.statusText);
                alert('Error duplicating draft: ' + errorMsg + ' (Status: ' + xhr.status + ')');
            }
        });
    });
}
</script>
@endpush
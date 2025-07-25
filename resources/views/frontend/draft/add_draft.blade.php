@extends(backendView('layouts.app'))
@section('title', 'Add Draft')
@section('content')
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                    class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">New Drafts</h3>
                </div>
            </div>
        </div>
        <label class="form-label" name="draft_id" style="margin-left:8px;">PO: {{$customerDraft->po_number}} </label>
        <label class="form-label" name="draft_id" style="margin-left:25px;">Draft Number: {{$customer_draft_Id}} </label>
        <label class="form-label" name="draft_id" style="margin-left:25px;">Designer: {{$customerDraft->designer}} </label>
        <!-- Row end  -->
        @if (session('success'))
            <div class="col-4 alert alert-success" style="margin-left:730px">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="col-4 alert alert-danger" style="margin-left:730px">
                {{ session('error') }}
            </div>
        @endif
        <div class="row clearfix g-3">
            <div class="col-lg-12">
                @foreach($draft_style as $data)
                    <div class="card mb-3">
                        @php $door_style = DB::table('door_style')->select('image', 'name')->where('doorStyle_id', $data->door_style_Id)->first(); @endphp
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <div class="single-item active">
                                        <div class="items-image">
                                            <img src="{{ asset('img/door_style/' . $door_style->image) }}" alt="product"
                                                style="width: 185px; height: 210px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color); cursor: pointer;">
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text dc_cls">{{$door_style->name}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="{{url('door-style/change')}}/{{$data->draft_style_id}}"
                                                        class="btn btn-outline-warning text-uppercase nx_cls">Change
                                                        Style</a><br>
                                                    <a href="{{url('delete-draft-style')}}/{{$data->draft_style_id}}"
                                                        class="btn btn-outline-warning text-uppercase nx_cls"
                                                        style="margin-top:14px;">Remove Style</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="margin-top:30px;">Configuration</label>
                                                <div class="toggle-button-container configuration">
                                                    @if($data->assemble_options == "Assembled")
                                                        <button type="button"
                                                            class="toggle-button configButton {{ $data->configuration === 'Assembled' ? 'active' : '' }}"
                                                            data-configuration="Assembled"
                                                            data-door-style-id="{{ $data->draft_style_id }}">Assembled</button>
                                                    @elseif($data->assemble_options == "Unassembled")
                                                        <button type="button"
                                                            class="toggle-button configButton {{ $data->configuration === 'Unassembled' ? 'active' : '' }}"
                                                            data-configuration="Unassembled"
                                                            data-door-style-id="{{ $data->draft_style_id }}">Unassembled</button>
                                                    @else
                                                        <button type="button"
                                                            class="toggle-button configButton {{ $data->configuration === 'Assembled' ? 'active' : '' }}"
                                                            data-configuration="Assembled"
                                                            data-door-style-id="{{ $data->draft_style_id }}">Assembled</button>
                                                        <button type="button"
                                                            class="toggle-button configButton {{ $data->configuration === 'Unassembled' ? 'active' : '' }}"
                                                            data-configuration="Unassembled"
                                                            data-door-style-id="{{ $data->draft_style_id }}">Unassembled</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="hidden" class="door-style-id" value="{{ $data->door_style_Id }}"
                                                    hidden name="door-id">
                                                <input type="text" class="draft-style-id" value="{{ $data->draft_style_id }}"
                                                    hidden>
                                                <input type="text" class="customer-draft-id"
                                                    value="{{ $data->customer_draft_Id }}" hidden>
                                                <div class="input-group-prepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 search-box-container">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control typeahead search-box2"
                                                    placeholder="Search and add item">
                                                <input type="hidden" class="door-style-id2" value="{{ $data->door_style_Id }}"
                                                    hidden>
                                                <input type="text" class="draft-style-id2" value="{{ $data->draft_style_id }}"
                                                    hidden>
                                                <input type="text" class="customer-draft-id2"
                                                    value="{{ $data->customer_draft_Id }}" hidden>
                                                <div class="suggestions-list"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-container" style="display: none;" id="{{ $data->door_style_Id }}-table-container">
                                <table id="{{ $data->door_style_Id }}-table" class="table table-hover align-middle mb-0"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Description</th>
                                            <th>Hinge Side</th>
                                            <th>Finished End</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table content will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="card mb-3" id="product-cart-{{ $data->draft_style_id }}">
                                <div class="card-body">
                                    <input type="text" class="draft-style-id" value="{{ $data->draft_style_id }}" hidden>
                                    <input type="text" class="customer-draft-id" value="{{ $data->customer_draft_Id }}" hidden>
                                    <div class="table-container">
                                        <table class="table table-hover align-middle mb-0 product-table"
                                            id="product-table-{{ $data->draft_style_id }}">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>QTY.</th>
                                                    <th>SKU</th>
                                                    <th>Cut Depth</th>
                                                    <th>Modifications</th>
                                                    <th>Accessories</th>
                                                    <th>Hinge Side</th>
                                                    <th>Finished End</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $customer_draft_Id = $data->customer_draft_Id @endphp
                @endforeach
                    <div class="card">
                        <form action="{{url('draft-product/store')}}/{{$customer_draft_Id}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-6">
                                    <label class="form-label" style="margin-top:30px;">Service Type</label>
                                    <div class="toggle-button-container service_type">
                                        <button type="button" class="toggle-button"
                                            onclick="toggleButton(0, 'service_type')">Self Pickup</button>
                                        <button type="button" class="toggle-button"
                                            onclick="toggleButton(1, 'service_type')">Curbside Delivery</button>
                                        <button type="button" class="toggle-button"
                                            onclick="toggleButton(2, 'service_type')">In-house Delivery</button>
                                    </div>
                                    <input type="hidden" id="service_type_input" name="service_type"
                                        value="{{ $serviceType }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="margin-top: 20px">
                                        <a href="{{url('door-style')}}/{{$customer_draft_Id}}"
                                            class="btn btn-outline-warning text-uppercase nx_cls">Add Another Style</a>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <button type="submit" class="btn btn-warning mt-3 text-uppercase px-5">Next</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="alertBox" class="alert-box">
                            <span id="alertMessage" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="sidebar_model">
                        <div class="sidebar-header">
                            <h2 class="sidebar-title">Select Modifications & Accessories</h2>
                            <button class="btn-close close-sidebar" aria-label="Close"></button>
                        </div>
                        <div class="navbar">
                            <div class="navbar-item active" data-section="modification">Modification</div>
                            <div class="navbar-item" data-section="accessories">Accessories</div>
                        </div>
                        <div class="content">
                            <div class="section modification-list active">
                                <h6 class="section-heading selcted-modifications-heading">Selected Modifications</h6>
                                <div class="selected-modifications">
                                    <!-- Selected modification items go here -->
                                </div>
                                <h6 class="section-heading available-modifications-heading">Available Modifications</h6>
                                <div class="available-modifications">
                                    <!-- Available modification items go here -->
                                </div>
                            </div>
                            <div class="section accessories-list">
                                <h6 class="section-heading selcted-accessories-heading">Selected Accessories</h6>
                                <div class="selected-accessories">
                                    <!-- Selected accessories items go here -->
                                </div>
                                <h6 class="section-heading available-accessories-heading">Available Accessories</h6>
                                <div class="available-accessories">
                                    <!-- Available accessories items go here -->
                                </div>
                            </div>
                        </div>
                        <br>
                        <center><button class="btn btn-outline-warning text-uppercase nx_cls save-sidebar">Close</button>
                        </center>
                    </div>
                    <div class="modal-card" id="modal-card">
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Modal -->
            <div class="modal fade" id="cutDepthModalLive" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cutDepthModalLiveLabel">Cut Depth</h5>
                        </div>
                        <div class="modal-body">
                            <div class="available-cutdepth selcted-cutdepth-heading">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning save-cut-depth">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalLive" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLiveLabel">Draft Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this product?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" id="yes">Yes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Custom modal -->
            <div class="modal fade" id="productActionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Product Already Added</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            This product is already added. Do you want to add this again?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="newEntryBtn">Yes</button>
                            <button type="button" class="btn btn-secondary" id="NonewEntryBtn">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

    @push('styles')
        <!-- plugin css file  -->
        <link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
        <link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush

    @push('custom_styles')
        <style>
            /* Existing styles */
            .custom-edit-modification-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.4);
                z-index: 1000;
            }

            .custom-modal-content {
                background-color: white;
                width: 50%;
                max-width: 500px;
                margin: 10% auto;
                padding: 20px;
                position: relative;
                border-radius: 8px;
            }

            .custom-close-modal-button:hover {
                color: darkred;
            }

            .custom-modal-content h2 {
                margin-top: 0;
            }

            .custom-modal-content label {
                display: block;
                margin-top: 10px;
            }

            .custom-modal-content select,
            .custom-modal-content input[type="text"] {
                width: 100%;
                padding: 8px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .custom-submit-button {
                margin-bottom: -15px;
                padding: 8px 12px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .custom-submit-button:hover {
                background-color: #0056b3;
            }

            .sidebar_model {
                width: 350px;
                position: fixed;
                top: 0;
                right: -350px;
                height: 100%;
                background-color: #fff;
                padding-top: 20px;
                box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
                transition: right 0.3s;
                z-index: 10000;
            }

            .sidebar_model.open {
                right: 0;
            }

            .sidebar-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                border-bottom: 1px solid #ddd;
            }

            .sidebar-title {
                font-size: 1.2em;
                margin: 0;
                color: #000;
            }

            .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #fff;
                border-bottom: 1px solid #ddd;
                padding: 10px 20px;
            }

            .navbar-item {
                padding: 5px 15px;
                cursor: pointer;
                transition: background-color 0.3s;
                border-bottom: 2px solid transparent;
                font-size: 1.1em;
                font-weight: bold;
                color: #000;
            }

            .navbar-item.active {
                color: #000;
                border-bottom-color: #000;
            }

            .content {
                padding: 0px 20px;
            }

            .section {
                display: none;
            }

            .section.active {
                display: block;
            }

            .section-heading {
                font-size: 1.1em;
                color: #333;
                margin: 25px 0px 10px 0px;
                padding: 10px 70px 20px 60px;
                font-size: 1em;
                font-weight: bold;
                color: #000;
                border-bottom: 1px solid #ccc;
            }

            .modification-item,
            .accessory-item {
                padding: 10px;
                margin: 5px 0;
                border-bottom: 1px solid #ccc;
                cursor: pointer;
                transition: border-color 0.3s, background-color 0.3s;
                position: relative;
                padding-right: 40px;
            }

            .modification-item.selected,
            .accessory-item.selected {
                border-color: #333;
                color: #333;
            }

            .modification-item:hover,
            .accessory-item:hover {
                border-color: #999;
            }

            .modification-delete-icon {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: gray;
                cursor: pointer;
                transition: color 0.3s;
            }

            .modification-delete-icon:hover {
                color: darkgray;
            }

            .edit-modification-button {
                position: absolute;
                right: 40px;
                top: 50%;
                transform: translateY(-50%);
                color: gray;
                cursor: pointer;
                transition: color 0.3s;
            }

            .accessories-delete-icon {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: gray;
                cursor: pointer;
                transition: color 0.3s;
            }

            .accessories-delete-icon:hover {
                color: darkgray;
            }

            .modal-card {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }

            .modal-card button {
                background-color: #3498db;
                border: none;
                color: white;
                padding: 5px 10px;
                border-radius: 4px;
                cursor: pointer;
            }

            .search-box-container {
                position: relative;
            }

            .suggestions-list {
                position: absolute;
                top: 100%;
                width: 100%;
                max-height: 200px;
                overflow-y: auto;
                border: 1px solid #ccc;
                background-color: white;
                z-index: 1000;
            }

            .suggestion-item {
                padding: 10px;
                border-bottom: 1px solid #eee;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .suggestion-icon {
                font-size: 20px;
                color: #888;
                margin-right: 10px;
            }

            .suggestion-text {
                display: flex;
                flex-direction: column;
            }

            .suggestion-sku {
                font-weight: bold;
                font-size: 16px;
            }

            .suggestion-name {
                font-size: 12px;
                color: #666;
            }

            .custom-add-button {
                padding: 3px 6px;
                font-size: 14px;
                color: orange;
                background-color: white;
                border-radius: 5px;
                cursor: pointer;
            }

            .alert-box {
                display: none;
                position: fixed;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                background-color: black;
                color: white;
                padding: 10px;
                border-radius: 5px;
                opacity: 0;
                transition: opacity 0.5s;
            }

            .show {
                display: block;
                opacity: 1;
            }

            .toggle-button-container {
                display: flex;
            }

            .toggle-button {
                padding: 8px 16px;
                font-size: 14px;
                cursor: pointer;
                border: 1px solid gray;
                border-radius: 10px;
                margin-right: 10px;
            }

            .toggle-button.active {
                background-color: black;
                color: white;
                border: 1px solid black;
            }

            .btn-white-border {
                background-color: white;
                border-top: 1px solid gray;
                border-bottom: 1px solid black;
                color: black;
            }

            .btn-light:focus {
                background-color: #eca72f !important;
            }

            .dc_cls {
                font-weight: 600 !important;
                padding-left: 7px;
                padding-top: 15px;
            }

            .nx_cls {
                color: #ffc107 !important;
            }

            .nx_cls:hover {
                color: #FFFFFF !important;
                background: none;
            }

            .size-block .filter-size ul li.active {
                background-color: #101010;
                border-color: #101010;
            }

            input,
            textarea {
                border: 1px solid #eeeeee;
                box-sizing: border-box;
                margin: 0;
                outline: none;
                padding: 10px;
            }

            input[type="button"] {
                -webkit-appearance: button;
                cursor: pointer;
            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
            }

            .input-group {
                clear: both;
                margin: 15px 0;
                position: relative;
                flex-wrap: nowrap;
            }

            .input-group input[type='button'] {
                background-color: #eeeeee;
                min-width: 31px;
                width: auto;
                transition: all 300ms ease;
            }

            .input-group .button-minus,
            .input-group .button-plus {
                font-weight: bold;
                height: 38px;
                padding: 0;
                width: 38px;
                position: relative;
            }

            .input-group .quantity-field {
                position: relative;
                height: 38px;
                left: -6px;
                text-align: center;
                width: 62px;
                display: inline-block;
                font-size: 13px;
                margin: 0 0 5px;
                resize: vertical;
            }

            .button-plus {
                left: -13px;
            }

            input[type="number"] {
                -moz-appearance: textfield;
                -webkit-appearance: none;
            }

            .custom-modal {
                position: fixed;
                right: 0;
                top: 0;
                width: 300px;
                height: 100%;
                background-color: #f5f5f5;
                z-index: 9999;
                overflow: hidden;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }

            .custom-modal-content {
                padding: 20px;
            }

            .custom-modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #d9d9d9;
            }

            .custom-modal-header h3 {
                margin: 0;
            }

            .custom-modal-body {
                margin-top: 10px;
            }

            .custom-modal-body ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .custom-modal-body li {
                padding: 8px 0;
                cursor: pointer;
            }

            .custom-modal-body li:hover {
                background-color: #e6e6e6;
            }

            .custom-modal-body li:first-child {
                padding-top: 0;
            }

            .custom-modal-body li:last-child {
                padding-bottom: 0;
            }

            .close {
                font-size: 20px;
                font-weight: bold;
                cursor: pointer;
            }

            .enable-after-saving {
                pointer-events: auto;
                opacity: 1;
            }

            .drag-handle {
                cursor: move;
                font-size: 16px;
                margin-right: 10px;
            }

            .sortable-placeholder {
                background-color: #f0f0f0;
                border: 1px dashed #ccc;
                height: 50px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
        <script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
        <script src="{!! backendAssets('dist/assets/js/page/index.js') !!}"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
            integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    @endpush

    @push('custom_scripts')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                var sidebar = document.querySelector(".sidebar");
                sidebar.classList.add("sidebar-mini");
            });
        </script>
        <script>
            function showAlert(message) {
                var alertBox = document.getElementById("alertBox");
                var alertMessage = document.getElementById("alertMessage");
                alertMessage.textContent = message;
                alertBox.classList.add("show");
                setTimeout(function () {
                    alertBox.classList.remove("show");
                }, 2000);
            }

            $(document).ready(function () {
                // Initialize Sortable on each product table
                $('.product-table').each(function () {
                    var table = $(this);
                    var tableId = table.attr('id');
                    var draftStyleId = tableId.replace('product-table-', '');

                    table.find('tbody').sortable({
                        handle: '.drag-handle',
                        placeholder: 'sortable-placeholder',
                        helper: function (e, ui) {
                            ui.children().each(function () {
                                $(this).width($(this).width());
                            });
                            return ui;
                        },
                        update: function (event, ui) {
                            var newOrder = [];
                            table.find('tbody tr').each(function (index) {
                                var productId = $(this).data('product-id');
                                var draftProductId = $(this).data('draft-product-id');
                                newOrder.push({
                                    product_id: productId,
                                    draft_product_id: draftProductId,
                                    order: index + 1
                                });
                            });

                            $.ajax({
                                url: '/update-draft-product-order',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    draft_style_id: draftStyleId,
                                    order: newOrder
                                },
                                success: function (response) {
                                    showAlert('Product order updated successfully!');
                                    loadDraftProducts(table.closest('.card'));
                                },
                                error: function (error) {
                                    console.error('Error updating product order:', error);
                                    // showAlert('Failed to update product order.');
                                }
                            });
                        }
                    }).disableSelection();
                });

                $(".card").each(function () {
                    var $card = $(this);
                    loadDraftProducts($card);
                });

                var suggestionsList;

                $('.search-box2').on('input', function () {
                    const searchBox = $(this);
                    var sku = $(this).val();
                    var doorStyleId = $(this).siblings(".door-style-id2").val();
                    var draftStyleId = $(this).siblings(".draft-style-id2").val();
                    var customerDraftId = $(this).siblings(".customer-draft-id2").val();
                    suggestionsList = $(this).siblings('.suggestions-list');

                    if (sku.length >= 1) {
                        $.ajax({
                            url: "/get-products-by-sku-and-door-style",
                            method: 'GET',
                            data: {
                                sku: sku,
                                door_style_id: doorStyleId,
                                draft_style_id: draftStyleId,
                                customer_draft_Id: customerDraftId
                            },
                            success: function (suggestions) {
                                suggestionsList.empty();
                                for (const suggestion of suggestions) {
                                    const suggestionItem = `<div class="suggestion-item suggestion-add-btn" data-product-id="${suggestion.product_id}" data-draft-style-id="${draftStyleId}" data-customer-draft-id="${customerDraftId}">
                                        <div class="suggestion-text" data-product-id="${suggestion.product_id}" data-draft-style-id="${draftStyleId}" data-customer-draft-id="${customerDraftId}">
                                            <span class="suggestion-sku">${suggestion.product_item_sku}</span>
                                        </div>
                                    </div>`;
                                    suggestionsList.append(suggestionItem);
                                }
                                $(".suggestion-add-btn").click(suggestionClick);
                            }
                        });
                    } else {
                        suggestionsList.empty();
                    }
                });

                var suggestionClick = function () {
                    var productId = $(this).data("product-id");
                    var draftStyleId = $(this).data("draft-style-id");
                    var customerDraftId = $(this).data("customer-draft-id");

                    $.ajax({
                        url: "/store-draft-product",
                        type: "GET",
                        data: {
                            product_id: productId,
                            draft_style_id: draftStyleId,
                            customer_draft_Id: customerDraftId
                        },
                        success: function (response) {
                            var obj = JSON.parse(JSON.stringify(response));
                            showAlert(obj.message);
                            var $card = $(this).closest(".card");
                            loadDraftProducts($card);
                            suggestionsList.empty();
                            $('.search-box2').val("");
                        }.bind(this)
                    });
                };

                $(document).on('click', function (event) {
                    if (!$(event.target).closest('.suggestions-list').length) {
                        suggestionsList.empty();
                    }
                });
            });

            $(document).on("click", ".edit-button", function () {
                $(".navbar-item").click(function () {
                    const sectionToShow = $(this).data("section");
                    $(".navbar-item").removeClass("active");
                    $(this).addClass("active");
                    $(".section").removeClass("active");
                    $(".section." + sectionToShow + "-list").addClass("active");
                });

                $(".sidebar_model").addClass("open");

                var productId = $(this).data("product-id");
                var draftStyleId = $(this).data("draft-style-id");
                var selectedModificationId = $(this).siblings(".modification_id").val();
                var selectedAccessorieId = $(this).siblings(".accessorie_id").val();
                var draftProductId = $(this).data("draft-product-id");

                loadModifications(productId, draftStyleId, selectedModificationId, draftProductId, ".sidebar_model .modification-list");
                loadAccessories(productId, draftStyleId, selectedAccessorieId, draftProductId, ".sidebar_model .accessories-list");
                loadCutdepth(productId, draftStyleId, selectedAccessorieId, draftProductId, ".sidebar_model .cutdepth-list");
            });

            $(document).on("click", ".no_modification_accessories", function () {
                var alertBox = document.getElementById("alertBox");
                var alertMessage = document.getElementById("alertMessage");
                alertMessage.textContent = "Accessory and Modification are not present for this product.";
                alertBox.classList.add("show");
                setTimeout(function () {
                    alertBox.classList.remove("show");
                }, 1500);
                console.log("not have Modification or accessories");
            });

            $(document).on("click", ".modification-item", function (event) {
                var modificationItem = $(this);
                var isSelected = modificationItem.hasClass("selected");
                if (isSelected) {
                    return;
                }

                var modificationInfo = modificationItem.data("modification-info");
                var infoType = modificationItem.data("info-type");
                var integer_lable = modificationItem.data("integer-lable");
                var message_lable = modificationItem.data("message-lable");
                var draftProductId = modificationItem.data("draft-product-id");
                var selectedModificationId = modificationItem.data("modification-id");
                var draftStyleId = modificationItem.data("draft-id");
                var productId = modificationItem.data("product-id");
                var editButton = modificationInfo === 'Yes' ? '<i class="edit-modification-button icofont-edit"></i>' : '';

                $.ajax({
                    url: "/add-modification-to-draft-product",
                    type: "GET",
                    data: {
                        modification_id: selectedModificationId,
                        product_id: productId,
                        draft_style_id: draftStyleId,
                        draftProductId: draftProductId,
                        modificationInfo: modificationInfo,
                        infoType: infoType,
                        integer_lable: integer_lable,
                        message_lable: message_lable
                    },
                    success: function (response) {
                        if (response.added) {
                            modificationItem.detach();
                            modificationItem.removeClass("selected");
                            modificationItem.find(".edit-modification-button").remove();
                            modificationItem.appendTo(".selected-modifications").append(editButton);
                            modificationItem.find(".modification-delete-icon").remove();
                            modificationItem.appendTo(".selected-modifications").append('<i class="modification-delete-icon icofont-trash"></i>');
                            modificationItem.addClass("selected");
                        } else {
                            modificationItem.remove();
                        }
                        updateSectionVisibility("modification");
                    },
                    error: function (error) {
                        console.error("Error adding modification ID to draft_product table");
                    }
                });

                event.stopPropagation();
            });

            function loadModifications(productId, draftStyleId, selectedModificationId, draftProductId, targetElement) {
                $.ajax({
                    url: "/get-modifications-by-product",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        var modificationList = $(targetElement);
                        $(".selected-modifications").empty();
                        $(".available-modifications").empty();

                        response.forEach(function (modification) {
                            var isSelected = modification.is_selected ? 'selected' : '';
                            var deleteIcon = modification.is_selected ? '<i class="modification-delete-icon icofont-trash"></i>' : '';
                            var editButton = modification.is_selected && modification.modification_info === 'Yes' ? '<i class="edit-modification-button icofont-edit"></i>' : '';

                            var modificationItem = `
                                <div class="modification-item ${isSelected}" data-product-id="${productId}" data-draft-id="${draftStyleId}" data-draft-product-id="${draftProductId}"
                                    data-modification-info="${modification.modification_info}" data-info-type="${modification.info_type}" data-integer-lable="${modification.integer_lable}"
                                    data-message-lable="${modification.message_label}" data-modification-id="${modification.modification_id}">
                                    ${modification.modification_nm} - (Price - ${modification.modification_price})
                                    ${editButton}
                                    ${deleteIcon}
                                </div>
                            `;

                            if (modification.is_selected) {
                                $(".selected-modifications").append(modificationItem);
                            } else {
                                $(".available-modifications").append(modificationItem);
                            }
                        });

                        updateSectionVisibility("modification");
                    },
                    error: function (error) {
                        console.error("Error fetching modifications");
                    }
                });
            }

            function loadCutdepth(productId, draftStyleId, selectedModificationId, draftProductId, targetElement) {
                $.ajax({
                    url: "/get-cutdepth-by-product",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        $(".available-cutdepth").empty();
                        var cutdepthItem = $("<select>", {
                            "class": "form-control form-select selectcutDepth",
                            "name": "depth_name_inch",
                            "data-product-id": productId,
                            "data-draft-product-id": draftProductId
                        });

                        cutdepthItem.append($('<option>', {
                            value: '',
                            text: 'Please select'
                        }));

                        if (response.cut_depth_info && response.selectedCutDepth) {
                            var cut_depth_info = response.cut_depth_info;
                            var selectedCutDepth = response.selectedCutDepth;

                            for (var item_depth_id in cut_depth_info) {
                                var depth_name_inch = cut_depth_info[item_depth_id];
                                var option = $('<option>', {
                                    value: depth_name_inch,
                                    text: `${depth_name_inch}"`
                                });

                                if (selectedCutDepth.selected_cut_depth == depth_name_inch) {
                                    option.attr('selected', 'selected');
                                }
                                cutdepthItem.append(option);
                            }
                        }

                        $(".available-cutdepth").append(cutdepthItem);
                        var hasCutDepthOptions = response.selectedCutDepth && response.selectedCutDepth.is_cut_depth === 'Yes';
                        if (hasCutDepthOptions) {
                            $('.selcted-cutdepth-heading, .available-cutdepth').show();
                        } else {
                            $('.selcted-cutdepth-heading, .available-cutdepth').hide();
                        }
                    },
                    error: function (error) {
                        console.error("Error fetching cut depth");
                    }
                });
            }

            $(document).on("change", ".selectcutDepth", function () {
                var selectedDepth = $(this).val();
                var productId = $(this).data('product-id');
                var draftProductId = $(this).data('draft-product-id');

                $.ajax({
                    url: "/updateSelectedCutDepth",
                    type: "GET",
                    data: {
                        selectedDepth: selectedDepth,
                        productId: productId,
                        draftProductId: draftProductId
                    },
                    success: function (response) {
                        // Handle success
                    },
                    error: function (error) {
                        console.error("Error updating cut depth");
                    }
                });
            });

            $(document).on("click", ".edit-modification-button", function () {
                var modificationItem = $(this).closest(".modification-item");
                var selectedModificationId = modificationItem.data("modification-id");
                var modificationInfo = modificationItem.data("modification-info");
                var infoType = modificationItem.data("info-type");
                var integer_lable = modificationItem.data("integer-lable");
                var message_lable = modificationItem.data("message-lable");
                var draftProductId = modificationItem.data("draft-product-id");
                var draftStyleId = modificationItem.data("draft-id");
                var productId = modificationItem.data("product-id");

                var buildEditModal = function (selectBoxHtml, textBoxHtml) {
                    var editModal = `
                        <div class="custom-edit-modification-modal">
                            <div class="custom-modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLiveLabel">Modification</h5>
                                    <button type="button" class="btn-close custom-close-modal-button" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${selectBoxHtml}
                                    ${textBoxHtml}
                                </div>
                                <div class="modal-footer">
                                    <button class="custom-submit-button">Submit</button>
                                </div>
                            </div>
                        </div>
                    `;

                    $("body").append(editModal);
                    $(".custom-edit-modification-modal").css("display", "block");

                    $(".custom-close-modal-button").click(function () {
                        $(".custom-edit-modification-modal").remove();
                        $("body").removeClass("modification-model-open");
                    });

                    $(".custom-submit-button").click(function () {
                        var sizeValue = $("#custom-selectBox").val();
                        var messageValue = $("#custom-textBox").val();

                        $.ajax({
                            url: "/edit-modification-info",
                            type: "GET",
                            data: {
                                modification_id: selectedModificationId,
                                draft_product_id: draftProductId,
                                size: sizeValue,
                                message: messageValue
                            },
                            success: function (response) {
                                // Handle success
                            },
                            error: function (error) {
                                console.error("Error editing modification");
                            }
                        });

                        $(".custom-edit-modification-modal").remove();
                    });
                };

                var selectBoxHtml = '';
                var textBoxHtml = '';

                $.ajax({
                    url: "/get-modification-values",
                    type: "GET",
                    data: {
                        modification_id: selectedModificationId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        var selectOptions = `<option value="">Please Select</option>`;
                        var message_value = response.modificationData.message == null ? "" : response.modificationData.message;

                        response.values.forEach(function (value) {
                            var isSelected = (value == response.modificationData.size) ? 'selected' : '';
                            selectOptions += `<option value="${value}" ${isSelected}>${value}</option>`;
                        });

                        if (infoType === "integer_value" || infoType === "both") {
                            selectBoxHtml = `
                                <label class="form-label" for="custom-selectBox">${integer_lable}:</label>
                                <select id="custom-selectBox">
                                    ${selectOptions}
                                </select>
                            `;
                        }
                        if (infoType === "message" || infoType === "both") {
                            textBoxHtml = `
                                <label class="form-label" for="custom-textBox">${message_lable}:</label>
                                <input type="text" id="custom-textBox" value="${message_value}">
                            `;
                        }

                        buildEditModal(selectBoxHtml, textBoxHtml);
                    },
                    error: function (error) {
                        console.error("Error fetching modification values");
                    }
                });
            });

            $(document).on("click", ".modification-delete-icon", function (event) {
                event.stopPropagation();
                var modificationItem = $(this).closest(".modification-item");
                var selectedModificationId = modificationItem.data("modification-id");
                var productId = modificationItem.data("product-id");
                var draftStyleId = modificationItem.data("draft-id");
                var draftProductId = modificationItem.data("draft-product-id");

                $.ajax({
                    url: "/delete-modification-from-draft-product",
                    type: "GET",
                    data: {
                        modification_id: selectedModificationId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        if (response.deleted) {
                            modificationItem.removeClass("selected");
                            modificationItem.remove();
                            modificationItem.find(".modification-delete-icon").remove();
                            modificationItem.find(".edit-modification-button").remove();
                            $(".available-modifications").append(modificationItem);
                        }
                        updateSectionVisibility("modification");
                    },
                    error: function (error) {
                        console.error("Error deleting modification from draft_product table");
                    }
                });
            });

            function loadAccessories(productId, draftStyleId, selectedAccessorieId, draftProductId, targetElement) {
                $.ajax({
                    url: "/get-accessories-by-product",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        var accessoriesList = $(targetElement);
                        $(".selected-accessories").empty();
                        $(".available-accessories").empty();

                        response.forEach(function (accessorie) {
                            var isSelected = accessorie.is_selected ? 'selected' : '';
                            var deleteIcon = accessorie.is_selected ? '<i class="accessories-delete-icon icofont-trash"></i>' : '';

                            var accessorieItem = `
                                <div class="accessory-item ${isSelected}" data-product-id="${productId}" data-draft-id="${draftStyleId}" data-draft-product-id="${draftProductId}"
                                    data-accessorie-id="${accessorie.accessories_id}">
                                    ${accessorie.accessories_nm} - (Price - ${accessorie.accessories_price})
                                    ${deleteIcon}
                                </div>
                            `;

                            if (accessorie.is_selected) {
                                $(".selected-accessories").append(accessorieItem);
                            } else {
                                $(".available-accessories").append(accessorieItem);
                            }
                        });
                        updateSectionVisibility("accessories");
                    },
                    error: function (error) {
                        console.error("Error fetching accessories");
                    }
                });
            }

            $(document).on("click", ".accessory-item", function (event) {
                var accessorieItem = $(this);
                var isSelected = accessorieItem.hasClass("selected");
                if (isSelected) {
                    return;
                }
                var draftProductId = accessorieItem.data("draft-product-id");
                var selectedAccessorieId = accessorieItem.data("accessorie-id");

                $.ajax({
                    url: "/add-accessorie-to-draft-product",
                    type: "GET",
                    data: {
                        accessorie_id: selectedAccessorieId,
                        draftProductId: draftProductId
                    },
                    success: function (response) {
                        if (response.added) {
                            accessorieItem.detach();
                            accessorieItem.removeClass("selected");
                            accessorieItem.find(".accessories-delete-icon").remove();
                            accessorieItem.appendTo(".selected-accessories").append('<i class="accessories-delete-icon icofont-trash"></i>');
                            accessorieItem.addClass("selected");
                        } else {
                            accessorieItem.remove();
                        }
                        updateSectionVisibility("accessories");
                    },
                    error: function (error) {
                        console.error("Error adding accessory to draft_product table");
                    }
                });

                event.stopPropagation();
            });

            $(document).on("click", ".accessories-delete-icon", function (event) {
                event.stopPropagation();
                var accessorieItem = $(this).closest(".accessory-item");
                var selectedAccessorieId = accessorieItem.data("accessorie-id");
                var draftProductId = accessorieItem.data("draft-product-id");

                $.ajax({
                    url: "/delete-accessorie-from-draft-product",
                    type: "GET",
                    data: {
                        accessorie_id: selectedAccessorieId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        if (response.deleted) {
                            accessorieItem.removeClass("selected");
                            accessorieItem.remove();
                            accessorieItem.find(".accessories-delete-icon").remove();
                            $(".available-accessories").append(accessorieItem);
                        }
                        updateSectionVisibility("accessories");
                    },
                    error: function (error) {
                        console.error("Error deleting accessory from draft_product table");
                    }
                });
            });

            function updateSectionVisibility(section) {
                var availableModifications = $(".available-modifications");
                var selectedModifications = $(".selected-modifications");
                var availableAccessories = $(".available-accessories");
                var selectedAccessories = $(".selected-accessories");

                var hasAvailableModifications = availableModifications.find(".modification-item").length > 0;
                var hasSelectedModifications = selectedModifications.find(".modification-item").length > 0;
                var hasAvailableAccessories = availableAccessories.find(".accessory-item").length > 0;
                var hasSelectedAccessories = selectedAccessories.find(".accessory-item").length > 0;

                var activeSection = section;

                if (!hasAvailableModifications && !hasSelectedModifications && (hasAvailableAccessories || hasSelectedAccessories)) {
                    activeSection = "accessories";
                }

                availableModifications.toggle(hasAvailableModifications);
                selectedModifications.toggle(hasSelectedModifications);
                availableAccessories.toggle(hasAvailableAccessories);
                selectedAccessories.toggle(hasSelectedAccessories);

                $('.available-modifications-heading').toggle(hasAvailableModifications);
                $('.selcted-modifications-heading').toggle(hasSelectedModifications);
                $('.available-accessories-heading').toggle(hasAvailableAccessories);
                $('.selcted-accessories-heading').toggle(hasSelectedAccessories);

                $('.navbar-item[data-section="modification"]').toggle(hasAvailableModifications || hasSelectedModifications);
                $('.navbar-item[data-section="accessories"]').toggle(hasAvailableAccessories || hasSelectedAccessories);

                if (activeSection === "modification") {
                    $('.navbar-item[data-section="modification"]').click();
                } else {
                    $('.navbar-item[data-section="accessories"]').click();
                }
            }

            function loadDraftProducts(card) {
                var customerDraftId = card.find(".customer-draft-id").val();
                var draftStyleId = card.find(".draft-style-id").val();
                var tableId = "#product-table-" + draftStyleId;

                $.ajax({
                    url: "/get-draft-products",
                    type: "GET",
                    data: {
                        customer_draft_Id: customerDraftId,
                        draft_style_id: draftStyleId
                    },
                    success: function (response) {
                        var products = response.products.sort(function (a, b) {
                            return a.order - b.order;
                        });

                        if (products.length > 0) {
                            draft_product(response, tableId);
                            $('#product-cart-' + draftStyleId).show();
                        } else {
                            $('#product-cart-' + draftStyleId).hide();
                        }
                    },
                    error: function (error) {
                        console.error("Error fetching draft products");
                    }
                });
            }

            function draft_product(response, tableId) {
                var tableBody = $(tableId).find("tbody");
                tableBody.empty();
                var product_index = 1;

                response.products.forEach(function (data) {
                    var modificationNames = response.modificationNames[data.draft_product_id] || [];
                    var modificationHtml = '';
                    if (modificationNames.length > 0) {
                        modificationHtml = modificationNames.map(function (nameObj) {
                            if (nameObj.modification_nm !== null) {
                                return `${nameObj.modification_nm}<br>`;
                            }
                        }).join('');
                    }
                    if (modificationHtml.trim() === '') {
                        modificationHtml = 'None';
                    }

                    var accessoriesNames = response.accessoriesNames[data.draft_product_id] || [];
                    var accessoriesHtml = '';
                    if (accessoriesNames.length > 0) {
                        accessoriesHtml = accessoriesNames.map(function (nameObj) {
                            if (nameObj.accessories_nm !== null) {
                                return `${nameObj.accessories_nm}<br>`;
                            }
                        }).join('');
                    }
                    if (accessoriesHtml.trim() === '') {
                        accessoriesHtml = 'None';
                    }

                    var selectDropdown = $(`<select class="form-select form-control isCutDepth" name="is_cut_depth"></select>`);
                    if (data.is_cut_depth) {
                        var options = ['Yes', 'No'];
                        options.forEach(function (value) {
                            var option = $('<option></option>').attr('value', value).text(value);
                            if (value === data.is_cut_depth) {
                                option.attr('selected', 'selected');
                            }
                            selectDropdown.append(option);
                        });
                    }

                    selectDropdown.attr('data-product-id', data.product_id);
                    selectDropdown.attr('data-draft-Style-id', data.draft_style_id);
                    selectDropdown.attr('data-draft-product-id', data.draft_product_id);

                    var editButton = '';
                    if (data.modification_id_exists || data.accessories_id_exists) {
                        editButton = `
                            <button class="btn btn-outline-secondary edit-button" 
                                    data-draft-product-id="${data.draft_product_id}" 
                                    data-draft-Style-id="${data.draft_style_id}" 
                                    data-product-id="${data.product_id}">
                                <i class="icofont-ui-settings text-success"></i>
                            </button>
                        `;
                    } else {
                        editButton = `<button class="btn btn-outline-secondary no_modification_accessories"><i class="icofont-ui-settings text-success"></i></button>`;
                    }

                    var newRow = `
                        <tr class="clickable-row" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}" data-draft-product-id="${data.draft_product_id}">
                            <td style="width:50px;">
                                <span class="drag-handle icofont-drag"></span>
                                ${product_index}
                            </td>
                            <td style="width:14%;">
                                <div class="input-group">
                                    <input type="button" value="-" class="button-minus quantity-minus" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}" data-field="quantity">
                                    <input type="number" step="1" max="" value="${data.quantity}" name="quantity" class="quantity-field quantity-num" data-product-quantity="${data.quantity}" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}">
                                    <input type="button" value="+" class="button-plus quantity-plus" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}" data-field="quantity">
                                </div>
                            </td>
                            <td>${data.product_item_sku}</td>
                            <td style="width: 10%;" class="text-center">
                                ${data.cut_depth === 'Yes' ? `${selectDropdown.prop('outerHTML')}` : `<span class="text-center">None</span>`}
                            </td>
                            <td>${modificationHtml}</td>
                            <td>${accessoriesHtml}</td>
                            <td style="width:18%;">
                                ${data.is_hinge_side === 'Yes' ? `
                                    <div class="size-block">
                                        <div class="collapse show" id="size" style="">
                                            <div class="filter-size" id="filter-size-1">
                                                <ul>
                                                    <li class="hinge_li ${data.hinge_side === 'L' ? 'active' : ''}" data-hinge="L" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}">L</li>
                                                    <li class="hinge_li ${data.hinge_side === 'R' ? 'active' : ''}" data-hinge="R" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}">R</li>
                                                    ${data.hinge_side_none === 'Yes' ? `
                                                        <li class="hinge_li ${data.hinge_side === 'None' ? 'active' : ''}" data-hinge="None" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}" style="width: 47px;">None</li>
                                                    ` : ''}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>` : 'N/A'}
                            </td>
                            <td style="width: 22%;">
                                ${data.is_finish_side === 'Yes' ? `
                                    <div class="size-block">
                                        <div class="collapse show" id="size" style="">
                                            <div class="filter-size" id="filter-size-1">
                                                <ul>
                                                    <li class="finish_li ${data.finish_side === 'L' ? 'active' : ''}" data-finish="L" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}">L</li>
                                                    <li class="finish_li ${data.finish_side === 'R' ? 'active' : ''}" data-finish="R" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}">R</li>
                                                    <li class="finish_li ${data.finish_side === 'B' ? 'active' : ''}" data-finish="B" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}" style="width: 39px;">Both</li>
                                                    ${data.finish_side_none === 'Yes' ? `
                                                        <li class="finish_li ${data.finish_side === 'None' ? 'active' : ''}" data-finish="None" data-draft-product-id="${data.draft_product_id}" data-product-id="${data.product_id}" data-draft-style-id="${data.draft_style_id}" style="width: 47px;">None</li>
                                                    ` : ''}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>` : 'N/A'}
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <input type="text" value="${data.modification_id}" class="modification_id" hidden>
                                    <input type="text" value="${data.accessories_id}" class="accessorie_id" hidden>
                                    ${editButton}
                                    <a href="javascript:void(0)" onclick="deleteModal('${data.draft_product_id}')" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                    `;
                    tableBody.append(newRow);
                    product_index++;
                });
            }

            $(document).on("change", ".quantity-num", function (event) {
                var inputElement = $(this);
                var newQuantity = parseInt(inputElement.val());
                if (isNaN(newQuantity)) {
                    inputElement.val(inputElement.data("product-quantity"));
                    return;
                }

                var productId = $(this).data("product-id");
                var draftProductId = $(this).data("draft-product-id");
                var draftStyleId = $(this).data("draft-style-id");

                $.ajax({
                    url: "/quantity-update",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_style_id: draftStyleId,
                        new_quantity: newQuantity,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        var obj = JSON.parse(JSON.stringify(response));
                        if (obj.message != "") {
                            showAlert(obj.message);
                        }
                        inputElement.val(obj.quantity);
                    },
                    error: function (error) {
                        console.error("Error updating quantity");
                    }
                });
            });

            $(document).on("click", ".quantity-plus", function () {
                var productId = $(this).data("product-id");
                var draftProductId = $(this).data("draft-product-id");
                var draftStyleId = $(this).data("draft-style-id");
                var q = $(this).closest(".input-group").find(".quantity-num");

                $.ajax({
                    url: "/quantity-plus",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_style_id: draftStyleId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        var obj = JSON.parse(JSON.stringify(response));
                        if (obj.message != "") {
                            showAlert(obj.message);
                        }
                        q.val(response.quantity);
                    },
                    error: function (error) {
                        console.error("Error increasing quantity");
                    }
                });
            });

            $(document).on("click", ".quantity-minus", function () {
                var productId = $(this).data("product-id");
                var draftProductId = $(this).data("draft-product-id");
                var draftStyleId = $(this).data("draft-style-id");
                var q = $(this).closest(".input-group").find(".quantity-num");

                $.ajax({
                    url: "/quantity-minus",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_style_id: draftStyleId,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        q.val(response.quantity);
                    },
                    error: function (error) {
                        console.error("Error decreasing quantity");
                    }
                });
            });

            $(document).on("click", ".hinge_li", function () {
                var productId = $(this).data("product-id");
                var draftProductId = $(this).data("draft-product-id");
                var draftStyleId = $(this).data("draft-style-id");
                var hinge = $(this).data("hinge");
                var clickedLi = $(this);

                $.ajax({
                    url: "/add-hinge",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_style_id: draftStyleId,
                        hinge: hinge,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        var filterSizeContainer = clickedLi.closest(".filter-size");
                        filterSizeContainer.find(".hinge_li").removeClass("active");
                        clickedLi.addClass("active");
                    },
                    error: function (error) {
                        console.error("Error updating hinge");
                    }
                });
            });

            $(document).on("click", ".finish_li", function () {
                var productId = $(this).data("product-id");
                var draftStyleId = $(this).data("draft-style-id");
                var finish = $(this).data("finish");
                var draftProductId = $(this).data("draft-product-id");
                var clickedLi = $(this);

                $.ajax({
                    url: "/add-finish-side",
                    type: "GET",
                    data: {
                        product_id: productId,
                        draft_style_id: draftStyleId,
                        finish: finish,
                        draft_product_id: draftProductId
                    },
                    success: function (response) {
                        var filterSizeContainer = clickedLi.closest(".filter-size");
                        filterSizeContainer.find(".finish_li").removeClass("active");
                        clickedLi.addClass("active");
                    },
                    error: function (error) {
                        console.error("Error updating finish side");
                    }
                });
            });

            $(document).on("change", ".isCutDepth", function () {
                var IsselectedDepth = $(this).val();
                var productId = $(this).data('product-id');
                var draftProductId = $(this).data('draft-product-id');
                var draftStyleId = $(this).data("draft-style-id");
                var selectedModificationId = $(this).siblings(".modification_id").val();
                var selectedAccessorieId = $(this).siblings(".accessorie_id").val();

                $.ajax({
                    url: "/updateIsCutDepth",
                    type: "GET",
                    data: {
                        IsselectedDepth: IsselectedDepth,
                        productId: productId,
                        draftProductId: draftProductId
                    },
                    success: function (response) {
                        if (IsselectedDepth == "Yes") {
                            $(".navbar-item").click(function () {
                                const sectionToShow = $(this).data("section");
                                $(".navbar-item").removeClass("active");
                                $(this).addClass("active");
                                $(".section").removeClass("active");
                                $(".section." + sectionToShow + "-list").addClass("active");
                            });

                            $("#cutDepthModalLive").modal('show');
                            loadModifications(productId, draftStyleId, selectedModificationId, draftProductId, ".sidebar_model .modification-list");
                            loadAccessories(productId, draftStyleId, selectedAccessorieId, draftProductId, ".sidebar_model .accessories-list");
                            loadCutdepth(productId, draftStyleId, selectedAccessorieId, draftProductId, ".sidebar_model .cutdepth-list");
                        } else {
                            $(".sidebar_model").removeClass("open");
                            window.location.reload();
                        }
                    },
                    error: function (error) {
                        console.error("Error updating cut depth");
                    }
                });
            });

            $('.configButton').click(function (event) {
                event.preventDefault();
                var doorStyleId = $(this).data('door-style-id');
                var configuration = $(this).data('configuration');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    url: '/update-configuration',
                    method: 'get',
                    data: {
                        doorStyleId: doorStyleId,
                        configuration: configuration
                    },
                    success: function (response) {
                        console.log('Door style configuration updated successfully!');
                    },
                    error: function (error) {
                        console.error('Error updating door style configuration:', error);
                    }
                });
            });

            function toggleButton(buttonIndex, toggleGroup) {
                const buttons = document.querySelectorAll(`.${toggleGroup} .toggle-button`);
                const input = document.getElementById(`${toggleGroup}_input`);
                const newValue = buttons[buttonIndex].innerText;
                let valueToSend = '';

                if (toggleGroup === 'service_type') {
                    valueToSend = newValue;
                } else if (toggleGroup === 'configuration') {
                    if (newValue.includes('Assembled')) {
                        valueToSend = 'Assembled';
                    } else if (newValue.includes('Unassembled')) {
                        valueToSend = 'Unassembled';
                    }
                }

                $.ajax({
                    type: "get",
                    url: "/update-servie-configuration",
                    data: {
                        customer_draft_id: "{{ $customer_draft_Id }}",
                        toggle_group: toggleGroup,
                        new_value: valueToSend
                    },
                    success: function (response) {
                        buttons.forEach(button => button.classList.remove('active'));
                        buttons[buttonIndex].classList.add('active');
                        input.value = valueToSend;
                    },
                    error: function (error) {
                        console.error("Error updating service configuration");
                    }
                });
            }

            $(document).ready(function () {
                const setActiveButtonState = function (toggleGroup, value) {
                    const buttons = document.querySelectorAll(`.${toggleGroup} .toggle-button`);
                    const buttonIndex = Array.from(buttons).findIndex(button => button.innerText === value);
                    if (buttonIndex >= 0) {
                        buttons.forEach(button => button.classList.remove('active'));
                        buttons[buttonIndex].classList.add('active');
                    }
                };

                const setActiveButtonState1 = function (toggleGroup, value) {
                    const buttons = document.querySelectorAll(`.${toggleGroup} .toggle-button`);
                    const buttonValues = {
                        'Assembled': 'Assembled',
                        'Unassembled': 'Unassembled'
                    };
                    const dbValue = buttonValues[value] || value;

                    buttons.forEach((button, index) => {
                        const buttonText = button.innerText.trim();
                        if (buttonValues[buttonText] === dbValue) {
                            buttons.forEach(btn => btn.classList.remove('active'));
                            buttons[index].classList.add('active');
                        }
                    });
                };

                setActiveButtonState('service_type', $("#service_type_input").val());
                setActiveButtonState1('configuration', $("#configuration_input").val());
            });

            function deleteModal(id) {
                $("#exampleModalLive").modal('show');
                $('#yes').on('click', function (event) {
                    $("#conformation-modal").modal('hide');
                    $.ajax({
                        url: "{{ url('draft-product/delete/') }}/" + id,
                        type: 'GET',
                        dataType: 'html',
                        success: function (response) {
                            location.reload();
                        }
                    });
                });
            }

            function handleCutDepthValidation() {
                var isCutDepthVisible = $('.selcted-cutdepth-heading').is(':visible');
                var selectedCutDepth = document.querySelector(".selectcutDepth") ? document.querySelector(".selectcutDepth").value : '';
                var validationMessage = $("<div>", {
                    "class": "validation-message text-danger",
                    text: "Please select cut depth inch"
                });

                if (isCutDepthVisible && selectedCutDepth === "") {
                    $(".validation-message").remove();
                    $(".available-cutdepth").after(validationMessage);
                    return true;
                } else {
                    $(".validation-message").remove();
                    return false;
                }
            }

            document.querySelector(".close-sidebar").addEventListener("click", function (event) {
                location.reload();
            });

            document.querySelector(".save-sidebar").addEventListener("click", function (event) {
                location.reload();
            });

            document.querySelector(".save-cut-depth").addEventListener("click", function (event) {
                var validationTriggered = handleCutDepthValidation();
                if (!validationTriggered) {
                    location.reload();
                } else {
                    event.preventDefault();
                }
            });
        </script>
        <script type="text/javascript" src="{{asset('public/validation/CustomerDraftValidation.js')}}"></script>
    @endpush
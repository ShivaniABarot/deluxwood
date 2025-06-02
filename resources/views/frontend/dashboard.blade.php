@extends(backendView('layouts.app'))

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl">
        <div class="row g-3">
            <div class="mt-4 d-flex justify-content-end align-items-center flex-wrap gap-2">
                <!-- Search by PO Number -->
                <div class="d-flex align-items-center">
                    <label for="po-search" class="me-2 fw-bold mb-0">Search PO No</label>
                    <div class="input-group" style="width: 250px;">
                        <input type="text" id="po-search" class="form-control" placeholder="Search by PO Number">
                        <button class="btn btn-outline-secondary" type="button" id="clear-search">Clear</button>
                    </div>
                </div>
                <!-- Sort by PO Number Buttons -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <label class="fw-bold mb-0">Sort PO:</label>
                    <!-- ASC Sort Button -->
                    <button class="btn btn-uniform sort-btn active" data-sort="asc">
                        <i class="bi bi-sort-up-alt uniform-icon"></i>
                    </button>
                    <!-- DESC Sort Button -->
                    <button class="btn btn-uniform sort-btn" data-sort="desc">
                        <i class="bi bi-sort-down-alt uniform-icon"></i>
                    </button>
                    <!-- With CO (DUPLICATED DRAFTS) Button -->
                    <button class="btn btn-uniform sort-btn" data-sort="with-co">
                        With CO
                    </button>
                </div>
                <!-- View toggle buttons -->
                <div class="d-flex align-items-center">
                    <button id="card-view-btn" class="btn btn-uniform active" title="Card View">
                        <svg class="uniform-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="8" height="8" rx="2" />
                            <rect x="13" y="3" width="8" height="8" rx="2" />
                            <rect x="3" y="13" width="8" height="8" rx="2" />
                            <rect x="13" y="13" width="8" height="8" rx="2" />
                        </svg>
                    </button>
                    <button id="list-view-btn" class="btn btn-uniform" title="List View">
                        <svg class="uniform-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="2" />
                            <rect x="3" y="10" width="18" height="2" />
                            <rect x="3" y="16" width="18" height="2" />
                        </svg>
                    </button>
                </div>
                <!-- Add new draft -->
                <a href="{{ url('customer-draft') }}" class="btn btn-warning text-uppercase">Add Draft</a>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="tab-content mt-1">
                    <div class="tab-pane fade show active" id="summery-today">
                        <!-- Card View -->
                        <div class="row g-3 mb-3" id="draft-container-card">
                            @if($customer_draft->isNotEmpty())
                                @foreach($customer_draft as $data)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6" id="draft-{{ $data->customer_draft_id }}"
                                        data-po-number="{{ $data->po_number }}" data-total-price="{{ $data->total_price }}"
                                        data-draft-id="{{ $data->customer_draft_id }}">
                                        <div class="card card-custom">
                                            <div class="card-body text-center py-4">
                                                <!-- Door Style Image -->
                                                @php
                                                    $doorStyle = \App\Models\DoorStyle::find($data->door_style_id);
                                                    $doorStyleName = $doorStyle ? $doorStyle->name : 'Unknown Style';
                                                    $doorStyleImage = $doorStyle ? $doorStyle->image : 'default-image.jpg';
                                                @endphp
                                                <div class="items-image mb-3">
                                                    <img src="{{ asset('img/door_style/' . $doorStyleImage) }}"
                                                        alt="product"
                                                        style="width: 100px; height: 100px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);">
                                                </div>

                                                <!-- Draft Info -->
                                                <h5 class="card-title mb-2">Draft: {{ $data->customer_draft_id }}</h5>
                                                <p class="card-text mb-1">
                                                    <strong>PO:</strong> {{ $data->po_number }}<br>
                                                    <strong>Style:</strong> {{ $doorStyleName }}
                                                </p>
                                                <h4 class="card-price mb-3">${{ $data->total_price }}</h4>

                                                <!-- See Details Button -->
                                                @if($data->draft_status == "Save" || $data->draft_status == "Pending")
                                                    <a href="{{ url('add-cart') }}/{{ $data->customer_draft_id }}"
                                                        class="btn btn-add Oldsmobile btn btn-small mb-2">See Details</a>
                                                @else
                                                    <a href="{{ url('tracking-status/view') }}/{{ $data->customer_draft_id }}"
                                                        class="btn btn-small mb-2">See Details</a>
                                                @endif

                                                <!-- Duplicate and Delete Buttons -->
                                                <div style="display: flex; gap: 8px; justify-content: center;">
                                                    <button type="button" onclick="duplicateModal('{{ $data->customer_draft_id }}');"
                                                        class="btn btn-small mb-2">Duplicate</button>
                                                    <button type="button" onclick="deleteModal('{{ $data->customer_draft_id }}');"
                                                        class="btn btn-small mb-2 button1">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p>No drafts found.</p>
                                </div>
                            @endif
                        </div>

                        <!-- List View -->
                        <div id="draft-container-list" style="display: none;">
                            <table id="draft-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>DRAFT ID</th>
                                        <th>PO NUMBER</th>
                                        <th>STYLE</th>
                                        <th>TOTAL PRICE</th>
                                        <th>IMAGE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($customer_draft->isNotEmpty())
                                        @foreach($customer_draft as $data)
                                            <tr id="draft-list-{{ $data->customer_draft_id }}"
                                                data-po-number="{{ $data->po_number }}" data-total-price="{{ $data->total_price }}"
                                                data-draft-id="{{ $data->customer_draft_id }}">
                                                <td>{{ $data->customer_draft_id }}</td>
                                                <td>{{ $data->po_number }}</td>
                                                @php
                                                    $doorStyle = \App\Models\DoorStyle::find($data->door_style_id);
                                                    $doorStyleName = $doorStyle ? $doorStyle->name : 'Unknown Style';
                                                    $doorStyleImage = $doorStyle ? $doorStyle->image : 'default-image.jpg';
                                                @endphp
                                                <td>{{ $doorStyleName }}</td>
                                                <td>${{ $data->total_price }}</td>
                                                <td>
                                                    <img src="{{ asset('img/door_style/' . $doorStyleImage) }}" alt="product"
                                                        style="width: 60px; height: 80px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);">
                                                </td>
                                                <td>
                                                    @php
                                                        $isEditable = $data->draft_status === 'Save' || $data->draft_status === 'Pending';
                                                    @endphp
                                                    <a href="{{ url($isEditable ? 'add-cart' : 'tracking-status/view') }}/{{ $data->customer_draft_id }}"
                                                        class="btn btn-warning text-dark rounded-pill px-3 py-1 me-1">See Details</a>
                                                    <button type="button" onclick="duplicateModal('{{ $data->customer_draft_id }}')"
                                                        class="btn btn-secondary text-dark rounded-pill px-3 py-1 me-1">Duplicate</button>
                                                    <button type="button" onclick="deleteModal('{{ $data->customer_draft_id }}')"
                                                        class="btn btn-danger text-dark rounded-pill px-3 py-1">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">No drafts found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
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
                    <button type="button" class="btn btn-uniform" id="confirm-action">Yes</button>
                    <button type="button" class="btn btn-uniform" data-bs-dismiss="modal">No</button>
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
        /* Ensure the row behaves as a grid */
        #draft-container-card {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem; /* Matches Bootstrap's g-3 */
        }

        .card-custom {
    background: linear-gradient(135deg, #ffffff 0%, #f7f9fc 100%); /* Subtle white-to-light-gray gradient for a clean look */
    border: 1px solid #d1d5db; /* Soft gray border for definition */
    border-radius: 12px; /* Slightly larger rounded corners for elegance */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.03); /* Layered shadow for depth */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transitions */
    width: 100%; /* Ensure cards take full column width */
}

.card-custom:hover {
    transform: translateY(-3px); /* Subtle lift on hover */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.05); /* Enhanced shadow on hover */
}

.card-body {
    padding: 24px !important; /* Slightly more padding for a spacious feel */
}

.card-title {
    font-size: 1.2rem; /* Slightly larger for prominence */
    font-weight: 600; /* Medium-bold for clarity */
    color: #1f2937; /* Dark gray for a professional tone */
}

.card-text {
    font-size: 0.95rem; /* Slightly larger for readability */
    color: #4b5563; /* Medium gray for a softer contrast */
    line-height: 1.6; /* Better readability */
}

.card-price {
    font-size: 1.6rem; /* Slightly larger for emphasis */
    font-weight: 700; /* Bold for prominence */
    color: #111827; /* Near-black for strong contrast */
}
        /* Button styling for smaller buttons */
        .btn-small {
    background-color:rgb(207, 207, 207); /* Light gray background for a clean look */
    color: #1f2937; /* Dark gray text for professionalism */
    border: none;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover */
    flex: 1;
    text-align: center;
}

.btn-small:hover {
    background-color: #d1d5db; /* Slightly darker gray on hover */
    transform: translateY(-2px); /* Subtle lift on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow on hover */
    color: #111827; /* Near-black text on hover for consistency */
}

        

        /* Uniform button styling */
        .btn-uniform {
            background: linear-gradient(45deg, #6b7280, #9ca3af);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 8px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.5;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
        }

        .btn-uniform:hover {
            background: linear-gradient(45deg, #4b5563, #7c8794);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-uniform.active {
            background: linear-gradient(45deg, #ffcd39, #e2b220);
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
        }

        .btn-uniform:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .uniform-icon {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            vertical-align: middle;
        }

        .bi.uniform-icon {
            font-size: 20px;
            line-height: 1;
        }

        #card-view-btn, #list-view-btn {
            min-width: 48px;
        }

        #po-search, #clear-search {
            height: 36px;
        }

        #clear-search {
            border-left: none;
        }

        #clear-search:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        label[for="po-search"] {
            font-size: 1rem;
            color: #333;
        }

        .table th {
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Original styles for exempt buttons */
        .btn-white-border {
            background-color: white;
            border-top: 1px solid gray;
            border-bottom: 1px solid black;
            color: black;
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
        $(function () {
            // Initialize DataTables for the list view
            let table = $('#draft-table').DataTable({
                paging: true,
                searching: false, // Custom search handled manually
                ordering: true,
                info: true,
                responsive: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                order: [[1, 'asc']], // Default sort by PO Number
                columns: [
                    { data: 'customer_draft_id', orderable: true },
                    { data: 'po_number', orderable: true },
                    { data: 'style', orderable: true },
                    { data: 'total_price', orderable: true },
                    { data: 'image', orderable: false },
                    { data: 'action', orderable: false }
                ]
            });

            // Toggle between card and list views
            $('#card-view-btn').on('click', function () {
                $('#draft-container-card').show();
                $('#draft-container-list').hide();
                $(this).addClass('active');
                $('#list-view-btn').removeClass('active');
                applyCardViewFilterAndSort();
            });

            $('#list-view-btn').on('click', function () {
                $('#draft-container-list').show();
                $('#draft-container-card').hide();
                $(this).addClass('active');
                $('#card-view-btn').removeClass('active');
                applyListViewFilterAndSort();
            });

            // Search by PO Number
            $('#po-search').on('input', function () {
                let searchValue = $(this).val().toLowerCase();
                applyCardViewFilterAndSort();
                applyListViewFilterAndSort();
            });

            // Clear search button functionality
            $('#clear-search').on('click', function() {
                $('#po-search').val('');
                applyCardViewFilterAndSort();
                applyListViewFilterAndSort();
            });

            // Modal handling
            $('.modal-effect').on('click', function (e) {
                e.preventDefault();
                var effect = $(this).attr('data-effect');
                $('#exampleModalLive').addClass(effect);
                $('#exampleModalLive').modal('show');
            });

            $('#exampleModalLive').on('hidden.bs.modal', function (e) {
                $(this).removeClass(function (index, className) {
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

            $('#confirm-action').on('click', function (event) {
                $('#exampleModalLive').modal('hide');
                $.ajax({
                    url: "{{ url('draft/delete') }}/" + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            $('#draft-' + id).remove();
                            $('#draft-list-' + id).remove();
                        } else {
                            alert('Error deleting draft: ' + response.message);
                        }
                    },
                    error: function (xhr) {
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

            $('#confirm-action').on('click', function (event) {
                $('#exampleModalLive').modal('hide');
                $.ajax({
                    url: "{{ url('draft/duplicate') }}/" + id,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            window.location.href = "{{ url('dashboard') }}";
                        } else {
                            alert('Error duplicating draft: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        let errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                        alert('Error duplicating draft: ' + errorMsg);
                    }
                });
            });
        }

        let currentSort = 'asc';

        function applyCardViewFilterAndSort() {
            let searchValue = $('#po-search').val().toLowerCase();
            let container = $('#draft-container-card');
            let cards = container.find('.col-xl-3').get();

            cards = cards.filter(function (card) {
                let po = $(card).data('po-number').toString().toLowerCase();
                let matchesSearch = po.includes(searchValue);

                if (currentSort === 'with-co') {
                    return matchesSearch && po.includes('co');
                }
                return matchesSearch;
            });

            if (currentSort === 'asc' || currentSort === 'desc') {
                cards.sort(function (a, b) {
                    let poA = $(a).data('po-number').toString().toLowerCase();
                    let poB = $(b).data('po-number').toString().toLowerCase();
                    return currentSort === 'asc' ? poA.localeCompare(poB) : poB.localeCompare(poA);
                });
            }

            container.empty();
            $.each(cards, function (index, card) {
                container.append(card);
            });
        }

        function applyListViewFilterAndSort() {
            let searchValue = $('#po-search').val().toLowerCase();
            let table = $('#draft-table').DataTable();

            // Apply search filter
            table.search(searchValue).draw();

            // Apply sorting based on currentSort
            if (currentSort === 'asc') {
                table.order([[1, 'asc']]).draw();
            } else if (currentSort === 'desc') {
                table.order([[1, 'desc']]).draw();
            } else if (currentSort === 'with-co') {
                // Custom filter for "With CO"
                table.search('co').draw();
            }
        }

        $('.sort-btn').on('click', function () {
            $('.sort-btn').removeClass('active');
            $(this).addClass('active');
            currentSort = $(this).data('sort');
            applyCardViewFilterAndSort();
            applyListViewFilterAndSort();
        });
    </script>
@endpush
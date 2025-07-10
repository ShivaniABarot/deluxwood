@extends(backendView('layouts.app'))

@section('title', 'Drafts View')

<style>
    /* Your existing styles remain unchanged */
    .coupon-form {
        display: flex;
        margin-top: 25px;
        width: fit-content;
    }

    .coupon-input {
        flex: 1;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 5px 0 0 5px;
    }

    .coupon-button {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0 5px 5px 0;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    .btn-white-border {
        background-color: white;
        border-top: 1px solid gray;
        border-bottom: 1px solid black;
        color: black;
    }

    .grd_cls {
        height: 100%;
        border: 1px solid #000000;
        padding: 2px;
    }

    .dcc_cls {
        font-weight: 600 !important;
        padding-left: 14px;
        padding-top: 15px;
        font-size: 13px;
    }

    .pddc_cls {
        padding: 11px 0px 0px 35px;
        font-weight: 600;
        font-size: 10px;
    }

    .edit-buttons {
        display: flex;
        gap: 10px;
    }

    .edit-buttons .btn {
        background-color: #f1c40f;
        color: #fff;
        border: none;
    }

    .action-column .btn {
        background-color: transparent;
        border: none;
        color: #e74c3c;
    }
</style>

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">New Drafts</h3>
                <div class="ms-auto">
                    <a href="{{ route('withPrice', $customer_draft_id) }}" class="btn btn-warning py-2 px-5 btn-set-task w-sm-100">
                        <i class="icofont-download me-2 fs-6"></i>With Price
                    </a>
                    <a href="{{ route('withoutPrice', $customer_draft_id) }}" class="btn btn-warning py-2 px-5 btn-set-task w-sm-100">
                        <i class="icofont-download me-2 fs-6"></i>Without Price
                    </a>
                </div>
            </div>
        </div>
    </div>

    <label class="form-label" style="margin-left:8px;">PO: {{ $customer_draft->po_number ?? 'N/A' }}</label>
    <label class="form-label" style="margin-left:25px;">Draft Number: {{ $customer_draft_id }}</label>
    <label class="form-label" style="margin-left:25px;">Designer: {{ $customer_draft->designer ?? 'N/A' }}</label>

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
            <div class="card mb-3">
                @php 
                    $iteration = 0; 
                    $sub_total = 0; 
                    $ItemtotalPrice = 0;
                    $totalCutDepthPrice = 0;
                    $totalModificationPrice = 0;
                    $totalDoorStylePrice = 0;
                    $totalAccessoriesPrice = 0;
                    $hinge_value = 0;
                    $finish_value = 0;
                    $configurationDiscountSum = 0;
                    $taxRate = $taxRate ?? 0;
                    $shippingCost = $shippingCost ?? 0;
                @endphp

                @foreach ($products as $doorStyleId => $productList)
                    @php
                        $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                        $draftStyle = \App\Models\DoorStyle::leftJoin('customer_draft_style', 'customer_draft_style.door_style_Id', 'door_style.doorStyle_id')
                            ->where('customer_draft_style.door_style_Id', $doorStyleId)
                            ->where('customer_draft_style.customer_draft_Id', $customer_draft_id)
                            ->select('customer_draft_style.draft_style_id', 'customer_draft_style.configuration')
                            ->first();
                    @endphp

                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="single-item active">
                                    <div class="items-image">
                                        <img 
                                            src="{{ asset('img/door_style/' . ($doorStyle->image ?? 'default.jpg')) }}" 
                                            alt="Door Style" 
                                            style="width: 185px; height: 210px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text dcc_cls">
                                                    Door Style: {{ $doorStyle->name ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" class="door-style-id" name="doorStyleId" value="{{ $doorStyleId }}">
                                                <div>
                                                    <label class="form-label">Configuration</label><br>
                                                    <span class="btn btn-secondary w-sm-100">{{ $draftStyle->configuration ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>QTY.</th>
                                    <th>Sku</th>
                                    <th>Cut Depth</th>
                                    <th>Accessories</th>
                                    <th>Modification</th>
                                    <th class="text-center">Hinge Side</th>
                                    <th class="text-center">Finished End</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $product_index = 1; @endphp
                                @if (!empty($productList) && $productList->count() > 0)
                                    @foreach ($productList as $data)
                                        <tr>
                                            <td style="width:70px">{{ $product_index }}</td>
                                            <td style="width: 14%;">
                                                <div class="input-group">
                                                    <input type="button" value="-" class="button-minus quantity-minus" 
                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                        data-product-id="{{ $data->product_id }}" 
                                                        data-draft-style-id="{{ $data->draft_style_id }}" 
                                                        data-field="quantity">
                                                    <input type="number" step="1" max="" value="{{ $data->quantity }}" 
                                                        name="quantity" 
                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                        class="quantity-field quantity-num" 
                                                        data-product-quantity="{{ $data->quantity }}" 
                                                        data-product-id="{{ $data->product_id }}" 
                                                        data-draft-style-id="{{ $data->draft_style_id }}">
                                                    <input type="button" value="+" class="button-plus quantity-plus" 
                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                        data-product-id="{{ $data->product_id }}" 
                                                        data-draft-style-id="{{ $data->draft_style_id }}" 
                                                        data-field="quantity">
                                                </div>
                                            </td>
                                            <td>{{ $data->product_item_sku ?? 'N/A' }}</td>
                                            <td style="width: 10%;">
                                                @if (!empty($data->selected_cut_depth) && $data->is_cut_depth == 'Yes')
                                                    {{ $data->selected_cut_depth }}"
                                                @else
                                                    None
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->accessories_nm && $data->accessories_nm->count() > 0)
                                                    @foreach ($data->accessories_nm as $accessory)
                                                        @if (empty($accessory->accessories_nm))
                                                            None
                                                        @else
                                                            {{ $accessory->accessories_nm }}
                                                        @endif
                                                        @if (!$loop->last)<br>@endif
                                                    @endforeach
                                                @else
                                                    None
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->modification_nm && $data->modification_nm->count() > 0)
                                                    @foreach ($data->modification_nm as $modification)
                                                        @if (empty($modification->modification_nm))
                                                            None
                                                        @else
                                                            {{ $modification->modification_nm }}
                                                        @endif
                                                        @if (!$loop->last)<br>@endif
                                                    @endforeach
                                                @else
                                                    None
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 17%;">
                                                @if ($data->is_hinge_side == 'Yes')
                                                    <div class="size-block">
                                                        <div class="collapse show" id="size">
                                                            <div class="filter-size" id="filter-size-1">
                                                                <ul>
                                                                    <li class="hinge_li @if($data->hinge_side === 'L') active @endif" 
                                                                        data-hinge="L" 
                                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                                        data-product-id="{{ $data->product_id }}" 
                                                                        data-draft-style-id="{{ $data->draft_style_id }}">L</li>
                                                                    <li class="hinge_li @if($data->hinge_side === 'R') active @endif" 
                                                                        data-hinge="R" 
                                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                                        data-product-id="{{ $data->product_id }}" 
                                                                        data-draft-style-id="{{ $data->draft_style_id }}">R</li>
                                                                    @if ($data->hinge_side_none === 'Yes')
                                                                        <li class="hinge_li @if($data->hinge_side === 'None') active @endif" 
                                                                            style="width: 47px;" 
                                                                            data-hinge="None" 
                                                                            data-draft-product-id="{{ $data->draft_product_id }}" 
                                                                            data-product-id="{{ $data->product_id }}" 
                                                                            data-draft-style-id="{{ $data->draft_style_id }}">None</li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <center>N/A</center>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 20%;">
                                                @if ($data->is_finish_side == 'Yes')
                                                    <div class="size-block">
                                                        <div class="collapse show" id="size">
                                                            <div class="filter-size" id="filter-size-1">
                                                                <ul>
                                                                    <li class="finish_li @if($data->finish_side === 'L') active @endif" 
                                                                        data-finish="L" 
                                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                                        data-product-id="{{ $data->product_id }}" 
                                                                        data-draft-style-id="{{ $data->draft_style_id }}">L</li>
                                                                    <li class="finish_li @if($data->finish_side === 'R') active @endif" 
                                                                        data-finish="R" 
                                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                                        data-product-id="{{ $data->product_id }}" 
                                                                        data-draft-style-id="{{ $data->draft_style_id }}">R</li>
                                                                    <li class="finish_li @if($data->finish_side === 'B') active @endif" 
                                                                        data-finish="B" 
                                                                        data-draft-product-id="{{ $data->draft_product_id }}" 
                                                                        data-product-id="{{ $data->product_id }}" 
                                                                        data-draft-style-id="{{ $data->draft_style_id }}" 
                                                                        style="width: 39px;">Both</li>
                                                                    @if ($data->finish_side_none === 'Yes')
                                                                        <li class="finish_li @if($data->finish_side === 'None') active @endif" 
                                                                            data-finish="None" 
                                                                            data-draft-product-id="{{ $data->draft_product_id }}" 
                                                                            data-product-id="{{ $data->product_id }}" 
                                                                            data-draft-style-id="{{ $data->draft_style_id }}" 
                                                                            style="width: 47px;">None</li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <center>N/A</center>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="javascript:void(0)" 
                                                       onclick="deleteModal('{{ $data->draft_product_id }}');" 
                                                       class="btn btn-outline-secondary">
                                                       <i class="icofont-trash text-danger"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @php 
                                            $product_index++;
                                            // Update pricing totals
                                            $ItemtotalPrice += $data->item_total_price ?? 0;
                                            $sub_total += $data->product_total ?? 0;
                                            $totalCutDepthPrice += $data->cut_depth_total ?? 0;
                                            $totalModificationPrice += $data->modification_total ?? 0;
                                            $totalDoorStylePrice += $data->door_style_total ?? 0;
                                            $totalAccessoriesPrice += $data->accessories_total ?? 0;
                                            $hinge_value += $data->hinge_side_total ?? 0;
                                            $finish_value += $data->finish_side_total ?? 0;
                                        @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No products found for Door Style ID: {{ $doorStyleId }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @php 
                        $unassembled_discount = \App\Models\UnassembledDiscount::first();
                        $configurationDiscount = 0;
                        if ($draftStyle && $draftStyle->configuration === "Unassembled" && $unassembled_discount) {
                            $configurationDiscount = $sub_total * ($unassembled_discount->unassembled_discount / 100); 
                            $configurationDiscountSum += $configurationDiscount;
                        }
                        $iteration++; 
                    @endphp
                @endforeach  
            </div>

            <div class="card-body">
                <div class="product-cart">
                    <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap mt-2">
                        <div class="checkout-coupon">
                            <div class="row">
                                <div class="col-3">
                                    <label class="form-label">Service Type</label><br>
                                    <span class="btn btn-secondary w-sm-100">{{ $customer_draft->service_type ?? 'N/A' }}</span>
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">PO Number</label>
                                            <input type="text" class="form-control" value="{{ $customer_draft->po_number ?? 'N/A' }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Designer</label>
                                            <input type="text" class="form-control" value="{{ $customer_draft->designer ?? 'N/A' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-total ms-auto">
    <div class="single-total">
        <p class="value">Item Price:</p>
        <p class="price">${{ number_format($ItemtotalPrice, 2) }}</p>
    </div>
    <div class="single-total">
        <p class="value">Subtotal</p>
        <p class="price">${{ number_format($sub_total, 2) }}</p>
    </div>
    @if ($configurationDiscountSum > 0)
        <div class="single-total">
            <p class="value">Unassembled Discount:</p>
            <p class="price">{{ number_format($unassembled_discount->unassembled_discount ?? 0, 2) }}%</p>
        </div>
    @endif
    @if (isset($taxRate) && $taxRate > 0)
        <div class="single-total">
            <p class="value">Tax:</p>
            <p class="price">{{ number_format($taxRate, 2) }}%</p>
        </div>
    @endif
    <div class="single-total total-payable">
        <p class="value">Total:</p>
        <p class="price">${{ number_format($discountedPrice, 2) }}</p>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('dist/assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('scripts')
<script src="{{ asset('dist/assets/bundles/dataTables.bundle.js') }}"></script>
<script>
$(document).ready(function() {
    $('.table').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
    });
});
</script>
@endpush
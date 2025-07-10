@extends(backendView('layouts.app'))
@section('title', 'Add Draft')

@section('content')
<style>
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

    .popup {
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        z-index: 9999;
    }

    .popup.show {
        display: block;
    }

    .alert-box {
        display: none;
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px 20px;
        border-radius: 5px;
        z-index: 9999;
    }

    .alert-box.show {
        display: block;
    }
</style>

<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">New Drafts</h3>
                <div class="ms-auto">
                    <button class="btn btn-dark py-2 px-5 btn-set-task w-sm-100" id="refreshButton" data-action="save" data-custom-value="{{ $customer_draft_Id }}">Refresh</button>
                    <a href="{{ url('with-price') }}/{{ $customer_draft_Id }}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>With Price</a>
                    <a href="{{ url('without-price') }}/{{ $customer_draft_Id }}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100"><i class="icofont-download me-2 fs-6"></i>Without Price</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3">
        <label class="form-label">PO: {{ $customer_draft->po_number }}</label>
        <label class="form-label">Draft Number: {{ $customer_draft_Id }}</label>
        <label class="form-label">Designer: {{ $customer_draft->designer }}</label>
    </div>

    @if (session('success'))
        <div class="alert alert-success col-4" style="margin-left: auto;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger col-4" style="margin-left: auto;">
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
                @endphp

                @foreach ($products as $doorStyleId => $products)
                    @php
                        $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                        $draftStyle = \App\Models\DoorStyle::leftJoin('customer_draft_style', 'customer_draft_style.door_style_Id', 'door_style.doorStyle_id')
                            ->where('customer_draft_style.door_style_Id', '=', $doorStyleId)
                            ->where('customer_draft_style.customer_draft_Id', '=', $customer_draft_Id)
                            ->select('customer_draft_style.draft_style_id', 'customer_draft_style.configuration')
                            ->first();
                    @endphp

                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="single-item active">
                                    <div class="items-image">
                                        @if ($doorStyle && $doorStyle->image)
                                            <img src="{{ asset('img/door_style/' . $doorStyle->image) }}" alt="Door Style" class="img-fluid" style="width: 185px; height: 210px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color); cursor: pointer;">
                                        @else
                                            <img src="{{ asset('img/no-image.png') }}" alt="No Image" class="img-fluid" style="width: 185px; height: 210px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color); cursor: pointer;">
                                        @endif
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Configuration</label><br>
                                                @if ($draftStyle && $draftStyle->configuration)
                                                    <a href="#" class="btn btn-secondary w-sm-100">{{ $draftStyle->configuration }}</a>
                                                @else
                                                    <a href="#" class="btn btn-outline-secondary w-sm-100 disabled">No Configuration</a>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" class="door-style-id" name="doorStyleId_id" value="{{ $doorStyleId }}">
                                                @if ($iteration === 0)
                                                    <div style="display: flex; gap: 10px;">
                                                        <a href="{{ url('new-draft') }}/{{ $customer_draft_Id }}" class="btn btn-outline-warning text-uppercase nx_cls">Edit Draft</a>
                                                        <a href="{{ url('customer-draft-edit/' . $customer_draft_Id) }}" class="btn btn-outline-warning text-uppercase nx_cls">Edit Basic Info</a>
                                                    </div>
                                                @endif
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
                                @foreach ($products as $data)
                                    @if (is_object($data) && isset($data->product_item_price))
                                        @php
                                            $price = $data->product_item_price;
                                            $sides = DB::table('product_item')->where('product_id', $data->product_id)->first();

                                            // Hinge Side Pricing
                                            if ($sides && property_exists($sides, 'hinge_side') && $sides->hinge_side == 'Yes') {
                                                $hinge_price = DB::table('product_item_hinge_side')->where('product_id', $data->product_id)->first();
                                                if ($data->hinge_side == 'L') {
                                                    $price += $hinge_price->left_hinge_side_price ?? 0;
                                                    $hinge_value += ($hinge_price->left_hinge_side_price ?? 0) * $data->quantity;
                                                } elseif ($data->hinge_side == 'R') {
                                                    $price += $hinge_price->right_hinge_side_price ?? 0;
                                                    $hinge_value += ($hinge_price->right_hinge_side_price ?? 0) * $data->quantity;
                                                } elseif ($data->hinge_side == 'B') {
                                                    $price += $hinge_price->both_hinge_side_price ?? 0;
                                                    $hinge_value += ($hinge_price->both_hinge_side_price ?? 0) * $data->quantity;
                                                }
                                            }

                                            // Finish Side Pricing
                                            if ($sides && property_exists($sides, 'finish_side') && $sides->finish_side == 'Yes') {
                                                $finish_price = DB::table('product_item_finish_side')->where('product_id', $data->product_id)->first();
                                                if ($data->finish_side == 'L') {
                                                    $price += $finish_price->left_finish_side_price ?? 0;
                                                    $finish_value += ($finish_price->left_finish_side_price ?? 0) * $data->quantity;
                                                } elseif ($data->finish_side == 'R') {
                                                    $price += $finish_price->right_finish_side_price ?? 0;
                                                    $finish_value += ($finish_price->right_finish_side_price ?? 0) * $data->quantity;
                                                } elseif ($data->finish_side == 'B') {
                                                    $price += $finish_price->both_finish_side_price ?? 0;
                                                    $finish_value += ($finish_price->both_finish_side_price ?? 0) * $data->quantity;
                                                }
                                            }

                                            // Door Style Price
                                            $DoorPrice = DB::table('draft_product')
                                                ->selectRaw('SUM(product_door_style.doorstyle_price * draft_product.quantity) AS total_doorstyle_price')
                                                ->where('draft_product.draft_product_id', $data->draft_product_id)
                                                ->join('customer_draft_style', 'draft_product.draft_style_id', '=', 'customer_draft_style.draft_style_id')
                                                ->join('product_door_style', function ($join) {
                                                    $join->on('customer_draft_style.door_style_Id', '=', 'product_door_style.door_style_id')
                                                         ->on('draft_product.product_id', '=', 'product_door_style.product_id');
                                                })->value('total_doorstyle_price') ?? 0;
                                            $totalDoorStylePrice += $DoorPrice;

                                            // Modification Price
                                            $ModificationPrice = DB::table('draft_product')
                                                ->selectRaw('SUM(item_modification.modification_price * draft_product.quantity) AS total_modification_price')
                                                ->where('draft_product.draft_product_id', $data->draft_product_id)
                                                ->join('draft_product_modification', 'draft_product.draft_product_id', '=', 'draft_product_modification.draft_product_id')
                                                ->join('item_modification', function ($join) {
                                                    $join->on('draft_product_modification.modification_id', '=', 'item_modification.modification_id')
                                                         ->on('draft_product.product_id', '=', 'item_modification.product_id');
                                                })->value('-toal_modification_price') ?? 0;
                                            $totalModificationPrice += $ModificationPrice;

                                            // Accessories Price
                                            $AccessoriesPrice = DB::table('draft_product')
                                                ->selectRaw('SUM(item_accessories.accessories_price * draft_product.quantity) AS total_accessories_price')
                                                ->where('draft_product.draft_product_id', $data->draft_product_id)
                                                ->join('draft_product_accessories', 'draft_product.draft_product_id', '=', 'draft_product_accessories.draft_product_id')
                                                ->join('item_accessories', function ($join) {
                                                    $join->on('draft_product_accessories.accessories_id', '=', 'item_accessories.accessories_id')
                                                         ->on('draft_product.product_id', '=', 'item_accessories.product_id');
                                                })->value('total_accessories_price') ?? 0;
                                            $totalAccessoriesPrice += $AccessoriesPrice;

                                            // Cut Depth Price
                                            if ($data->cut_depth == 'Yes' && $data->is_cut_depth == 'Yes') {
                                                $price += $data->cut_depth_price;
                                                $totalCutDepthPrice += $data->cut_depth_price * $data->quantity;
                                            }

                                            // Item Dimensions Price
                                            $sumOfProductPrice = DB::table('item_dimensions')->where('product_id', $data->product_id)->sum('item_price');
                                            $price += $sumOfProductPrice;
                                            $price *= $data->quantity;
                                            $productTotalPrice = $data->product_item_price * $data->quantity;
                                            $ItemtotalPrice += $productTotalPrice + $DoorPrice;
                                            $sub_total += $price + $ModificationPrice + $AccessoriesPrice + $DoorPrice;
                                        @endphp

                                        <tr>
                                            <td>{{ $product_index }}</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="button" value="-" class="button-minus quantity-minus" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}" data-field="quantity">
                                                    <input type="number" step="1" value="{{ $data->quantity }}" name="quantity" data-draft-product-id="{{ $data->draft_product_id }}" class="quantity-field quantity-num" data-product-quantity="{{ $data->quantity }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">
                                                    <input type="button" value="+" class="button-plus quantity-plus" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}" data-field="quantity">
                                                </div>
                                            </td>
                                            <td>{{ $data->product_item_sku }}</td>
                                            <td>
                                                @if (!empty($data->selected_cut_depth) && $data->is_cut_depth == 'Yes')
                                                    {{ $data->selected_cut_depth }}"
                                                @else
                                                    None
                                                @endif
                                            </td>
                                            <td>
                                                @foreach ($data->accessories_nm as $accessoryName)
                                                    {{ $accessoryName->accessories_nm ?: 'None' }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($data->modification_nm as $modificationName)
                                                    {{ $modificationName->modification_nm ?: 'None' }}<br>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @if ($data->is_hinge_side == 'Yes')
                                                    <div class="size-block">
                                                        <div class="collapse show" id="size">
                                                            <div class="filter-size" id="filter-size-1">
                                                                <ul>
                                                                    <li class="hinge_li {{ $data->hinge_side === 'L' ? 'active' : '' }}" data-hinge="L" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">L</li>
                                                                    <li class="hinge_li {{ $data->hinge_side === 'R' ? 'active' : '' }}" data-hinge="R" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">R</li>
                                                                    @if ($data->hinge_side_none === 'Yes')
                                                                        <li class="hinge_li {{ $data->hinge_side === 'None' ? 'active' : '' }}" data-hinge="None" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">None</li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <center>N/A</center>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($data->is_finish_side == 'Yes')
                                                    <div class="size-block">
                                                        <div class="collapse show" id="size">
                                                            <div class="filter-size" id="filter-size-1">
                                                                <ul>
                                                                    <li class="finish_li {{ $data->finish_side === 'L' ? 'active' : '' }}" data-finish="L" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">L</li>
                                                                    <li class="finish_li {{ $data->finish_side === 'R' ? 'active' : '' }}" data-finish="R" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">R</li>
                                                                    <li class="finish_li {{ $data->finish_side === 'B' ? 'active' : '' }}" data-finish="B" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">Both</li>
                                                                    @if ($data->finish_side_none === 'Yes')
                                                                        <li class="finish_li {{ $data->finish_side === 'None' ? 'active' : '' }}" data-finish="None" data-draft-product-id="{{ $data->draft_product_id }}" data-product-id="{{ $data->product_id }}" data-draft-style-id="{{ $data->draft_style_id }}">None</li>
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
                                                    <a href="javascript:void(0)" onclick="deleteModal('{{ $data->draft_product_id }}');" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $product_index++; @endphp
                                    @else
                                        <tr><td colspan="9">Invalid product data.</td></tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @php
                        $unassembled_discount = \App\Models\UnassembledDiscount::find(1);
                        if ($draftStyle && $draftStyle->configuration == 'Unassembled') {
                            $configurationDiscount = $sub_total * ($unassembled_discount->unassembled_discount / 100);
                            $configurationDiscountSum += $configurationDiscount;
                        }
                        $iteration++;
                    @endphp
                @endforeach
            </div>

            @php
                $used_coupon = DB::table('used_coupon_history')
                    ->leftJoin('coupon_master', 'coupon_master.coupon_id', '=', 'used_coupon_history.coupon_id')
                    ->select('coupon_master.coupon_name', 'coupon_master.discount_type', 'coupon_master.expiry_date', 'used_coupon_history.*')
                    ->where('draft_id', $customer_draft_Id)
                    ->get();
            @endphp

            @if ($used_coupon->isNotEmpty())
                <h4><b>Coupons</b></h4><br>
                <div class="card mb-3">
                    <div class="table-container">
                        <table class="table table-hover align-middle mb-0" id="coupon_table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Coupon Name</th>
                                    <th>Discount</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($used_coupon as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>
                                            @if ($coupon->discount_type == 'Percentage')
                                                {{ $coupon->discount }}%
                                            @else
                                                ${{ $coupon->discount }}
                                            @endif
                                        </td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="javascript:void(0)" onclick="CouponDeleteModal('{{ $coupon->coupon_history_id }}');" class="btn btn-outline-secondary"><i class="icofont-trash text-danger"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="card-body">
                <div class="product-cart">
                    <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap mt-2">
                        <div class="checkout-coupon">
                            <div class="row">
                                <div class="col-3">
                                    <label class="form-label">Service Type</label><br>
                                    <a href="#" class="btn btn-secondary w-sm-100">{{ $customer_draft->service_type }}</a>
                                </div>
                                <div class="col-5">
                                    <form class="coupon-form" method="POST" id="coupon-form" action="{{ url('use-coupon') }}/{{ $customer_draft_Id }}" onsubmit="event.preventDefault(); submitForm();">
                                        @csrf
                                        <input type="text" class="coupon-input" name="coupon_code" placeholder="Coupon Code (optional)" required>
                                        <input type="hidden" name="subtotal" value="{{ $sub_total }}">
                                        <input type="hidden" id="hiddenInput" name="total_price">
                                        <button type="submit" class="coupon-button btn-secondary" id="coupon_submit">Apply Coupon</button>
                                    </form>
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">PO Number</label>
                                            <input type="text" class="form-control" value="{{ $customer_draft->po_number }}" id="po_number" data-customer-draft-id="{{ $customer_draft_Id }}" name="po_number" placeholder="Please enter PO number">
                                            <span class="text-danger kt-form__help error po_number"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Designer</label>
                                            <input type="text" class="form-control" name="designer" id="designer" value="{{ $customer_draft->designer }}" data-customer-draft-id="{{ $customer_draft_Id }}" placeholder="Please enter designer">
                                            <span class="text-danger kt-form__help error designer"></span>
                                        </div>
                                    </div>
                                    <label class="form-label" style="margin-top:30px;">Note</label>
                                    <textarea class="form-control" rows="3" id="customer_note" data-customer-draft-id="{{ $customer_draft_Id }}" name="customer_note" placeholder="Please enter note" style="resize: none;">{{ $customer_draft->customer_note }}</textarea>
                                    <span class="text-danger kt-form__help error customer_note"></span>
                                    <span id="customer_note_error" style="color:red; display:none;">Note cannot exceed 300 characters.</span>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-total">
                            @if ($totalModificationPrice != 0)
                                <div class="single-total">
                                    <p class="value">Modification Price:</p>
                                    <p class="price">${{ number_format($totalModificationPrice, 2) }}</p>
                                </div>
                            @endif
                            @if ($totalAccessoriesPrice != 0)
                                <div class="single-total">
                                    <p class="value">Accessories Price:</p>
                                    <p class="price">${{ number_format($totalAccessoriesPrice, 2) }}</p>
                                </div>
                            @endif
                            @if ($totalCutDepthPrice != 0)
                                <div class="single-total">
                                    <p class="value">Cut Depth Price:</p>
                                    <p class="price" id="totalCutDepthPrice">${{ number_format($totalCutDepthPrice, 2) }}</p>
                                </div>
                            @endif
                            @if ($hinge_value != 0)
                                <div class="single-total">
                                    <p class="value">Hinge Side:</p>
                                    <p class="price">${{ number_format($hinge_value, 2) }}</p>
                                </div>
                            @endif
                            @if ($finish_value != 0)
                                <div class="single-total">
                                    <p class="value">Finish Side:</p>
                                    <p class="price">${{ number_format($finish_value, 2) }}</p>
                                </div>
                            @endif
                            <div class="single-total">
                                <p class="value">Item Price:</p>
                                <p class="price" id="item_price">${{ number_format($ItemtotalPrice, 2) }}</p>
                            </div>
                            <div class="single-total">
                                <p class="value">Subtotal:</p>
                                <p class="price" id="sub_total">${{ number_format($sub_total, 2) }}</p>
                            </div>
                            @if ($configurationDiscountSum != 0)
                                <div class="single-total">
                                    <p class="value">Unassembled Discount:</p>
                                    <p class="price" id="discount">{{ $unassembled_discount->unassembled_discount }}%</p>
                                </div>
                            @endif
                            @if ($customer_draft->discount != '')
                                <div class="single-total">
                                    <p class="value">Total Discount:</p>
                                    <p class="price" id="discount">{{ $customer_draft->discount }}%</p>
                                </div>
                            @endif

                            @php
$discountedPrice = $sub_total;
if ($configurationDiscountSum != 0) {
    $discountedPrice -= $configurationDiscountSum;
}
$groupDiscount = $discountedPrice * ($customer_draft->discount / 100);
$discountedPrice -= $groupDiscount;

$taxGroupDiscount = 0;
// Check if $taxGroup is defined and has the property
if (isset($taxGroup) && $taxGroup->tax_group == 'With Tax') {
    if ($customer_draft->service_type == 'Self Pickup') {
        $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
    } elseif ($customer_draft->service_type == 'Curbside Delivery') {
        $taxRate = $customer_draft->zipcode_tax_rate ?? 0;
        $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
    } else {
        $taxRate = $customer_draft->zipcode_tax_rate ?? 0;
        $taxGroupDiscount = $discountedPrice * ($taxRate / 100);
    }
    $discountedPrice += ceil($taxGroupDiscount * 100) / 100;
}

foreach ($used_coupon as $coupon) {
    if ($coupon->discount_type == 'Percentage') {
        $couponDiscount = $discountedPrice * ($coupon->discount / 100);
        $discountedPrice -= $couponDiscount;
    } else {
        $discountedPrice -= $coupon->discount;
    }
    echo '<div class="single-total"><label class="value">' . $coupon->coupon_name . '</label><p class="price">' . ($coupon->discount_type == 'Percentage' ? $coupon->discount . '%' : '$' . $coupon->discount) . '</p></div>';
}

//$discountedPrice += $shippingCost;
@endphp

@isset($taxGroup)
    @if ($taxGroup->tax_group == 'With Tax')
        <div class="single-total">
            <p class="value">Tax:</p>
            <p class="price" id="discount">{{ $taxRate ?? 'N/A' }}%</p>
        </div>
    @endif
@endisset
@if (($shippingCost ?? 0) != 0)
    <div class="single-total">
        <label class="value">Shipping Cost</label>
        <p class="price">${{ number_format($shippingCost ?? 0, 2) }}</p>
    </div>
@endif
                            <div class="single-total total-payable">
                                <p class="value">Total:</p>
                                <p class="price" id="discountedPrice">${{ number_format($discountedPrice, 2) }}</p>
                            </div>
                            <input type="hidden" id="total_price" value="{{ number_format($discountedPrice, 2) }}">
                        </div>

                        @if ($discountedPrice <= 0.5)
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-sm-2">
                                        <div class="single-btn w-sm-100 svbt_cls">
                                            <a href="#" class="btn btn-dark w-sm-100 adcr_cls" id="saveButton" data-action="save" data-custom-value="{{ $customer_draft_Id }}">Save</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @php
                                $a = $customer->pay_later == 'Yes' ? 4 : 6;
                                $b = $customer->pay_later == 'Yes' ? 4 : 3;
                                $c = $customer->pay_later == 'Yes' ? 8 : 9;
                            @endphp
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-{{ $c }}"></div>
                                    <div class="row col-md-{{ $b }}">
                                        <div class="col-{{ $a }}">
                                            <div class="single-btn w-sm-100 pcor_cls">
                                                <a href="#" class="btn btn-dark w-sm-100 adcr_cls" id="saveButton" data-action="save" data-custom-value="{{ $customer_draft_Id }}">Save</a>
                                            </div>
                                        </div>
                                        <div class="col-{{ $a }}">
                                            <div class="single-btn w-sm-100 pcor_cls">
                                                <a href="#" class="btn btn-dark w-sm-100 adcr_cls {{ $discountedPrice <= 0.5 ? 'disabled' : '' }}" id="placeOrderButton" data-action="order" data-custom-value="{{ $customer_draft_Id }}">Place Order</a>
                                            </div>
                                        </div>
                                        @if ($customer->pay_later == 'Yes')
                                            <div class="col-{{ $a }}">
                                                <div class="single-btn w-sm-100 pcor_cls">
                                                    <a href="#" class="btn btn-dark w-sm-100 adcr_cls {{ $discountedPrice <= 0.5 ? 'disabled' : '' }}" id="pay_later" data-action="pay_later" data-custom-value="{{ $customer_draft_Id }}">Pay Later</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="popup" class="popup"></div>
            <div id="alertBox" class="alert-box">
                <span id="alertMessage" class="alert-message"></span>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="exampleModalLive" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Delete Draft Product</h5>
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

    <!-- Delete Coupon Modal -->
    <div class="modal fade" id="CouponModalLive" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CouponModalLiveLabel">Delete Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this coupon?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="coupon_yes">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_styles')
<style>
    .btn-white-border {
        background-color: white;
        border-top: 1px solid gray;
        border-bottom: 1px solid black;
        color: black;
    }

    .btn-light:focus {
        background-color: #eca72f !important;
    }

    .grd_cls {
        height: 100%;
        border: 1px solid #000000;
        padding: 2px;
    }

    .adcr_cls {
        width: 115px;
    }

    .pcor_cls {
        padding-top: 14px;
    }

    .dcc_cls {
        font-weight: 600 !important;
        padding-left: 14px;
        padding-top: 15px;
        font-size: 13px;
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
</style>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('dist/assets/plugin/datatables/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('scripts')
<script src="{{ asset('dist/assets/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('dist/assets/bundles/dataTables.bundle.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@endpush

@push('custom_scripts')
<script>
    let editorInstance;

    ClassicEditor
        .create(document.querySelector('#customer_note'), {
            toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote']
        })
        .then(editor => {
            editorInstance = editor;
            editor.model.document.on('change:data', () => {
                const customer_draft_id = $('#customer_note').data('customer-draft-id');
                const note = editor.getData();
                if (note.length > 300) {
                    $('#customer_note_error').show();
                    return;
                }
                $('#customer_note_error').hide();
                $.ajax({
                    url: '/customer_note_update',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        customer_draft_id: customer_draft_id,
                        note: note
                    },
                    success: function(response) {
                        console.log('Note updated:', response);
                    },
                    error: function(error) {
                        console.error('Note update failed:', error);
                    }
                });
            });
        })
        .catch(error => {
            console.error('Editor initialization failed:', error);
        });

    function showPopup(message) {
        const popup = $('#popup');
        popup.text(message).addClass('show');
        setTimeout(() => popup.removeClass('show'), 2000);
    }

    function showAlert(message) {
        const alertBox = $('#alertBox');
        $('#alertMessage').text(message);
        alertBox.addClass('show');
        setTimeout(() => alertBox.removeClass('show'), 2000);
    }

    function submitForm() {
        const total_price = $('#total_price').val();
        $('#hiddenInput').val(total_price);
        const form = $('#coupon-form');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                showPopup('Coupon applied successfully');
                window.location.reload();
            },
            error: function(error) {
                showAlert('Failed to apply coupon: ' + (error.responseJSON?.message || 'Unknown error'));
            }
        });
    }

    $(document).ready(function() {
        function updateCart(response) {
            $('#totalCutDepthPrice').text('$' + Number(response.totalCutDepthPrice).toFixed(2));
            $('#sub_total').text('$' + Number(response.sub_total).toFixed(2));
            $('#item_price').text('$' + Number(response.item_price).toFixed(2));
            $('#discountedPrice').text('$' + Number(response.discountedPrice).toFixed(2));
            if (response.discountedPrice <= 0.5) {
                $('#placeOrderButton, #quickbooks, #pay_later').addClass('disabled');
            } else {
                $('#placeOrderButton, #quickbooks, #pay_later').removeClass('disabled');
            }
            if (response.message) {
                showPopup(response.message);
            }
        }

        $('#refreshButton, #saveButton, #quickbooks, #placeOrderButton, #pay_later').on('click', function(event) {
            event.preventDefault();
            const action = $(this).data('action');
            const customerDraftId = $(this).data('custom-value');
            const discountedPrice = parseFloat($('#discountedPrice').text().replace('$', ''));
            const subTotal = parseFloat($('#sub_total').text().replace('$', ''));

            if (action === 'save') {
                const url = `{{ url('save-draft') }}/save/${customerDraftId}/${discountedPrice}/${subTotal}`;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(error) {
                        showAlert('Failed to save draft: ' + (error.responseJSON?.message || 'Unknown error'));
                    }
                });
            } else {
                const encryptedData = btoa(JSON.stringify({
                    action: action,
                    customerDraftId: customerDraftId,
                    discountedPrice: discountedPrice,
                    subTotal: subTotal
                }));
                window.location.href = `{{ route('checkout_form') }}?data=${encodeURIComponent(encryptedData)}`;
            }
        });

        $(document).on('change', '.quantity-num', function() {
            const input = $(this);
            const newQuantity = parseInt(input.val());
            if (isNaN(newQuantity) || newQuantity < 1) {
                input.val(input.data('product-quantity'));
                return;
            }
            const productId = input.data('product-id');
            const draftProductId = input.data('draft-product-id');
            const draftStyleId = input.data('draft-style-id');
            $.ajax({
                url: '/quantity-update',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                    draft_style_id: draftStyleId,
                    new_quantity: newQuantity,
                    draft_product_id: draftProductId
                },
                success: function(response) {
                    input.val(response.quantity);
                    updateCart(response);
                },
                error: function(error) {
                    showAlert('Failed to update quantity: ' + (error.responseJSON?.message || 'Unknown error'));
                }
            });
        });

        $(document).on('click', '.quantity-plus, .quantity-minus', function() {
            const isPlus = $(this).hasClass('quantity-plus');
            const input = $(this).closest('.input-group').find('.quantity-num');
            const productId = $(this).data('product-id');
            const draftProductId = $(this).data('draft-product-id');
            const draftStyleId = $(this).data('draft-style-id');
            if (!isPlus && input.val() <= 1) return;
            $.ajax({
                url: isPlus ? '/quantity-plus' : '/quantity-minus',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                    draft_style_id: draftStyleId,
                    draft_product_id: draftProductId
                },
                success: function(response) {
                    input.val(response.quantity);
                    updateCart(response);
                },
                error: function(error) {
                    showAlert('Failed to update quantity: ' + (error.responseJSON?.message || 'Unknown error'));
                }
            });
        });

        $(document).on('click', '.hinge_li', function() {
            const productId = $(this).data('product-id');
            const draftProductId = $(this).data('draft-product-id');
            const draftStyleId = $(this).data('draft-style-id');
            const hinge = $(this).data('hinge');
            const clickedLi = $(this);
            $.ajax({
                url: '/add-hinge',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                    draft_style_id: draftStyleId,
                    hinge: hinge,
                    draft_product_id: draftProductId
                },
                success: function(response) {
                    clickedLi.closest('.filter-size').find('.hinge_li').removeClass('active');
                    clickedLi.addClass('active');
                    updateCart(response);
                },
                error: function(error) {
                    showAlert('Failed to update hinge side: ' + (error.responseJSON?.message || 'Unknown error'));
                }
            });
        });

        $(document).on('click', '.finish_li', function() {
            const productId = $(this).data('product-id');
            const draftProductId = $(this).data('draft-product-id');
            const draftStyleId = $(this).data('draft-style-id');
            const finish = $(this).data('finish');
            const clickedLi = $(this);
            $.ajax({
                url: '/add-finish-side',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                    draft_style_id: draftStyleId,
                    finish: finish,
                    draft_product_id: draftProductId
                },
                success: function(response) {
                    clickedLi.closest('.filter-size').find('.finish_li').removeClass('active');
                    clickedLi.addClass('active');
                    updateCart(response);
                },
                error: function(error) {
                    showAlert('Failed to update finish side: ' + (error.responseJSON?.message || 'Unknown error'));
                }
            });
        });

        $(document).on('change', '#po_number', function() {
            const customer_draft_id = $(this).data('customer-draft-id');
            const po_number = $(this).val();
            $.ajax({
                url: '/po_number_update',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    customer_draft_id: customer_draft_id,
                    po_number: po_number
                },
                success: function(response) {
                    console.log('PO number updated:', response);
                },
                error: function(error) {
                    showAlert('Failed to update PO number: ' + (error.responseJSON?.message || 'Unknown error'));
                }
            });
        });

        $(document).on('change', '#designer', function() {
            const customer_draft_id = $(this).data('customer-draft-id');
            const designer = $(this).val();
            $.ajax({
                url: '/designer_update',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    customer_draft_id: customer_draft_id,
                    designer: designer
                },
                success: function(response) {
                    console.log('Designer updated:', response);
                },
                error: function(error) {
                    showAlert('Failed to update designer: ' + (error.responseJSON?.message || 'Unknown error'));
                }
            });
        });

        function deleteModal(id) {
            $('#exampleModalLive').modal('show');
            $('#yes').off('click').on('click', function() {
                $.ajax({
                    url: `{{ url('draft-product/delete') }}/${id}`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data == 0) {
                            window.location.reload();
                        } else {
                            window.location.href = `/new-draft/${data}`;
                        }
                    },
                    error: function(error) {
                        showAlert('Failed to delete product: ' + (error.responseJSON?.message || 'Unknown error'));
                    }
                });
            });
        }

        function CouponDeleteModal(id) {
            $('#CouponModalLive').modal('show');
            $('#coupon_yes').off('click').on('click', function() {
                $.ajax({
                    url: `{{ url('remove-coupon') }}/${id}`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data == 0) {
                            window.location.reload();
                        } else {
                            window.location.href = `/add-cart/${data}`;
                        }
                    },
                    error: function(error) {
                        showAlert('Failed to delete coupon: ' + (error.responseJSON?.message || 'Unknown error'));
                    }
                });
            });
        }
    });
</script>
@endpush
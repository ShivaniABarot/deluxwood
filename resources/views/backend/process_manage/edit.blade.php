@extends(backendView('layouts.app'))

@section('title', 'Edit Process')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0"> Edit Process</h3>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row clearfix g-3">

        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                    <h6 class="m-0 fw-bold"></h6>
                </div>
                <div class="card-body">
                   
                        @csrf
                        <div class="row g-3 align-items-center">
                            @foreach($product_image as $data)
                            <div class="col-6">
                                <div class="mb-2">
                                   <img class="userimage"  height="60" width="60" src="{{asset('public/img/product/'.$data->image_name)}}"/>
                                </div>
                            </div>
                            @endforeach
                            <label class="form-label bold" style="margin-top:20px;font-size:18px">Basic Customer Information </label>

                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" value="{{$user->company_name}}" class="form-control form-control-sm" placeholder="Enter Product Name">
                                    <span class="text-danger kt-form__help error company_name"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Representative Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$user->representative_name}}" name="representative_name" placeholder="Please enter Item Name">
                                <span class="text-danger kt-form__help error representative_name"></span>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact_number" value="{{$user->contact_number}}" placeholder="Please enter SKU">
                                <span class="text-danger kt-form__help error contact_number"></span>
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                <label class="form-label"> Email Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" value="{{$user->email}}" placeholder="Please enter SKU">
                                <span class="text-danger kt-form__help error email"></span>
                            </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"> Fax<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fax" value="{{$user->fax}}" placeholder="Please enter fax">
                                <span class="text-danger kt-form__help error fax"></span>
                            </div>
                            <label class="form-label bold"  style="margin-top:20px;font-size:18px"> Order Information </label>

                            @foreach($sku_prductName as $SkuPrductName)
                         
                            <div class="col-6">
                                <div class="mb-2">
                                <label class="form-label"> SKU<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="SKU" value="{{$SkuPrductName->product_item_sku}}" placeholder="Please enter SKU">
                                <span class="text-danger kt-form__help error SKU"></span>
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                <label class="form-label"> Product Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_item_name" value="{{$SkuPrductName->product_item_name}}" >
                                <span class="text-danger kt-form__help error product_item_name"></span>
                            </div>
                            </div>
                            </div>
                            @endforeach
                            <div class="col-12">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Update Status <span class="text-danger">*</span></label>
                                        <select class="form-control category" id="finish_side" name="finish_side">
                                            <option value="">Please Select</option>
                                            <option value="Quotation" selected>Quotation</option>
                                            <option value="Picked-Up">Picked Up</option>
                                            <option value="Ready">Ready</option>
                                            <option value="In-Production">In-Production</option>
                                            <option value="Draft">Draft</option>
                                            <option value="Return">Return</option>

                                            <option value="Yes">Yes</option>
                                            <option value="No" selected>No</option>
                                        </select>
                                        <span class="text-danger kt-form__help error finish_side"></span>
                                    </div>
                                </div>
                            </div>
                          

                          
                            <!-- <input type="text" class="tagify-input"> -->
                            <!-- Select box -->







                        </div>
                        <!-- <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label"> Image</label>
                               <input type="File" class="form-control" id="image" name="image" onCLick="imageClicked()" >
                                @if ($errors->has('image'))
                                    <div class="text-danger">{{ $errors->first('image') }}</div>
                                @endif

                                <span class="text-danger" id="image_error"></span>
                            
                            
                        </div>
                        <img id="imgPreview" class="userimage" />
                    </div> -->
                        <button type="submit" class="btn btn-light mt-4 text-uppercase px-5">Update</button>
                </div>
            </div>
        </div>
    </div><!-- Row End -->
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush

@push('custom_styles')
<style>
    /* Basic styles for the plus button */
    .plus-button {
        width: 40px;
        height: 40px;
        background-color: #007bff;
        /* Replace with your desired background color */
        color: #fff;
        /* Replace with your desired text color */
        border: none;
        font-size: 24px;
        font-weight: bold;
        border-radius: 50%;
        /* This makes the button circular */
        cursor: pointer;
        outline: none;
        /* Remove the default focus outline */
    }

    /* On hover, you can add some effects to make it more interactive */
    .plus-button:hover {
        background-color: #0056b3;
        /* Replace with your desired hover background color */
        /* Add other styles for hover effect if needed */
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
@endpush

@push('custom_scripts')
@push('custom_scripts')
<script>
    $(document).ready(function() {
        $('#door_style_id').select2();
    });
</script>

@endpush


@push('modals')
@endpush
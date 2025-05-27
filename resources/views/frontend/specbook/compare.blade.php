@extends(backendView('layouts.app'))

@section('title', 'Specbook')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0"> SpecBook</h3>
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
                    <h1>Comparison Results</h1>
                    <div>
                        <h2>{{ $comparisonData['product1']->product_id }} vs {{ $comparisonData['product2']->product_id }}</h2>
                    </div>
                    <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="items-image" id="imageContainer1">
                                @php $image_nm = DB::table('product_image')
                                    ->leftjoin('product_master','product_master.product_id', '=', 'product_image.product_id')
                                    ->leftjoin('draft_product','draft_product.product_id', '=', 'product_master.product_id')
                                    ->where('draft_product.product_id',$comparisonData['product1']->product_id)
                                    ->select('image_name')
                                    ->first(); @endphp 
                                    @if($image_nm===null)
                                    <img src="" id="getimg"  class="image" style="width: 140px; height: 161px;">

                                    @else
                                    <img src="/public/img/product/{{$image_nm->image_name}}" id="getimg"  class="image"  style="width: 140px; height: 161px;">
                                    @endif
                                 </div>
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Category</label>
                                    @php $category1 = DB::table('product_category')
                                    ->leftjoin('product_master','product_master.product_category_id', '=', 'product_category.category_id')
                                    ->where('product_master.product_id',$comparisonData['product1']->product_id)
                                    ->select('title')
                                    ->first(); @endphp 
                                    @if($category1===null)
								    <input type="text" class="form-control" name="Category_name1" readonly >
                                    @else
								    <input type="text" class="form-control" value="{{$category1->title}}" name="Category_name1" readonly >

                                    @endif
							    </div> 
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Hinge Side</label>
                                    @if(isset($comparisonData['product1']['hinge_side']) && $comparisonData['product1']['hinge_side'] === null)
								    <input type="text" class="form-control" name="hige_side1" readonly >
                                    @else
								    <input type="text" class="form-control" name="hige_side1" value="{{$comparisonData['product1']->hinge_side}}" readonly >
                                    @endif
							    </div> 
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Finish Side</label>
                                    @if(isset($comparisonData['product1']['finish_side']) && $comparisonData['product1']['finish_side'] === null)
                                    <input type="text" class="form-control" name="finish_side1" readonly >
                                    @else
								    <input type="text" class="form-control" name="finish_side1" value="{{$comparisonData['product1']->finish_side}}" readonly >
                                    @endif
							    </div> 
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Dimensions</label>
								    <input type="text" class="form-control" name="dimension1" readonly >
							    </div>
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Modification</label>
                                    @php $modification1 = DB::table('modificationmaster')
                                    ->leftjoin('draft_product','modificationmaster.modification_id', '=', 'draft_product.modification_id')
                                    ->where('draft_product.modification_id',$comparisonData['product1']->modification_id)
                                    ->select('modification_nm')
                                    ->first(); @endphp 
                                    @if($modification1===null)
								    <input type="text" class="form-control"  name="modification1" readonly >
                                    @else
								    <input type="text" class="form-control" value="{{$modification1->modification_nm}}" name="modification1" readonly >
                                    @endif
							    </div>
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Accessories</label>
                                    @php $accessories1 = DB::table('accessoriesmaster')
                                    ->leftjoin('draft_product','accessoriesmaster.accessories_id', '=', 'draft_product.accessories_id')
                                    ->where('draft_product.accessories_id',$comparisonData['product1']->accessories_id)
                                    ->select('accessories_nm')
                                    ->first(); @endphp 
                                    @if($accessories1===null)
								    <input type="text" class="form-control"  name="accessories1" readonly >
                                    @else
								    <input type="text" class="form-control" value="{{$accessories1->accessories_nm}}" name="accessories1" readonly >
                                    @endif
							    </div>
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Price</label>
                                    @if(isset($comparisonData['product1']['total_price']) && $comparisonData['product1']['total_price'] === null)
                                    <input type="text" class="form-control" name="price1" readonly >
                                    @else
								    <input type="text" class="form-control" name="price1" value="{{$comparisonData['product1']->total_price}}" readonly >
                                    @endif
							    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="items-image" id="imageContainer2">
                                @php $image_nm2 = DB::table('product_image')
                                    ->leftjoin('product_master','product_master.product_id', '=', 'product_image.product_id')
                                    ->leftjoin('draft_product','draft_product.product_id', '=', 'product_master.product_id')
                                    ->where('draft_product.product_id',$comparisonData['product2']->product_id)
                                    ->select('image_name')
                                    ->first(); @endphp 
                                    @if($image_nm2===null)
                                    <img src="" id="getimg"  class="image" style="width: 140px; height: 161px;">
                                    @else
                                    <img src="/public/img/product/{{$image_nm2->image_name}}" id="getimg"  class="image"  style="width: 140px; height: 161px;">
                                    @endif
                                 </div>
                                 <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Category</label>
                                    @php $category2 = DB::table('product_category')
                                    ->leftjoin('product_master','product_master.product_category_id', '=', 'product_category.category_id')
                                    ->where('product_master.product_id',$comparisonData['product2']->product_id)
                                    ->select('title')
                                    ->first(); @endphp 
                                    @if($category2===null)
								    <input type="text" class="form-control" name="Category_name2" readonly >
                                    @else
								    <input type="text" class="form-control" value="{{$category2->title}}" name="Category_name1" readonly >

                                    @endif
							    </div> 
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Hinge Side</label>
                                    @if(isset($comparisonData['product2']['hinge_side']) && $comparisonData['product2']['hinge_side'] === null)
								    <input type="text" class="form-control" name="hige_side2" readonly >
                                    @else
								    <input type="text" class="form-control" name="hige_side2" value="{{$comparisonData['product2']->hinge_side}}" readonly >
                                    @endif
							    </div> 
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Finish Side</label>
                                    @if(isset($comparisonData['product2']['finish_side']) && $comparisonData['product2']['finish_side'] === null)
                                    <input type="text" class="form-control" name="finish_side2" readonly >
                                    @else
								    <input type="text" class="form-control" name="finish_side2" value="{{$comparisonData['product2']->finish_side}}" readonly >
                                    @endif
							    </div> 
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Dimensions</label>
								    <input type="text" class="form-control" name="dimension2" readonly >
							    </div>
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Modification</label>
                                    @php $modification2 = DB::table('modificationmaster')
                                    ->leftjoin('draft_product','modificationmaster.modification_id', '=', 'draft_product.modification_id')
                                    ->where('draft_product.modification_id',$comparisonData['product2']->modification_id)
                                    ->select('modification_nm')
                                    ->first(); @endphp 
                                    @if($modification2===null)
								    <input type="text" class="form-control"  name="modification2" readonly >
                                    @else
								    <input type="text" class="form-control" value="{{$modification2->modification_nm}}" name="modification2" readonly >
                                    @endif
							    </div>
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Accessories</label>
                                    @php $accessories2 = DB::table('accessoriesmaster')
                                    ->leftjoin('draft_product','accessoriesmaster.accessories_id', '=', 'draft_product.accessories_id')
                                    ->where('draft_product.accessories_id',$comparisonData['product2']->accessories_id)
                                    ->select('accessories_nm')
                                    ->first(); @endphp 
                                    @if($accessories2===null)
								    <input type="text" class="form-control"  name="accessories2" readonly >
                                    @else
								    <input type="text" class="form-control" value="{{$accessories2->accessories_nm}}" name="accessories2" readonly >
                                    @endif
							    </div>
                                <div class="col-md-6" style="margin-top:20px">
								    <label class="form-label">Price</label>
                                    @if(isset($comparisonData['product2']['total_price']) && $comparisonData['product2']['total_price'] === null)
                                    <input type="text" class="form-control" name="price2" readonly >
                                    @else
								    <input type="text" class="form-control" name="price2" value="{{$comparisonData['product2']->total_price}}" readonly >
                                    @endif
							    </div>
                        </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endpush

@push('modals')
@endpush
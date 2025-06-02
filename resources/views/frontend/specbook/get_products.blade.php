@if (count($ct_product_data) === 0)
    <p class="fw-bold" style="position: absolute; top: 24%; left: 60%;">No products Available in this Category</p>
@else
    @foreach($ct_product_data as $val)
        <div class="p-4 active-user bg-lightblue rounded-2 mb-2 re_cls">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                    <img src="{{ asset('img/product/' . $val['image_name']) }}" style="width: 127px; height: 120px;">                    </div>
                    <div class="col-md-8 row">
                        <div class="col-md-12">
                            <h5 class="fw-bold">{{$val->product_name}}</h5>
                        </div>
                        <!-- <div class="col-md-6 mt-3">
                                                        <p><b>Hinge Side:</b> {{$val->hinge_side}}</p>
                                                    </div>

                                                    <div class="col-md-6 mt-3">
                                                        <p><b>Finish Side:</b> {{$val->finish_side}}</p>
                                                    </div> -->

                        <div class="col-md-6">
                            <p><b>Length:</b> {{$val->item_length}}</p>
                        </div>

                        <div class="col-md-6">
                            <p><b>Width:</b> {{$val->item_breadth}}</p>
                        </div>

                        <div class="col-md-6">
                            <p><b>Height:</b> {{$val->item_height}}</p>
                        </div>

                        <!-- <div class="col-md-12">
                                                        <p><b>Modification:</b> {{$val->modification_nm}}</p>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <p><b>Accessories:</b> {{$val->accessories_nm}}</p>
                                                    </div> -->

                        <div class="col-md-6">
                            <p><b>Price:</b> {{$val->total_price}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
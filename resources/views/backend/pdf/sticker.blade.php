<!-- resources/views/pdf/stickers.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
      
      @page { size: 4in 6in; margin: 0.1in; } 
        .page-break {
            page-break-after: always;
        }
        .sticker {
            
            width: 3.6in;
             height: 5.5in;
            border: 1px solid #000;
            padding: 0  10px;
            box-sizing: border-box;
        }
        /* .page-break {
            page-break-after: always;
        }
        .sticker {
            
            width: 4in;
            height: 6in;
            border: 1px solid #000;
            padding: 10px;
            box-sizing: border-box;
        } */
        .logo {
            text-align: center;
         
        }
        .logo img {
            padding-top:10px;
            width:160px;
            height: 70px;
            padding-bottom: 10px;
            /* max-width: 95%;
            max-height: 80%; */
        }
        
        .details {
            font-size: 16px; 
            font-weight: bold; 
           
        }
        
        .details .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 5px; /* Margin between each detail */
        }
         .details .label, .details .value {
            display: inline-block;
            flex: 1;
        }
        .details .label {
            width: 45%; /* Adjust the basis as needed */
        }
        .details .value {
            width: 50%; /* Adjust the basis as needed */
        }
    </style>
</head>
<body>
    @php 
        $sub_total = 0; 
        $ItemtotalPrice  = 0; 
        $totalCutDepthPrice = 0; $totalModificationPrice = 0; $totalDoorStylePrice  = 0; $totalAccessoriesPrice = 0; $hinge_value = 0; $finish_value = 0;
    @endphp
    @foreach ($newdata_arr as $doorStyleId => $products)
        @php
            $no = 1;
        @endphp
        @if(!empty($products))
            @foreach ($products as $data)
                <div class="sticker">
                    <div class="logo">
                        <img src="{{asset('public/logo.png')}}" alt="Logo">
                    </div>
                    <div class="details">
                <div class="detail-row">
                    <div class="label">ORDER NUMBER:</div>
                    <div class="value"> #{{$customer_draft_Id}}</div>
                </div>
                <div class="detail-row">
                    <div class="label">DATE:</div>
                    <div class="value">{{ $pdf_data->created_at->format('m-d-Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="label">DOOR STYLE:</div>
                    <div class="value">
                        @php
                            $doorStyle = \App\Models\DoorStyle::find($doorStyleId);
                        @endphp
                        {{ $doorStyle->name }}
                    </div>
                </div>
                <div class="detail-row">
                    <div class="label">SKU:</div>
                    <div class="value">{{ $data->product_item_sku }}</div>
                </div>
                <div class="detail-row">
                    <div class="label">QUANTITY:</div>
                    <div class="value">{{ $data->quantity }}</div>
                </div>
                <div class="detail-row">
                    <div class="label">HS:</div>
                    <div class="value">
                        @if($data->is_hinge_side == "Yes")
                            @php
                                $hingeSideMap = [
                                    'L' => 'Left',
                                    'R' => 'Right',
                                    'B' => 'Both',
                                    'None' => 'None',
                                ];
                            @endphp
                            @if(isset($hingeSideMap[$data->hinge_side]))
                                {{ $hingeSideMap[$data->hinge_side] }}
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="detail-row">
                    <div class="label">FE:</div>
                    <div class="value">
                        @if($data->is_finish_side == "Yes")
                            @php
                                $finishSideMap = [
                                    'L' => 'Left',
                                    'R' => 'Right',
                                    'B' => 'Both',
                                    'None' => 'None',
                                ];
                            @endphp
                            @if(isset($finishSideMap[$data->finish_side]))
                                {{ $finishSideMap[$data->finish_side] }}
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="detail-row">
                    <div class="label">CUT DEPTH:</div>
                    <div class="value">
                        @if(!empty($data->selected_cut_depth))
                            {{ $data->selected_cut_depth }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="detail-row">
                    <div class="label">ACCESSORIES:</div>
                    <div class="value">
                        @foreach ($data->accessories_nm as $accessoryName)
                            @if (!empty($accessoryName->accessories_nm))
                                {{ $accessoryName->accessories_nm }} <br>
                            @else
                               -
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="detail-row">
                    <div class="label">MODIFICATION:</div>
                    <div class="value">
                        @foreach ($data->modification_nm as $modificationName)
                            @if (!empty($modificationName->modification_nm))
                                {{ $modificationName->modification_nm }} <br>
                            @else
                                -
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="detail-row">
                    <div class="label">PO:</div>
                    <div class="value">{{ $pdf_data->po_number }}</div>
                </div>
                <div class="detail-row">
                    <div class="label">SERVICE TYPE:</div>
                    <div class="value">{{ $customer_draft->service_type }}</div>
                </div>
                <!-- Add more details as needed -->
            </div>
                </div>
                @if (!$loop->last)
                    <div class="page-break"></div>
                @endif
                <br>
            @endforeach   
            <!-- @if (!$loop->last)
                    <div class="page-break"></div>
                @endif -->
        @endif 
    @endforeach
</body>
</html>
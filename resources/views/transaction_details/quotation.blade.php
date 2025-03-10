@if(request()->segment(3) == "edit")
    <div class="row">
        <div class="col-md-12">
            <div class="row"> 
                <div class="col-md-12">
                    <div style="background:#595959;color:white;padding:3px;text-align: center;">
                        <h4>Quotation of Repair</h4>  
                    </div> 
                </div> 
            </div> 
            <br>    
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            @if (Request::segment(2) == 'repair_in_process' || Request::segment(2) == 'to_close')
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="margin-top:7px;">
                                            <label><span class="requiredField">*</span>Quotation :</label>
                                        </div>
                                        <div class="col-md-3" style="margin-top:7px;">
                                            <label class="radio-inline control-label text-success"><input type="radio" name="quotation" value="APPROVED" required {{ $transaction_details->quotation == 'APPROVED' ? 'checked' : ''}} {{ $transaction_details->repair_status != 1 ? 'disabled' : ''}} ><strong>APPROVED</strong></label>
                                            <br>
                                        </div>
                                        <div class="col-md-3" style="margin-top:7px;">
                                            <label class="radio-inline control-label text-danger"><input type="radio" name="quotation" value="DISSAPROVED" required {{ $transaction_details->quotation == 'DISSAPROVED' ? 'checked' : ''}} {{ $transaction_details->repair_status != 1 ? 'disabled' : ''}} ><strong>DISSAPROVED</strong></label>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-4 control-label"  style="font-size: 1.1em;"><strong>Memo Number: </strong></label>
                                    <div class="col-md-8">
                                        <input class="form-control" style="font-weight:bolder;font-size: 1.2em;" type="text" name="memo_number" value="{{$transaction_details->memo_no}}" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}> 
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-4 control-label" style="font-size: 1.1em;"><strong>Software Fee: </strong></label>
                                    <div class="col-md-8 input-icon">
                                        <input type="hidden" value="{{ number_format($transaction_details->software_fee, 2, '.', '') }}" id="diagnostic_payment_fee">
                                        <input class="form-control" style="font-weight:bolder;font-size: 1.2em;" type="text" id="software_cost" name="software_cost" onblur="AutoFormatPrice()" value="{{ number_format($transaction_details->software_cost, 2, '.', '') }}" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}> 
                                        <i>₱</i>
                                    </div>
                                </div>
                            </div>
                            @if($transaction_details->repair_status == 1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-8 pull-right">
                                            <button class="btn btn-danger" style="margin-right:5px;margin-top:5px" onclick="ResetFee()" id="reset_fee"><i class="fa fa-times" aria-hidden="true"></i> Reset</button>
                                            <button class="btn btn-primary" style="margin-top:5px" onclick="AddFee()" id="add_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Fee</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if($transaction_details->repair_status == 1)
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 ">
                            <button onclick="AddQuotation()" id="addQuotes" style="margin-top:5px" class="btn btn-warning pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Parts</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>          

    <div class="row">
        <div class="col-md-12">
            <div class="box-body">
                <div class="table-responsive borderline" style="overflow-x:unset !important;">
                    <div class="pic-container">
                        <div class="pic-row">
                            <table class="table table-bordered" id="dynamic_field">
                                <tbody>
                                    <tr class="tbl_header_color" style="padding: 1px !important;">
                                        <th width="10%" class="text-center" style="padding: 1px !important;">Spare Part#</th>
                                        <th width="10%" class="text-center" style="padding: 1px !important;">GSX Reference</th>
                                        <th width="10%" class="text-center" style="padding: 1px !important;">CS Code</th>
                                        <!--<th width="10%" class="text-center" style="padding: 1px !important;">Apple Part#</th>-->
                                        <th width="10%" class="text-center" style="padding: 1px !important;">Apple Serial</th>
                                        <!--<th width="10%" class="text-center" style="padding: 1px !important;">Digits Code</th>-->
                                        <th width="20%" class="text-center" style="padding: 1px !important;">Item Description</th>
                                        <th width="9%" class="text-center" style="padding: 1px !important;">Price</th>
                                        <th width="1%" class="text-center" style="padding: 1px !important;">      </th>
                                    </tr>
                                    <tr id="quotelist">
                                        @if(count($data['quotation'])>0)
                                            @foreach($data['quotation'] as $qt)
                                                <tr class="nr row_num" id="rowID{{$qt->id}}">
                                                    <input type="hidden"class="getidValue" value="{{$qt->id}}">
                                                    <td style="padding: 1px !important;"><input class="form-control text-center getscValue" type="text" id="service_code_{{$qt->id}}" oninput="gsx_data('{{$qt->id}}')" value="{{ $qt->service_code }}" placeholder="Enter Spare Part Number" readonly {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}></td>
                                                    <td style="padding: 1px !important;">
                                                        @if(CRUDBooster::getModulePath() == "to_pay_parts" && CRUDBooster::myPrivilegeId() == 1)
                                                            <input class="form-control text-center getgsxValue" type="text" id="gsx_code_{{$qt->id}}"  value="{{ $qt->gsx_ref }}" placeholder="Enter GSX Reference">
                                                        @elseif(CRUDBooster::getModulePath() == "to_pay_parts" && CRUDBooster::myPrivilegeId() == 4)
                                                            <input class="form-control text-center getgsxValue" type="text" id="gsx_code_{{$qt->id}}"  value="{{ $qt->gsx_ref }}" placeholder="Enter GSX Reference">
                                                        @else
                                                            <input class="form-control text-center getgsxValue" type="text" id="gsx_code_{{$qt->id}}"  value="{{ $qt->gsx_ref }}" placeholder="Enter GSX Reference" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}>
                                                        @endif
                                                    </td>
                                                    <td style="padding: 1px !important;"><input class="form-control text-center getcsValue" type="text" id="cs_code_{{$qt->id}}" value="{{ $qt->cs_code }}" placeholder="Enter CS Code" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}></td>
                                                    <!--<td style="padding: 1px !important;">-->
                                                    <!--    @if(CRUDBooster::getModulePath() == "to_close" && CRUDBooster::myPrivilegeId() == 1)-->
                                                    <!--        <input class="form-control text-center getapValue" type="text" id="apple_parts_{{$qt->id}}" value="{{ $qt->apple_parts }}" placeholder="Enter Apple Parts Number">-->
                                                    <!--    @elseif(CRUDBooster::getModulePath() == "to_close" && CRUDBooster::myPrivilegeId() == 2)-->
                                                    <!--        <input class="form-control text-center getapValue" type="text" id="apple_parts_{{$qt->id}}" value="{{ $qt->apple_parts }}" placeholder="Enter Apple Parts Number">-->
                                                    <!--    @else-->
                                                    <!--        <input class="form-control text-center getapValue" type="text" id="apple_parts_{{$qt->id}}" value="{{ $qt->apple_parts }}" placeholder="Enter Apple Parts Number" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}>-->
                                                    <!--    @endif-->
                                                    <!--</td>-->
                                                    <td style="padding: 1px !important;">
                                                        
                                                        
                                                        
                                                        @if(CRUDBooster::getModulePath() == "to_close" && CRUDBooster::myPrivilegeId() == 1)
                                                            <input class="form-control text-center getserialValue" type="text" value="{{ $qt->serial_no }}" placeholder="Enter Apple Parts Number">
                                                        @elseif(CRUDBooster::getModulePath() == "to_close" && CRUDBooster::myPrivilegeId() == 2)
                                                            <input class="form-control text-center getserialValue" type="text" value="{{ $qt->serial_no }}" placeholder="Enter Apple Parts Number">
                                                        @else
                                                            <!--<input class="form-control text-center getserialValue" type="text" value="{{ $qt->serial_no }}" placeholder="Enter Apple Parts Number" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}>-->
                                                            @if(CRUDBooster::getModulePath() == "repair_in_process" && CRUDBooster::myPrivilegeId() == 1)
                                                                <input class="form-control text-center getserialValue" type="text" value="{{ $qt->serial_no }}" placeholder="Enter Apple Parts Number">
                                                            @elseif(CRUDBooster::getModulePath() == "repair_in_process" && CRUDBooster::myPrivilegeId() == 2)
                                                                <input class="form-control text-center getserialValue" type="text" value="{{ $qt->serial_no }}" placeholder="Enter Apple Parts Number">
                                                            @else
                                                                <input class="form-control text-center getserialValue" type="text" value="{{ $qt->serial_no }}" placeholder="Enter Apple Parts Number" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}>
                                                            @endif
                                                        @endif
                                                        
                                                    </td>
                                                    <!--<td style="padding: 1px !important;"><input class="form-control text-center getdcValue" type="text" id="digits_code_{{$qt->id}}" value="{{ $qt->digits_code }}" placeholder="Enter Item Code" readonly {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}></td>-->
                                                    <td style="padding: 1px !important;"><input class="form-control text-center getitemValue" type="text" id="item_desc_{{$qt->id}}" value="{{ $qt->item_description }}" placeholder="Enter Item Description" readonly {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}></td>
                                                    <td style="padding: 1px !important;"><input class="form-control text-center getcostValue" type="number" onblur="AutoFormatCost('{{$qt->id}}')" id="price_{{$qt->id}}" value="{{ $qt->cost }}" min="0" max="9999" step="any" placeholder="Enter Price" {{ $transaction_details->repair_status != 1 ? 'readonly' : ''}}></td> 
                                                    @if($transaction_details->repair_status == 1) <td style="padding: 5px !important;" class="text-center"><a onclick="RemoveRow('{{$qt->id}}')"><i class="fa fa-close fa-2x remove" style="color:red"></i></a></td> @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tr>
                                    <tr class="nr row_num" {{ $transaction_details->repair_status != 1 ? 'hidden' : ''}}>
                                        <input type="hidden"class="getidValue" value="">
                                        <td style="padding: 1px !important;position: relative;">
                                            <input class="form-control text-center getscValue"  type="text" value="" id="service_code" oninput="gsx_data('service_code')" placeholder="Enter Spare Part Number">
                                            <ul class="form-control ui-front sparepartlist ui-menu ui-widget ui-widget-content">
                                                <li class="li-padding">Loading...</li>
                                            </ul>
                                        </td>
                                        <td style="padding: 1px !important;"><input class="form-control text-center getgsxValue" type="text" value="" id="gsx_ref"  placeholder="Enter GSX Reference"></td>
                                        <td style="padding: 1px !important;"><input class="form-control text-center getcsValue" type="text" value="" id="cs_code" placeholder="Enter CS Code"></td>
                                        <td style="padding: 1px !important;"><input class="form-control text-center getserialValue" type="text" value="" id="serial_no" placeholder="Enter Apple Parts Number"></td>
                                        <td style="padding: 1px !important;"><input class="form-control text-center getitemValue" type="text" value="" id="item_desc" placeholder="Enter Item Description"></td>
                                        <td style="padding: 1px !important;"><input class="form-control text-center getcostValue" type="number" value="" onblur="AutoFormatCost('cost')" id="cost" min="0" max="9999" step="any"  placeholder="Enter Price"></td> 
                                        <td style="padding: 5px !important;" class="text-center"></td>
                                    </tr>
                                    <input type="hidden" name="header_id" id="header_id" value="{{ $transaction_details->header_id }}">
                                    <input type="hidden" name="number_of_rows" id="number_of_rows">
                                    <input type="hidden" name="row_id" id="rowidArray">
                                    <input type="hidden" name="service_code" id="scArray">
                                    <input type="hidden" name="gsx_ref" id="gsxArray">
                                    <input type="hidden" name="cs_code" id="csArray">
                                    <input type="hidden" name="serial_no" id="serialArray">
                                    <input type="hidden" name="item_desc" id="itemArray">
                                    <input type="hidden" name="cost" id="costArray">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('bottom')
    @include('technician.quotation_script')
@endpush

@else

<div class="row">
    <div class="col-md-12">
        <div class="row"> 
            <div class="col-md-12">
                <div style="background:#595959;color:white;padding:3px;text-align: center;">
                    <h4>Quotation of Repair</h4>  
                </div> 
            </div> 
        </div> 
        <br>    
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-md-2 control-label" style="font-size: 1.1em;"><strong>Memo Number: </strong></label>
                        <div class="col-md-10"><strong>{{$transaction_details->memo_no ?? 'N/A'}}</strong></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-md-2 control-label" style="font-size: 1.1em;"><strong>Software Fee: </strong></label>
                        <div class="col-md-10 input-icon"><strong>₱{{ number_format($transaction_details->software_cost, 2, '.', '') }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<br>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <div class="pic-container">
                        <div class="pic-row">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="tbl_header_color" style="padding: 1px !important;">
                                        <th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">Spare Part#</th>
                                        <th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">GSX Reference</th>
                                        <th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">CS Code</th>
                                        <th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">Apple Part#</th>
                                        <!--<th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">Serial#</th>-->
                                        <!--<th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">Digits Code</th>-->
                                        <th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">Item Description</th>
                                        <th width="10%" class="text-center table-bordered-display" style="padding: 5px !important;">Price</th>
                                    </tr>
                                    <tr>
                                        @if(count($data['quotation'])>0)
                                            @foreach($data['quotation'] as $qt)
                                                <tr>
                                                    <td style="padding: 5px !important;" class="text-center table-bordered-display"><p>{{ $qt->service_code }}</p></td>
                                                    <td style="padding: 5px !important;" class="text-center table-bordered-display"><p>{{ $qt->gsx_ref }}</p></td>
                                                    <td style="padding: 5px !important;" class="text-center table-bordered-display"><p>{{ $qt->cs_code }}</p></td>
                                                    <!--<td style="padding: 5px !important;" class="text-center table-bordered-display"><p>{{ $qt->apple_parts }}</p></td>-->
                                                    <td style="padding: 5px !important;" class="text-center table-bordered-display"><p>{{ $qt->serial_no }}</p></td>
                                                    <!--<td style="padding: 5px !important;" class="text-center table-bordered-display"><p>{{ $qt->digits_code }}</p></td>-->
                                                    <td style="padding: 5px !important;" class="text-center table-bordered-display"><p>{{ $qt->item_description }}</p></td>
                                                    <td style="padding: 5px !important;" class="text-center table-bordered-display"><p>₱{{ $qt->cost }}</p></td> 
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="table-bordered-display" style="padding: 5px !important;border-width: 1px !important;background-color:#EDEDED;text-align: center;" colspan="7">
                                                    <p><i class="fa fa-search"></i> No Data Available</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

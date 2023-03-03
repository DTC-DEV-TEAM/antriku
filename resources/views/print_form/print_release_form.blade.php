
@extends('crudbooster::admin_template')
@push('head')
@endpush
@section('content')
    @if(g('return_url'))
        <p class="noprint"><a title="Return" href='{{g("return_url")}}'><i class='fa fa-chevron-circle-left '></i> &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>       
    @else
        <p class="noprint"><a title='Main Module' href='{{ CRUDBooster::adminPath() }}/{{ CRUDBooster::getModulePath() }}'><i class='fa fa-chevron-circle-left '></i> &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>       
    @endif
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        #repair-strat tr td p{
            text-transform: lowercase;
        }

        #repair-strat tr td p::first-letter{
            text-transform: capitalize;
        }
    </style>
    <div class="panel panel-default">
        <div class='panel-heading'>Print Release Form</div>
        <div class='panel-body'>    
            <div id="printableArea"> 
                <style> 
                    .table-bordered-display { border: 1px solid #B8B8B8 !important; } 
                    table.print-friendly { page-break-inside: avoid; }
                </style>
                <table width="100%">
                    <tr>
                        <th colspan="4" style="text-align:center;">
                            <img src="{{asset('img/btblogo.png')}}" style="align:middle;width:40%;height:auto;">
                        </th>
                    </tr>   
                    <tr>
                        <td width="35%" style="padding-right:50px;">
                            <div class="row">
                                <span class="control-label col-md-12">{{ $data['Branch']->branch_name }}</span>
                            </div>
                            <div class="row">
                                <span class="control-label col-md-12">{{ $data['Branch']->branch_address }}</span>
                            </div>
                            <div class="row">
                                <span class="control-label col-md-12">
                                    {{ $data['Branch']->branch_contact1 }} / {{ $data['Branch']->branch_contact2 }} / {{ $data['Branch']->branch_contact3 }} <br>
                                    http://beyondthebox.ph/
                                </span>
                            </div>
                        </td>
                        <td width="30%" colspan="2" style="text-align:center;">
                            <h4 style="margin-top: 17px;text-align-last: center;"><strong>RELEASE FORM</strong></h4> 
                        </td>
                        <td width="100%" style="padding-left:110px;">
                            <div class="row">
                                <span class="control-label col-md-12"><strong>Job Order#: </strong>{{$data['transaction_details']->reference_no}}</span>
                            </div>
                            <div class="row"> 
                                <span class="control-label col-md-12"><strong>Date Received: </strong>{{date('Y-m-d', strtotime($data['transaction_details']->created_at))}}</span>
                            </div>
                            <div class="row">
                                <span class="control-label col-md-12"><strong>Date Released: </strong>{{ date('Y-m-d') }}</span>
                            </div>
                            <div class="row">
                                <span class="control-label col-md-12"><strong>Prepared By: </strong>{{ CRUDBooster::myName() }}</span>
                            </div>
                        </td>
                    </tr> 
                </table>  

                <table width="100%" class="print-friendly">
                    <tr style="font-size: 18px;">
                        <td colspan="4" style="width:100%;background:#595959;color:white;padding:5px;"> 
                            <label style="margin-bottom:unset !important;">Customer Information</label>
                        </td>
                    </tr>
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Full Name:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->last_name}}, {{$data['transaction_details']->first_name}}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Email Address:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->email}}</p>
                        </td>
                    </tr>                                  
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Contact#:<strong></label>
                        </td>
                        <td width="40%" style="vertical-align: top;">
                            <p>{{$data['transaction_details']->contact_no}}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Address:<strong></label>
                        </td>
                        <td width="40%">
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut commodi labore totam explicabo, blanditiis excepturi.</p> --}}
                            <p>{{$data['transaction_details']->address}}</p>
                        </td>
                    </tr>
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Company Name:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->company_name}}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Company Contact#:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->company_contact_no}}</p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr style="font-size: 18px;">
                        <!-- <td colspan="4"><br>
                            <label class="control-label col-md-12"><strong>Service Details<strong></label>
                        </td> -->
                        <td colspan="4" style="width:100%;background:#595959;color:white;padding:5px;"> 
                            <label style="margin-bottom:unset !important;">Service Details</label>
                        </td>
                    </tr>
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Date of Purchase:</strong></label>
                        </td>
                        <td>
                            <p>{{ date('Y-m-d', strtotime($data['transaction_details']->purchase_date)) }}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>{{ trans('labels.form-label.warranty_expiration_date') }}</strong></label>
                        </td>
                        <td>
                            <p>{{ date('Y-m-d', strtotime($data['transaction_details']->warranty_expiration_date)) }}</p>
                        </td>
                    </tr>
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Model:</strong></label>
                        </td>
                        <td width="40%">
                            <p>{{ $data['transaction_details']->model_name }}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Coverage:</strong></label>
                        </td>
                        <td>
                            <p>{{$data['transaction_details']->warranty_status}}</p>
                        </td>
                    </tr>  
                    <br>
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Summary of Concern:</strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->summary_of_concern}}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>GSX#:</strong></label>
                        </td>
                        <td>
                            <p>{{$data['transaction_details']->gsx_no}}</p>
                        </td>
                    </tr>  
                    <tr style="font-size: 13px">
                        <td width="20%" style="vertical-align: top">
                            <label class="control-label col-md-12"><strong>WUR/SUR:</strong></label>
                        </td>
                        <td>
                            <p>{{$transaction_details->wur_sur}}</p>
                        </td>
                    </tr>

                </table>  
                <br>

                <table class="print-friendly" style="border-spacing:unset !important;width:100%;">
                    <tbody>
                        <tr style="font-size: 13px;">
                            <th width="20%" class="text-center table-bordered-display" style="border-width: 1px 1px 1px 1px !important;padding:5px;">UPC Code</th>
                            <th width="30%" class="text-center table-bordered-display" style="border-width: 1px 1px 1px 0 !important;padding:5px;">{{ trans('labels.table.item_description') }}</th>
                            <th width="10%" class="text-center table-bordered-display" style="border-width: 1px 1px 1px 0 !important;padding:5px;">{{ trans('labels.table.serial_no') }}</th>
                            <th width="40%" class="text-center table-bordered-display" style="border-width: 1px 1px 1px 0 !important;padding:5px;">{{ trans('labels.table.problem_details') }}</th>
                        </tr>
                        <tr style="font-size: 13px;">
                            <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important;padding:5px;text-align:center;">{{ $data['transaction_details']->header_upc_code }}</td>
                            <td class="table-bordered-display" style="border-width: 0 1px 1px 0 !important;padding:5px;text-align:center;">{{ $data['transaction_details']->header_item_description }}</td>
                            <td class="table-bordered-display" style="border-width: 0 1px 1px 0 !important;padding:5px;text-align:center;">{{ $data['transaction_details']->header_serial_no }}</td>
                            <td class="table-bordered-display" style="border-width: 0 1px 1px 0 !important;padding:5px;text-align:center;">{{ $data['transaction_details']->problem_details }} @if(!empty($data['transaction_details']->problem_details_other)) ,<br> {{ $data['transaction_details']->problem_details_other }} @endif</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <!-- <table class="print-friendly" width="100%">
                    <tbody> 
                        <tr style="font-size: 18px;">
                            <td colspan="4" style="width:100%;background:#595959;color:white;padding:5px;">
                                <label class="control-label col-md-12" style="margin-bottom:unset !important;">Device Inspection (for scratches, dents, damages)</label>
                            </td>
                        </tr>  
                        <tr> 
                            <td style="text-align:center; border: 1px solid slategray; padding: 10px 0;">
                                <img src="{{ URL::to('/') }}/{{$transaction_details->model_photo}}" style="width:40%;height:auto;"/>
                            </td>
                        </tr>  
                    </tbody>
                </table>
                <br> -->
                {{-- Technician Details --}}
                <table width="100%" class="print-friendly" style="margin-bottom: 5px">
                    <tr style="font-size: 18px;">
                        <td colspan="4" style="width:100%;background:#595959;color:white;padding:5px;"> 
                            <label style="margin-bottom:unset !important;">Technician</label>
                        </td>
                    </tr>
                    @foreach ( $technician_info as $technician )
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Technician Name:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{ $technician->name }}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Technician ID:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{ $technician->technician_id }}</p>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{-- End of Technician Details --}}
                <table class="print-friendly" width="100%" style="border-spacing:unset !important;"> 
                    <tbody> 
                        <tr style="font-size:18px;">
                            <td colspan="5" style="width:100%;background:#595959;color:white;padding:5px;"> 
                                <label style="margin-bottom:unset !important;">Technical Report</label>
                            </td>
                        </tr>
                        <tr style="font-size: 13px;">
                            <td width="20%" style="padding:5px;">
                                <label class="control-label col-md-12"><strong>Device Issue Description</strong></label>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <label class="control-label col-md-12"><strong>Findings</strong></label>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <label class="control-label col-md-12"><strong>Resolution</strong></label>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <label class="control-label col-md-12"><strong>Device Issue</strong></label>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <label class="control-label col-md-12"><strong>Other Diagnosis</strong></label>
                            </td>
                        </tr>
                        <tr style="font-size: 13px;">
                            <td width="20%" style="padding:5px;">
                                <p class="control-label col-md-12">{{ $data['transaction_details']->device_issue_description }}</p>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <p class="control-label col-md-12">{{$data['transaction_details']->findings}}</p>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <p class="control-label col-md-12">{{$data['transaction_details']->resolution}}</p>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <p class="control-label col-md-12">{{$data['transaction_details']->device_issue}}</p>
                            </td>
                            <td width="20%" style="padding:5px;">
                                <?php $display_opd = str_replace(',',', ',$transaction_details->other_problem_details) ?>
                                <p class="control-label col-md-12">{{ $display_opd }} 
                                    @if ($transaction_details->other_problem_details_other != null)
                                        , {{$transaction_details->other_problem_details_other}}
                                    @endif
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Repair Strategy --}}
                <table width="100%" class="print-friendly" id="repair-strat">
                    <tr style="font-size: 18px;">
                        <td colspan="4" style="width:100%;background:#595959;color:white;padding:5px;"> 
                            <label style="margin-bottom:unset !important;">Repair Strategy</label>
                        </td>
                    </tr>
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Technician:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->technician_mc_in}}</p>
                        </td>
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Frontliner:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->frontliner_mc_in}}</p>
                        </td>
                    </tr>                                  
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Quotation:<strong></label>
                        </td>
                        <td width="40%">
                            <p>{{$data['transaction_details']->quotation}}</p>
                        </td>
                    </tr>
                </table>
                {{-- End of Repair Strategy --}}

                <table class="print-friendly" width="100%" style="border-spacing:unset !important;">
                    <tbody> 
                        <tr style="font-size: 18px;">
                            <td colspan="4" style="width:100%;background:#595959;color:white;padding:5px;"> 
                                <label style="margin-bottom:unset !important;">Summary of Charges</label>
                            </td>
                        </tr>
                        <tr style="font-size: 13px;">
                             <td width="20%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Parts #</strong></label>
                            </td>
                             <td width="20%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Parts Serial #</strong></label>
                            </td>
                            <td width="20%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Parts</strong></label>
                            </td>
                            <!--<td width="20%" class="table-bordered-display" style="border-width: 1px 1px 1px 0 !important;padding:5px;text-align:center;">-->
                            <!--    <label class="control-label col-md-12"><strong>Digits Code</strong></label>-->
                            <!--</td>-->
                            <td width="20%" class="table-bordered-display" style="border-width: 1px 1px 1px 0 !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Part/s COST</strong></label>
                            </td>
                            <!--<td width="20%" class="table-bordered-display" style="border-width: 1px 1px 1px 0 !important;padding:5px;text-align:center;">-->
                            <!--    <label class="control-label col-md-12"><strong>Total Amount</strong></label>-->
                            <!--</td>-->
                        </tr>
                        @if(count($data['Quotation'])>0)
                            @foreach($data['Quotation'] as $qt)
                                <tr style="font-size: 13px;">
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{ $qt->service_code }}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$qt->serial_number}}</p>
                                    </td>
                                    <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$qt->item_description}}</p>
                                    </td>
                                    <?php $downpayment = ($qt->cost)*0.5; ?>
                                    <td class="table-bordered-display" style="border-width: 0 1px 1px 0 !important; padding:5px; text-align:center;">
                                        @if(CRUDBooster::getCurrentMethod() == 'PrintSameDayReleaseForm')
                                            <p>₱{{number_format($qt->cost, 2, '.', '')}}</p>
                                        @else
                                            <p>₱{{number_format($downpayment, 2, '.', '')}}</p>
                                        @endif      
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr style="font-size: 13px;">
                                <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;background-color:#DDDDDD" colspan="4">
                                    <p>No item listed!</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>      
                <br>            
                <div class="table-responsive">
                <table class="print-friendly table" width="100%" style="border-spacing:unset !important;">
                    <tbody> 
                        {{-- <tr style="font-size: 18px;">
                            <td colspan="4" style="width:100%;background:#595959;color:white;padding:5px;"> 
                                <label style="margin-bottom:unset !important;">Summary of Charges</label>
                            </td>
                        </tr> --}}
                        <tr style="font-size: 13px;">
                             <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Diagnostic Fee</strong></label>
                            </td>
                             <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Software Fee</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Parts Total Cost</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Downpayment Cost</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Downpayment SOC#</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Downpayment SOC Date</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Final Payment Cost</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Final Payment SI#</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Final Payment Date</strong></label>
                            </td>
                            <td width="10%" class="table-bordered-display" style="border-width: 1px !important;padding:5px;text-align:center;">
                                <label class="control-label col-md-12"><strong>Requote</strong></label>
                            </td>
                        </tr>
                        @if($transaction_details->diagnostic_cost != null)
                            {{-- @foreach($data['Quotation'] as $qt) --}}
                                <tr style="font-size: 13px;">
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->diagnostic_cost}}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->software_cost}}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->parts_total_cost}}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->downpayment_cost}}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->down_payment_ref}}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        @if ($transaction_details->down_payment_date_created == null)
                                            <p></p>
                                            @else
                                            <p>{{$transaction_details->down_payment_date_created}}</p>
                                        @endif
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->final_payment_cost}}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->final_payment_ref}}</p>
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        @if ($transaction_details->final_payment_date_created == null)
                                            <p></p>
                                            @else
                                            <p>{{ date_format(date_create($transaction_details->final_payment_date_created),"Y/m/d") }}</p>
                                        @endif
                                    </td>
                                     <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;">
                                        <p>{{$transaction_details->requote}}</p>
                                    </td>
                                </tr>
                            {{-- @endforeach --}}
                        @else
                            <tr style="font-size: 13px;">
                                <td class="table-bordered-display" style="border-width: 0 1px 1px 1px !important; padding:5px; text-align:center;background-color:#DDDDDD" colspan="10">
                                    <p>No item listed!</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                </div>      
                <br>   
                <table width="100%" class="print-friendly">
                    <tr style="font-size: 13px;">
                        <td width="20%" style="vertical-align: top;">
                            <label class="control-label col-md-15"><strong>Payment Remarks:<strong></label>
                        </td>
                        <td width="100%">
                            @if(!empty($transaction_details->payment_remarks))
                                {{ $transaction_details->payment_remarks }}
                            @endif
                            @if ($transaction_details->repair_status == 5)
                                Refunded
                            @endif
                        </td>
                    </tr>
                </table>    
                <br>
                <table width="100%" class="print-friendly">
                    <tr style="font-size: 13px;">
                        <td colspan="2" style="text-align: justify;">
                            <p style="text-indent: 50px">Warranty & Limitation of Liability. For all Service Repairs, Beyond the Box warrants that (1) services performed will conform to their description for ninety (90) days from the date of payment receipt, (2) except for batteries described in the subsection below, all parts or products used in service will be free from defects in materials and workmanship for ninety (90) days from the date of payment receipt, and (3) batteries installed as part of Apple’s battery replacement service for Apple portable Mac computers will be free from defects in materials and workmanship for one year from the date of service. If non-conforming service is provided or a defect arises in a replacement part or product during the applicable warranty period, Beyond the Box will at its option, either (a) re-perform services to conform to their description (b) repair or replace the part or product, using parts or products that are new or equivalent to new in performance and reliability, or (c) refund the sums paid to Beyond the Box for service.</p>
                        </td>
                    </tr>
                    <tr></tr><tr></tr>
                    <!-- <tr style="font-size: 13px;">
                        <td width="1%" style="padding-top: 20px;vertical-align: top;">
                            <label class="control-label col-md-12"><strong>Conforme:<strong></label>
                        </td>
                        <td width="10%" style="padding-top: 20px;">
                            <p><strong>________________________________<strong></p>
                        </td>
                       
                    </tr>      -->
                    
                    <tr style="font-size: 13px;">
                        <!-- <td width="1%" style="vertical-align: top;">
                            <label class="control-label col-md-12"><strong><strong></label>
                        </td>
                        <td width="10%" left="10%">
                            <p>Signature over Printed Name and Date</p>
                        </td> -->
                        
                        <td width="100%" style="text-align: center;">
                            <b>I acknowledge the details above and have received the device in good, working condition.</b>
                            <br><br>
                            <p>___________________________________________</p>
                            <p>Signature over Printed Name and Date</p>
                        </td>

                    </tr>     
                </table>
                <br>
                <table>
                    <tr style="font-size: 13px;">
                        <td colspan="2" style="text-align: justify;">
                            <p style="text-align: center;"><b>BTB SC will share your details with Apple for review.</b></p>
                            <p style="text-indent: 50px">Any items not claimed within 60 days after initial update that your item is ready for pick up, BTB SC  will notify you that it considers your product to be abandoned.  BTB SC will send notice to the number and/or email address you provided  when you authorized service. In the event that your product is abandoned, BTB SC  may dispose of your product in accordance with applicable provisions of law, and, specifically, may sell your product at a private or public sale to pay for any outstanding service performed. BTB SC reserves its statutory and any other lawful liens for unpaid charges.</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>          
    </div>
    <div class='panel-footer'>            
        <form method="" id="myform" action="">
            <input type="hidden" value="{{$data['transaction_details']->header_id}}" name="header_id">
            <input type="hidden" value="3" name="print_form_type">
            <a href="{{ CRUDBooster::adminPath() }}/{{ CRUDBooster::getModulePath() }}" class="btn btn-default">Cancel</a>
            <button class="btn btn-primary pull-right" type="submit" id="print" onclick="printDivision('printableArea')"> 
                <i class="fa fa-print"></i> Print as PDF 
            </button>
        </form>                     
    </div>
@endsection

@push('bottom')
<script type="text/javascript">
    function printDivision(divName) {
        alert('Please print 2 copies!');

        var generator = window.open(",'printableArea,");
        var layertext = document.getElementById(divName);
        generator.document.write(layertext.innerHTML.replace("Print Me"));
        generator.document.close();
        generator.print();
        generator.close();

        // var mywindow = window.open();
        // var content = document.getElementById('printableArea').innerHTML;
        // var realContent = document.body.innerHTML;
        // mywindow.document.write(content);
        // mywindow.document.close(); // necessary for IE >= 10
        // mywindow.focus(); // necessary for IE >= 10*/
        // mywindow.print();
        // document.body.innerHTML = realContent;
        // mywindow.close();
        // return true;
    }  

    $(document).on('click', '#print', function(e){
        var data = $('#myform').serialize();
        $.ajax
        ({
            type: 'GET',
            url: "{{ route('change-print-status') }}", 
            data: data,
            success: function( response ){
                console.log( response );              
            },
            error: function( e ) {
                console.log(e);
            }
        });
        return true;
    });              
</script>
@endpush
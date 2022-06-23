@extends('layouts.main')

@section('container')
    <head>
        <style>
            th, td {
                padding: 10px;
            }
        </style>
    </head>
    <h2>ADD INDIVIDUAL PURCHASE ORDER</h2>
    <br>
    <form action="{{route('addPurchase')}}" method="POST" id="baseTable" style="width: 80%">
        @csrf
        <small>
            <table>
                <tr>
                    <td>Zone</td>
                    <td>
                        <select name="zone_id" class="form-control @error('zone_id') is-invalid @enderror" id="zone_id">
                            <option value="" selected disabled>Select</option>
                            @foreach($zoneDetails as $zone)
                                <option
                                    value="{{$zone->zone_id}}" @if(old('zone_id') == $zone->zone_id){{'selected'}}@endif>{{$zone->short_description}}</option>
                            @endforeach
                        </select>
                        @error('zone_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </td>
                    <td>Region</td>
                    <td>
                        <select name="region_id" class="form-control @error('region_id') is-invalid @enderror"
                                id="region-id">
                            <option value="" selected disabled>Select</option>
                            @foreach($regionDetails as $region)
                                <option
                                    value="{{$region->region_id}}" @if(old('region_id') == $region->region_id){{'selected'}}@endif>{{$region->name}}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </td>
                    <td>Territory</td>
                    <td>
                        <select name="territory_id" class="form-control @error('territory_id') is-invalid @enderror"
                                id="territory-id">
                            <option value="" selected disabled>Select</option>
                            @foreach($territoryDetails as $territory)
                                <option
                                    value="{{$territory->territory_id}}" @if(old('territory_id') == $territory->territory_id){{'selected'}}@endif>{{$territory->territory_name}}</option>
                            @endforeach
                        </select>
                        @error('territory_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </td>
                    <td>Distributor</td>
                    <td>
                        <select name="distributor_id" class="form-control @error('distributor_id') is-invalid @enderror"
                                id="distributor-id">
                            <option value="" selected disabled>Select</option>
                            @foreach($distributorDetails as $user)
                                <option
                                    value="{{$user->id}}" @if(Auth::user()->role == 'user') @if(Auth::user()->id == $user->id) {{'selected'}} @endif @elseif (old('distributor_id') == $user->id){{'selected'}}@endif>{{$user->user_name}}</option>
                            @endforeach
                        </select>
                        @error('distributor')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>
                        <input type="date" value="{{date('Y-m-d')}}" name="purchase_date"
                               class="form-control @error('purchase_date') is-invalid @enderror">
                        @error('purchase_date')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </td>
                    <td>PO No</td>
                    <td>
                        <input type="text" placeholder="Automatically" name="purchase_no" class="form-control"
                               value="TEPO{{sprintf("%04d", ($lastPOInfo->purchase_order_id ?? 0) + 1)}}" readonly>
                    </td>
                    <td>Remark</td>
                    <td colspan="3">
                        <input type="text" value="" name="remark"
                               class="form-control @error('remark') is-invalid @enderror"
                               placeholder="Enter order remark">
                        @error('remark')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </td>
                </tr>
            </table>
            <br><br>
        </small>
        <table class="table table-bordered" style="width: 90%" id="sku-table">
            <thead>
            <tr>
                <th>SKU Code</th>
                <th>SKU Name</th>
                <th>Unit Price</th>
                <th>Avb. QTY</th>
                <th>Enter QTY</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            <tr row_no="1">
                    <td>
                        <select name="sku_id[1]" class="form-control sku_id @error('sku_id') is-invalid @enderror"
                                id="sku_id1" row_no="1">
                            <option value="" selected disabled>Select</option>
                            @foreach($skuDetails as $sku)
                                <option
                                    value="{{$sku->sku_id}}" @if (old('distributor_id') == $sku->sku_id){{'selected'}}@endif>{{$sku->sku_name}}</option>
                            @endforeach
                        </select>
                        @error('distributor')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </td>
                    <td><input type="text" id="sku_name1" name="sku_name[1]" size="15px" class="form-control" value=""
                               readonly></td>
                    <td><input type="text" id="sku_price1" name="sku_price[1]" size="15px" class="form-control" value=""
                               readonly></td>
                    <td><input type="text" id="avb_qty1" name="avb_qty[1]" size="15px" class="form-control" value=""
                               readonly></td>
                    <td><input type="text" id="qty1" name="qty[1]" size="15px" row_no="1" class="form-control qty"
                               value="">
                    </td>
                    <td><input type="text" id="tot_amount1" name="tot_amount[1]" size="15px" class="form-control"
                               value=""
                               readonly></td>
            </tr>
            </tbody>
        </table>
        <br>
        <button type="button" class="btn btn-dark" id="add-new-sku">ADD NEW PRODUCT</button>
        <button type="submit" class="btn btn-success">ADD PURCHASE ORDER</button>
    </form>

    <script>
        document.getElementById('sku-table').addEventListener('change', function (e) {
            if (e.target.classList[1] == 'sku_id') {
                let sku_id = e.target.value;
                let rowId = e.target.attributes.row_no.value;
                $.ajax({
                    url: "{{route('getSkuDetails')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        SKU_ID: sku_id,
                    },
                    type: 'POST',
                    beforeSend:function (){
                        $('#qty' + rowId).val('');
                        $('#tot_amount' + rowId).val('');
                    },
                    success: function (response) {
                        $('#sku_name' + rowId).val(response.sku_name);
                        $('#sku_price' + rowId).val(response.distributor_price);
                        $('#avb_qty' + rowId).val(response.weight_volume);
                    }, error: function (error) {
                        $('#sku_name' + rowId).val('error');
                        $('#sku_price' + rowId).val('error');
                        $('#avb_qty' + rowId).val('error');
                        $('#tot_amount' + rowId).val('error');
                    }
                });
            }
        });

        $('#add-new-sku').click(function () {
            let lastRowNo = $('#sku-table tr:last').attr('row_no');
            let nextRow = parseInt(lastRowNo) + 1;
            $('#sku-table tbody').append("<tr row_no=" + nextRow + ">" +
                "<td><select name=" + 'sku_id[' + nextRow + ']' + " class=\"form-control sku_id\" id=" + 'sku_id' + nextRow + " row_no=" + nextRow + ">" +
                "<option value=\"\" selected disabled>Select</option>" +
                "@foreach($skuDetails as $sku)" +
                "<option value=\"{{$sku->sku_id}}\" >{{$sku->sku_name}}</option>" +
                "@endforeach" +
                "</select></td>" +
                "<td><input type=\"text\" id=" + 'sku_name' + nextRow + " name=" + 'sku_name[' + nextRow + ']' + " size=\"15px\" class=\"form-control\" value=\"\" readonly></td>" +
                "<td><input type=\"text\" id=" + 'sku_price' + nextRow + " name=" + 'sku_price[' + nextRow + ']' + " size=\"15px\" class=\"form-control\" value=\"\" readonly></td>" +
                "<td><input type=\"text\" id=" + 'avb_qty' + nextRow + " name=" + 'avb_qty[' + nextRow + ']' + " size=\"15px\" class=\"form-control\" value=\"\" readonly></td>" +
                "<td><input type=\"text\" id=" + 'qty' + nextRow + " name=" + 'qty[' + nextRow + ']' + " size=\"15px\" row_no=" + nextRow + " class=\"form-control qty\" value=\"\" ></td>" +
                "<td><input type=\"text\" id=" + 'tot_amount' + nextRow + " name=" + 'tot_amount[' + nextRow + ']' + " size=\"15px\" class=\"form-control\" value=\"\" readonly></td>" +
                "</tr>");
        });

        document.getElementById('sku-table').addEventListener('keyup', function (e) {
            if (e.target.classList[1] == 'qty') {
                let rowId = e.target.attributes.row_no.value;
                let qty = e.target.value;
                let unitPrice = $('#sku_price' + rowId).val();
                $('#tot_amount' + rowId).val(unitPrice * qty);
            }
        });

    </script>

@endsection

@extends('layouts.main')

@section('container')
    <h2>ADD SKU</h2>
    <form action="{{route('addSku')}}" method="POST" id="form">
        @csrf
        <table>
            <tr>
                <td width="150px">SKU ID</td>
                <td width="300px" colspan="2">
                    <input type="text" placeholder="Automatically" id="sku_id" value="{{($sku_id->sku_id ?? 0) +1}}"
                           name="sku_id" class="form-control @error('sku_id') is-invalid @enderror" readonly>
                    @error('sku_id')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td width="150px">SKU Code</td>
                <td width="300px" colspan="2">
                    <input type="text" id="sku_code" value="{{old('sku_code')}}"
                           name="sku_code" class="form-control @error('sku_code') is-invalid @enderror">
                    @error('sku_code')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>SKU Name</td>
                <td colspan="2">
                    <input type="text" value="{{old('sku_name')}}" placeholder="Main Product Name / auto" name="sku_name" id="sku_name" class="form-control @error('sku_name') is-invalid @enderror" required>
                    @error('sku_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>MRP</td>
                <td colspan="2">
                    <input type="number" name="mrp" id="mrp" value="{{old('mrp')}}" class="form-control @error('mrp') is-invalid @enderror" required>
                    @error('mrp')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Distributor Price</td>
                <td colspan="2">
                    <input type="text" name="distributor_price" value="{{old('distributor_price')}}" id="distributor_price" class="form-control @error('distributor_price') is-invalid @enderror" required>
                    @error('distributor_price')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </td>
            </tr>
            <tr>
                <td>Weight/Volume</td>
                <td>
                    <input type="text" value="{{old('weight_volume')}}" class="form-control @error('weight_volume') is-invalid @enderror" name="weight_volume" id="weight_volume" required>
                    @error('weight_volume')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <td>
                    <select name="weight_unit" id="weight_unit" class="form-control @error('weight_unit') is-invalid @enderror" required>
                        <option value="Kg">Kilo Gram (Kg)</option>
                        <option value="g">Gram (g)</option>
                    </select>
                    @error('weight_unit')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-success" id="btn-update" style="width: 100px;">Save</button></td>
            </tr>
        </table>
    </form>

    <br><br>
    @if(count($skuDetails) > 0)
        <table class="table table-bordered" style="width: 70%">
            <tr>
                <th>SKU Id</th>
                <th>SKU Code</th>
                <th>SKU Name</th>
                <th>MRP</th>
                <th>Distributor Price</th>
                <th>Weight/Volume</th>
            </tr>
            @foreach($skuDetails as $sku)
                <tr>
                    <td>{{$sku->sku_id}}</td>
                    <td>{{$sku->sku_code}}</td>
                    <td>{{$sku->sku_name}}</td>
                    <td>{{$sku->mrp}}</td>
                    <td>{{$sku->distributor_price}}</td>
                    <td>{{$sku->weight_volume}} {{$sku->weight_unit}}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection

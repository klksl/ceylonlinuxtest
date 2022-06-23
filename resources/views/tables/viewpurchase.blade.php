@extends('layouts.main')

@section('container')

            <h2>PURCHASE ORDER VIEW</h2>
            <form action="" method="">
            <table>
                <tr>
                    <td>REGION</td><td><select></select></td>
                    <td>TERRORITY</td><td><select></select></td>
                    <td>PO NO</td><td><input type="text" name="pono" placeholder="Type & Search"></td>
                    <td>FROM</td><td><input type="date" name="from"></td>
                    <td>TO</td><td><input type="date" name="to"></td>
                </tr>
            </table>
            
        </form>
       <table style="border: 1px solid #ddd;">
            <tr>
                <th>REGION</th>
                <th>TERRORITY</th>
                <th>DISTRIBUTOR</th>
                <th>PO NUMBER</th>
                <th>DATE</th>
                <th>TIME</th>
                <th>TOTAL AMOUNT</th>
                <th>VIEW PO</th>
            </tr>
            @foreach($productDetails as $product)
                @php
                    $short_description = $region->zone->short_description;
                @endphp
            <tr>
                <td>{{$product->region}}</td>
                <td>{{$product->territory}}</td>
                <td>{{$product->distributor}}</td>
                <td>{{$product->po_number}}</td>
                <td>{{$product->date}}</td>
                <td>{{$product->time}}</td>
                <td>{{$product->total_amount}}</td>
                <td>{{$product->view_po}}</td>
            </tr>
            @endforeach
        </table>
        
@endsection
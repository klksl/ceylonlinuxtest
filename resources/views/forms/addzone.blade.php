@extends('layouts.main')

@section('container')
    <h2>ADD ZONE</h2>
    <form action="{{route('addZone')}}" method="post" id="form">
        @csrf
        <table>
            <tr>
                <td>Zone code</td>
                <td>
                    <input type="text" placeholder="Automatically" id="zoneID" value="{{($zoneCode->zone_id ?? 0) +1}}" name="zone_id" class="form-control @error('zone_id') is-invalid @enderror" readonly>
                    @error('zone_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Zone Long Description</td>
                <td>
                    <input type="text" placeholder="Ex.ZONE1" id="ld" value="{{old('long_description')}}" name="long_description" class="form-control @error('long_description') is-invalid @enderror">
                    @error('long_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Short Description</td>
                <td>
                    <input type="text" placeholder="Ex.Z01" id="sd" value="{{old('short_description')}}" name="short_description" class="form-control @error('short_description') is-invalid @enderror">
                    @error('short_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button type="submit" class="btn btn-success" id="btn-update">Save</button></td>
            </tr>
        </table>
    </form>

    <br><br>
    @if(count($zoneDetails) > 0)
        <table class="table table-bordered" style="width: 70%">
            <tr>
                <th>Zone Code</th>
                <th>Zone Long Description</th>
                <th>Short Description</th>
                <th>Action</th>
            </tr>
            @foreach($zoneDetails as $zone)
                <tr>
                    <td>{{$zone->zone_id}}</td>
                    <td>{{$zone->long_description}}</td>
                    <td>{{$zone->short_description}}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-edit" zone-id="{{$zone->zone_id}}" zone-ld="{{$zone->long_description}}" zone-sd="{{$zone->short_description}}">Edit</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <script>
        $('.btn-edit').click(function (){
            $('#zoneID').val($(this).attr('zone-id'));
            $('#ld').val($(this).attr('zone-ld'));
            $('#sd').val($(this).attr('zone-sd'));
            $('#btn-update').text('Update');
            $('#form').attr('action', '{{route('zoneUpdate')}}');
        })
    </script>
@endsection

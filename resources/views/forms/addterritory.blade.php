@extends('layouts.main')

@section('container')
    <h2>ADD TERRITORY</h2>
    <form action="{{route('addTerritory')}}" method="POST" id="form">
        @csrf
        <table>
            <tr>
                <td>Region</td>
                <td><select name="region_id" class="form-control @error('region_id') is-invalid @enderror"
                            id="region-id">
                        <option value="" selected disabled>Select</option>
                        @foreach($regionDetails as $region)
                            <option value="{{$region->region_id}}" @if(old('region_id') == $region->region_id){{'selected'}}@endif>{{$region->name}}</option>
                        @endforeach
                    </select>
                    @error('region_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Zone</td>
                <td><select name="zone_id" class="form-control @error('zone_id') is-invalid @enderror" id="zone_id">
                        <option value="" selected disabled>Select</option>
                        @foreach($zoneDetails as $zone)
                            <option value="{{$zone->zone_id}}" @if(old('zone_id') == $zone->zone_id){{'selected'}}@endif>{{$zone->short_description}}</option>
                        @endforeach
                    </select>
                    @error('zone_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Territory Code</td>
                <td><input type="text" placeholder="Automatically" id="territory_id"
                           value="{{($territory_id->territory_id ?? 0) +1}}" name="territory_id"
                           class="form-control @error('territory_id') is-invalid @enderror" readonly>
                    @error('territory_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror</td>
            </tr>
            <tr>
                <td>Territory Name</td>
                <td>
                    <input type="text" placeholder="Ex.Territory1" id="territory_name" name="territory_name" class="form-control" value="{{old('territory_name')}}">
                    @error('territory_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-success" id="btn-update">Save</button></td>
            </tr>
        </table>
    </form>

    <br><br>
    @if(count($territoryDetails) > 0)
    <table class="table table-bordered" style="width: 70%">
        <tr>
            <th>Zone</th>
            <th>Region</th>
            <th>Territory Code</th>
            <th>Territory Name</th>
            <th>Action</th>
        </tr>
        @foreach($territoryDetails as $territory)
            @php
                $short_description = $territory->zone->short_description;
                $regionName = $territory->regioin->name;
            @endphp
            <tr>
                <td>{{$short_description}}</td>
                <td>{{$regionName}}</td>
                <td>{{$territory->territory_id}}</td>
                <td>{{$territory->territory_name}}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-edit" zone-id="{{$territory->zone_id}}"
                            region-id="{{$territory->region_id}}" territory-id="{{$territory->territory_id}}"
                            territory-name="{{$territory->territory_name}}">Edit
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
    @endif

    <script>
        $('.btn-edit').click(function (){
            $('#zone_id').val($(this).attr('zone-id'));
            $('#region-id').val($(this).attr('region-id'));
            $('#territory_id').val($(this).attr('territory-id'));
            $('#territory_name').val($(this).attr('territory-name'));
            $('#btn-update').text('Update');
            $('#form').attr('action', '{{route('territoryUpdate')}}');
        })

        $('#region-id').change(function (){
            let regId = $(this).val();
            $.ajax({
                url: '{{route('getZoneByRegion')}}',
                type: 'post',
                data: {
                    regId:regId,
                    _token: "{{csrf_token()}}"
                },
                success:function (response){
                    // console.log(response);
                    $('#zone_id').val(response);
                },
            });
        });
    </script>
@endsection

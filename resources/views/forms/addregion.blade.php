@extends('layouts.main')

@section('container')
    <h2>ADD REGION</h2>
    <form action="{{route('addRegion')}}" method="post" id="form">
        @csrf
        <table>
            <tr>
                <td>Zone</td>
                <td><select name="zone_id" class="form-control @error('zone_id') is-invalid @enderror" id="zoneID">
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
                <td>Region Code</td>
                <td><input type="text" placeholder="Automatically" name="region_id" id="region_id" value="{{($regionCode->region_id ?? 0) + 1}}"
                           class="form-control @error('region_id') is-invalid @enderror" readonly>
                    @error('region_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Region Name</td>
                <td><input type="text" placeholder="Ex.REGION1" name="name" id="name" value="{{old('name')}}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
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
    @if(count($regionDetails) > 0)
        <table class="table table-bordered" style="width: 70%">
            <tr>
                <th>Zone</th>
                <th>Region Code</th>
                <th>Region Name</th>
                <th>Action</th>
            </tr>
            @foreach($regionDetails as $region)
                @php
                    $short_description = $region->zone->short_description;
                @endphp
                <tr>
                    <td>{{$short_description}}</td>
                    <td>{{$region->region_id}}</td>
                    <td>{{$region->name}}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-edit" zone-id="{{$region->zone_id}}" region-id="{{$region->region_id}}" region-name="{{$region->name}}">Edit</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <script>
        $('.btn-edit').click(function (){
            $('#zoneID').val($(this).attr('zone-id'));
            $('#region_id').val($(this).attr('region-id'));
            $('#name').val($(this).attr('region-name'));
            $('#btn-update').text('Update');
            $('#form').attr('action', '{{route('regionUpdate')}}');
        })
    </script>
@endsection

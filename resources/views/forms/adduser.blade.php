@extends('layouts.main')

@section('container')
    <head>
        <style>
            th, td {
                padding: 10px;
            }

            th{
                text-align: right;
                padding-right: 40px;
            }
        </style>
    </head>
    <h2>ADD USER</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>Name <span style="color: red;">*</span></th>
                <td>
                    <input type="text" name="name" value="{{old('name')}}"
                           class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>NIC <span style="color: red;">*</span></th>
                <td>
                    <input type="text" maxlength="12" name="nic" value="{{old('nic')}}"
                           class="form-control @error('nic') is-invalid @enderror" required>
                    @error('nic')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Address <span style="color: red;">*</span></th>
                <td>
                    <input type="text" name="address" value="{{old('address')}}"
                           class="form-control @error('address') is-invalid @enderror" required>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Mobile <span style="color: red;">*</span></th>
                <td>
                    <input type="text" maxlength="10" name="contact_no" value="{{old('contact_no')}}"
                           class="form-control @error('contact_no') is-invalid @enderror" required>
                    @error('contact_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>E-mail <span style="color: red;">*</span></th>
                <td>
                    <input type="email" name="email" value="{{old('email')}}"
                           class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="male" @if(old('gender') == 'male'){{'selected'}} @endif>Male</option>
                        <option value="female" @if(old('gender') == 'female'){{'selected'}} @endif>Female</option>
                    </select>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Territory <span style="color: red;">*</span></th>
                <td>
                    <select name="territory_id" class="form-control @error('territory_id') is-invalid @enderror">
                        <option value="" selected disabled>Select</option>
                        @foreach($territoryDetails as $territory)
                            <option @if(old('territory_id') == $territory->territory_id){{'selected'}} @endif value="{{$territory->territory_id}}">{{$territory->territory_name}}</option>
                        @endforeach
                    </select>
                    @error('territory_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>User Name <span style="color: red;">*</span></th>
                <td>
                    <input type="text" name="user_name" value="{{old('user_name')}}"
                           class="form-control @error('user_name') is-invalid @enderror" required>
                    @error('user_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Password <span style="color: red;">*</span></th>
                <td>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td></td>
                <td> <button type="submit" class="btn btn-success">Save</button></td>
            </tr>
        </table>
    </form>
@endsection

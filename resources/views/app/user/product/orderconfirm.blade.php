@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent

@endsection
{{-- Content --}}
@section('main')
@include('flash::message')
@include('utils.errors.list')
<div class="profile-container">
    <div class="profile-section">
        <div class="profile">
            <div class="profile-info">
                <div class="table-responsive">
               
                    <table class="table table-profile">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <h4>{{$fname}} {{$lname}} <small>{{$state}} ,{{$country}}</small></h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr class="highlight">
                                <td class="field">Total Products</td>
                                <td>{{$total[0]->total_count}}</td>
                            </tr>
                            <tr class="highlight">
                            <td class="field">Total Amount</td>
                            <td>{{$total[0]->total_amount}}</td>
                            </tr>
                            <tr>
                                <td class="field">Mobile</td>
                                <td><i class="fa fa-mobile fa-lg m-r-5">{{$contact}}</i></td>
                            </tr>
                            <tr>
                                <td class="field">Email</td>
                                <td>{{$email}}</td>
                            </tr>                                                   
                            <tr class="highlight">
                                <td class="field">Address</td>
                                <td>{{$address}}</td>
                            </tr>
                                       
                            <tr>
                                <td class="field">City</td>
                                <td>{{$city}}</td>
                            </tr>
                            <tr>
                                <td class="field">State</td>
                                <td>{{$state}}</td>
                            </tr>
                            <tr>
                                <td class="field">Country</td>
                                <td>{{$country}}</td>
                            </tr>
                            <tr>         
                                <td colspan="2"> 
                                    <div class="panel-body" align="center">
                                        <h1 style="color: green">Thank you</h1>
                                            <a href="{{url('user/onlinestore/')}}">Return to home</a>
                                    </div>
                                </td>    
                            </tr>          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>                    
</div>
@endsection

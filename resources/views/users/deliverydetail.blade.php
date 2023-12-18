@extends('layouts.app')

@section('content')
<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">My Orders</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">My Orders</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <h2> TRACKING DELIVERY DETAILS</h2>
    <p>Dear valued Customer,Thank you for choosing us.Kindly call or whatsapp this available active number for your items.</p>
              
    <div class="col-md-12">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"> Phone Number</th>
                <th scope="col">Status</th>


              </tr>
            </thead>
            <tbody>
                {{$delivery->name}}
                 <tr>
                    <td>{{$delivery->id}}</td>
                    <td>{{$delivery->name}}</td>
                    <td>{{$delivery->phone_number}}</td>
                    @if($delivery->status == "Busy")
                    <td><button class="btn btn-warning text-white text-center" >{{$delivery->status}}</button></td>
                    @elseif($delivery->status == "Choose Status")
                    <td><button class="btn btn-primary text-white text-center" >{{$delivery->status}}</button></td>
                        @else
                    <td><button class="btn btn-success text-white text-center" >{{$delivery->status}}</button></td>
                @endif

                 </tr>
                


            </tbody>
        </table>



    </div>
</div>    
@endsection



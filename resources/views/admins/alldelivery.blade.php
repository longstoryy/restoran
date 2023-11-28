@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="container">
            @if(Session::has('success'))
               <p class="alert {{Session::get('alert-class','alert-success')}}">{{Session::get('success')}}</p>
            @endif
         </div>
         <div class="container">
          @if(Session::has('delete'))
             <p class="alert {{Session::get('alert-class','alert-success')}}">{{Session::get('delete')}}</p>
          @endif
       </div>


          <h5 class="card-title mb-4 d-inline">Delivery</h5>
          <a  href="{{route('register.delivery')}}" class="btn btn-primary mb-4 text-center float-right">Register Delivery</a>

        
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">Phone number</th>
                <th scope="col">status</th>
                <th scope="col">Date</th>
                <th scope="col">change status</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($delivery as $deliver)
                 <tr>
                    <th scope="row">{{$deliver->id}}</th>
                    <td>{{$deliver->name}}</td>
                    <td> {{$deliver->phone_number}}</td>
                    @if($deliver->status == "Busy")
                        <td><button class="btn btn-warning text-white text-center" >{{$deliver->status}}</button></td>
                        @elseif($deliver->status == "Choose Status")
                        <td><button class="btn btn-primary text-white text-center" >{{$deliver->status}}</button></td>
                            @else
                        <td><button class="btn btn-success text-white text-center" >{{$deliver->status}}</button></td>
                    @endif
                    <td>{{$deliver->created_at}}</td>
                    <td><a href="{{route('delivery.edit',$deliver->id)}}" class="btn btn-secondary text-white text-center ">change status</a></td>
                     <td><a href="{{route('delete.delivery',$deliver->id)}}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>  
                @endforeach

            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>
@endsection

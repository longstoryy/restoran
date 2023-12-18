<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use App\Models\Admin\Admin;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Food\Details;
use Illuminate\Support\Facades\Hash;
use File;

class Adminscontroller extends Controller
{
    
    public function viewLogin(){
        return view('admins.login');
    }

    public function checkLogin(Request $request){


        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);


    }

    public function index(){

        //foods count
        $foodCount = Food::select()->count();
        $adminCount = Admin::select()->count();
        $bookingCount = Booking::select()->count();
        $checkoutCount = Checkout::select()->count();

        return view("admins.index",compact('foodCount','adminCount','bookingCount','checkoutCount'));

    }
    public function allAdmins(){
        $admins = Admin::select()->orderBy('id','desc')->get();
        return view("admins.alladmins",compact('admins'));

    }
    public function createAdmins(){
        
        return view("admins.createadmins");

    }
    public function storeAdmins(Request $request){
        Request ()->validate ([

            "name"=> "required|max:40",
            "email"=> "required|max:40",
            "password"=> "required|max:80",
            
    
            ]);

        $admins =Admin::create([
            "name" =>$request->name,
            "email" =>$request->email,
            "password" =>Hash::make($request->password),
            
        ]);

        if($admins){
            return redirect()->route('admins.all')->with(['success' =>'Admin created successfully']);
        }
        
        
    }
    public function allOrders(){
        $orders = Checkout::select()->orderBy('id','desc')->get();
        return view("admins.allorders",compact('orders'));
    }

    public function editOrders($id){

        $order = Checkout::find($id);

        return view("admins.editorders",compact('order'));
    }
    public function updateOrders(Request $request,$id){

        $order = Checkout::find($id);
        $order->update($request->all());

        if($order){
            return redirect()->route('orders.all')->with(['success' =>'Order updated successfully']);
        }
        

    }
    public function deleteOrders($id){
        $order = Checkout::find($id);
        $order->delete();
        if($order){
            return redirect()->route('orders.all')->with(['delete' =>'Order deleted successfully']);
        }
        
    }

    //bookings
    public function allBookings(){
        $bookings = Booking::select()->orderBy('id','desc')->get();
        return view("admins.allbookings",compact('bookings'));
    }
    public function editBookings($id){

        $booking = Booking::find($id);

        return view("admins.editbookings",compact('booking'));
    }
    public function updateBookings(Request $request,$id){

        $booking = Booking::find($id);
        $booking->update($request->all());

        if($booking){
            return redirect()->route('bookings.all')->with(['update' =>'Booking updated successfully']);
        }
        

    }
    public function deleteBookings($id){
        $booking = Booking::find($id);
        $booking->delete();
        if($booking){
            return redirect()->route('bookings.all')->with(['delete' =>'Booking deleted successfully']);
        }
        
    }
    public function allFoods(){
        $foods = Food::select()->orderBy('id','desc')->get();
        return view("admins.allfoods",compact('foods'));
    }

    public function createFood(){
        
        return view("admins.createfoods");
    }
    public function storeFood(Request $request){
        // Request ()->validate ([

        //     "name"=> "required|max:40",
        //     "email"=> "required|max:40",
        //     "password"=> "required|max:80",
            
    
        //     ]);
        $destinationPath = 'assets/img/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $foods =Food::create([
            "name" =>$request->name,
            "price" =>$request->price,
            "description" =>$request->description,
            "category" =>$request->category,
            "image"=> $myimage
        ]);

        if($foods){
            return redirect()->route('all.foods')->with(['success' =>'Food item created successfully']);
        }
        
    }
    public function deleteFood($id){
        $food = Food::find($id);

        if(File::exists(public_path('assets/img/' . $food->image))){
            File::delete(public_path('assets/img/' . $food->image));
        }else{
            //dd('File does not exists.');
        }
        $food->delete();
        if($food){
            return redirect()->route('all.foods')->with(['delete' =>'Food item deleted successfully']);
        }
        
    }
    public function allDelivery(){
        $delivery = Details::select()->orderBy('id','desc')->get();
        return view("admins.alldelivery",compact('delivery'));

    }
    public function registerDelivery(){
        
        return view("admins.createdelivery");
    }
    public function deliveryDetails(Request $request){
        Request ()->validate ([

            "name"=> "required|max:40",
            "phone_number"=> "required|max:40",
        ]);
        

        $info =Details::create([
            "name" =>$request->name,
            "phone_number" =>$request->phone_number,
    
        ]);

        if($info){
            return redirect()->route('delivery.all')->with(['success' =>'New Delivery has been registered successfully']);
        }
        
    }
    public function editDelivery($id){

        $order = Details::find($id);

        return view("admins.editdelivery",compact('order'));
    }
    public function updateDelivery(Request $request,$id){

        $order = Details::find($id);
        $order->update($request->all());

        if($order){
            return redirect()->route('delivery.all')->with(['success' =>'Delivery info updated successfully']);
        }
    }
    public function deleteDelivery($id){
        $food = Details::find($id);
        $food->delete();
        if($food){
            return redirect()->route('delivery.all')->with(['delete' =>'delivery personnel deleted successfully']);
        }
        
    }
     public function selectDelivery($id){
        $delivery = Details::find($id);
        $delivery->select()->orderBy('id','desc')->get();
        return view("users.deliverydetail",compact('delivery'));
    }

    
    
    
    public function search(Request $request){
        $search=$request->search;
        $foods= Food::where('name', 'Like','%'.$search.'%')->get();
        return view("admins.search",compact('foods'));
    }
    
    

    

    
    
    
    
    
}

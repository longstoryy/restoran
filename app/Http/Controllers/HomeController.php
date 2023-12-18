<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food\Food;
use App\Models\Food\Review;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $breakfastFoods = Food::select()->take(4)
        ->where('category','Breakfast')->orderBy('id','desc')->get();

        $launchFoods = Food::select()->take(4)
        ->where('category','Launch')->orderBy('id','desc')->get();

        $dinnerFoods = Food::select()->take(4)
        ->where('category','Dinner')->orderBy('id','desc')->get();

        $reviews = Review::select()->take(4)
        ->orderBy('id','desc')->get();

        return view('home',compact('breakfastFoods','launchFoods','dinnerFoods','reviews'));
    }


    public function about()
    {


        return view('pages.about');
    }

    public function services()
    {


        return view('pages.services');
    }

    public function contact()
    {


        return view('pages.contact');
    }
    public function sendEmail(Request $request){
        Request ()->validate ([

            "name"=> "required|max:40",
            "email"=> "required|email",
            "subject"=> "required|max:50",
            "message"=> "required|",


        ]);
    
                
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        Mail::to('vincent.doh@outlook.com')->send(new ContactFormMail($data));
        if($data){
            return redirect()->route('contact')->with(['mail' =>'Your email has been sent successfully']);
        }

        //return "Email sent successfully!";
    }








    
    


    

  


    
   
    

}


    //public function sendEmail(Request $request)
    //{
    // Validate the form data
    // $request->validate([
    //     'name' => 'required',
    //     'email' => 'required|email',
    //     'subject' => 'required',
    //     'message' => 'required',
    // ]);
    // $name =['name'=>$request->input('name')];
    // $email =['email'=>$request->input('email')];
    // $subject =['subject'=>$request->input('subject')];
    // $message =['message'=>$request->input('message')];


    

    // Mail::to('cephasadjetey1@gmail.com')->send(new ContactFormMail($email,$name,$subject,$message));

    // return "Email sent successfully!";
     //}





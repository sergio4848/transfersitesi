<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Image;
use App\Models\Message;

use App\Models\Reserve;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;

class HomeController extends Controller
{

    public static function getsetting()
    {
        return Setting::first();
    }
    public function index(){
        $setting=Setting::first();
        $slider=Transfer::select('id','title','image','slug','base_price','category_id')->limit(4)->get();
        $daily=Transfer::select('id','title','image','slug','base_price','category_id')->limit(4)->inRandomOrder()->get();
        $last=Transfer::select('id','title','image','slug','base_price','category_id')->orderByDesc('id')->get();
        $picked=Transfer::select('id','title','image','slug','base_price','category_id')->inRandomOrder()->get();
        $data=[
            'setting'=>$setting,
            'daily'=>$daily,
            'last'=>$last,
            'picked'=>$picked,
            'slider'=>$slider,
            'page'=>'home'

        ];
        return view('home.index',$data);
    }
    public static function categoryList()
    {
        return Category::where('parent_id','=',0)->with('children')->get();
    }


    public function transfer($id,$slug){
        $setting=Setting::first();
        $data=Transfer::find($id);
        $images=Image::where('transfer_id',$id)->get();
        $reviews=Review::where('transfer_id',$id)->get();
        $location=Location::all();

        return view('home.transfer_detail',['setting'=>$setting,'data'=>$data,'images'=>$images,'reviews'=>$reviews,'location'=>$location]);

    }
    public function categorytransfers($id,$slug){
        $setting=Setting::first();
        $datalist=Transfer::where('category_id',$id)->get();
        $data=Category::find($id);

        return view('home.category_transfers',['data'=>$data,'datalist'=>$datalist,'setting'=>$setting]);

    }

    public function aboutus(){
        return view('home.about');
    }
    public function contact(){
        $setting=Setting::first();
        return view('home.contact',['setting'=>$setting,'page'=>'home']);
    }

    public function gettransfer(Request $request)
    {
        $search=$request->input('search');
        $count=Transfer::where('title','like','%'.$search.'%')->get()->count();
        if($count==1)
        {
            $data=Transfer::where('title','like','%'.$search.'%')->first();
            return redirect()->route('transfer',['id'=>$data->id,'slug'=>$data->slug]);
        }
        else
        {
            return redirect()->route('transferlist',['search'=>$search]);
        }


    }
    public function transferlist($search){
        $datalist=Transfer::where('title','like','%'.$search.'%')->get();

        return view('home.search_transfers',['search'=>$search,'datalist'=>$datalist]);

    }
    public function references(){
        $setting=Setting::first();
        return view('home.references',['setting'=>$setting,'page'=>'home']);
    }


    public function sendmessage(Request $request)
    {
        $data = new Message();

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->subject = $request->input('subject');
        $data->message = $request->input('message');


        $data->save();

        return redirect()->route('contact')->with('success','Mesajınız kaydedilmiştir');
    }


    public function sendreview(Request $request,$id)
    {
        $data = new Review;

        $data->user_id = Auth::id();
        $transfer = Transfer::find($id);
        $data->transfer_id=$id;
        $data->subject = $request->input('subject');
        $data->review = $request->input('review');
        $data->IP = $_SERVER['REMOTE_ADDR'];

        $data->save();

        return redirect()->route('transfer',['id'=>$transfer->id,'slug'=>$transfer->slug])->with('success','Mesajınız kaydedilmiştir');
    }
    public function sendreserve(Request $request,$id)
    {
        $data = new Reserve;
        $data->user_id = Auth::id();
        $transfer = Transfer::find($id);
        $data->fromlocation = $request->input('fromlocation');
        $data->tolocation = $request->input('tolocation');
        $data->transfer_id = $id;
        $data->flightDate = $request->input('flightDate');
        $data->flightTime = $request->input('flightTime');
        $data->pickupTime = $request->input('pickupTime');






        $data->IP = $_SERVER['REMOTE_ADDR'];
        $data->save();

        return redirect()->route('reserveconfirm',['id'=>$transfer->id,'slug'=>$transfer->slug]);
    }
    public function reserveconfirm(){
        $setting=Setting::first();
        return view('home.reservation_confirm',['setting'=>$setting]);
    }


    public function faq(){
        $setting=Setting::first();
        $datalist=Faq::all()->sortBy('position');
        return view('home.faq',['datalist'=>$datalist,'setting'=>$setting]);
    }

    public function login(){
        return view('admin.login');
    }
    public function logincheck(Request $request)
    {
        if($request->isMethod('post'))
        {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('admin');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        else
        {
            return view('admin.login');
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

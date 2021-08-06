<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Gift;
use App\DataTables\UserDataTable;
use DataTables;
use Carbon\Carbon;
use Mail;

class AdminController extends Controller
{
    public function adminLogin(){
      return view('admin.adminLogin');
    }

    public function postAdminLogin(Request $request){
      $request->validate([
        'email' => 'required',
        'password' => 'required'
      ]);
      $user = User::where('email', $request->input('email'))->first();
      if($user){
        if($user->is_admin == 1){
          if(Hash::check($request->password, $user->password)){
            if ($request->ajax()) {
                  $data = User::select('*');
                  return Datatables::of($data)->addColumn('name', function ($user) {
                                  return '<h6><a href="/users/'. $user->name .'">'. $user->name .'</a></h6>';
                                  })
                                ->rawColumns(['name'])
                                ->make(true);
              }
              return view('admin.dashboard');
          }
        }else{
          return back()->with('fail', 'you are not admin user');
        }
      }
      return back()->with('fail', 'you are not admin user');
    }

    public function showUser($name){
      $user = User::where('name', $name)->first();
      return view('admin.displayUser')->with('user', $user);
    }

    public function displayUsers(Request $request){
      $gifts = Gift::select('*')->get();
      if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)->addColumn('name', function ($user) {
                            return '<h6><a href="/admin/users/'. $user->name .'">'. $user->name .'</a></h6>';
                            })
                          ->addColumn('is_verified', function ($user) {
                                            if($user->is_verified){
                                              return '<input type="checkbox" id="'.$user->id.'" checked
                                              onclick="checkBoxEvent('.$user->id.')">';
                                            }else{
                                              return '<input type="checkbox" id="'.$user->id.'"
                                              onclick="checkBoxEvent('.$user->id.')">';
                                            }
                                          })
                          ->addColumn('gift', function ($user){
                              return '<button type="submit" class="btn btn-success" value="gift"
                              id="'.$user->id.'" onclick="giftUser('.$user->id.')"
                              data-toggle="modal" data-target="#exampleModalLong">Gift</button>';
                          })
                          ->rawColumns(['name', 'is_verified', 'gift'])
                          ->make(true);
        }
        return view('admin.users')->with('gifts', $gifts);
    }

    public function latestRecipes(){
      $date = Carbon::now()->subDays(7);
      $recipes = Recipe::where('created_at', '>=', $date)->get();
      return view('admin.latestRecipes')->with('recipes', $recipes);
    }

    public function updateIsActive(Request $request){
      $user = User::find($request->input('id'));
      $status = $request->input('status');
      if($status == 'checked'){
        $user->is_verified  = 1;
        $user->save();
        return response()->json(['checked' => "checked"]);
      }else{
        $user->is_verified  = 0;
        $user->save();
        return response()->json(['unchecked' => "unchecked"]);
      }
    }

    public function gitfUser(Request $request){
      echo 'yes';
      sendGift($request->input('id'));
    }

    public function sendGift(Request $request){
      $request->validate([
        'quantity' => 'required|min:0',
        'gift_name' => 'required'
      ]);
      $user = User::find($request->input('id'));
      $gift = Gift::where('name', $request->input('gift_name'))->first();
      $quantity = $request->input('quantity');
      if($gift->quantity > $quantity){
        $gift->quantity = $gift->quantity - $quantity;
        $gift->save();
        Mail::send('email.gift', ['gift' => $request], function($message) use($user){
                $message->to($user->email);
                $message->subject('Gift Recieved');
            });
        return back()->with('success', 'gift sent successfully');
      }else{
        return back()->with('fail', 'Not enough quantity to gift');
      }
    }
  }

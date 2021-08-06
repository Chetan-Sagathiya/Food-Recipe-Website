<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use  App\Models\Recipe;
use  App\Models\Category;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Validator;
use App\DataTables\UserDataTable;
use Mail;

class MainController extends Controller
{
    public function index(){
      $recipes = Recipe::paginate(4);
      return view('index', compact('recipes'));
    }

    public function login(){
      return view('login');
    }

    public function register(){
      return view('register');
    }

    public function postRegister(Request $request){
      $request->validate([
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required|min:6|max:12'
      ]);

      $token = Str::random(64);

      User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'remember_token' => $token,
      ]);

      Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
          });

      return redirect('login')->with('success', 'mail send for verification');
    }

    public function verifyUser($token){
      $message = 'Sorry your email cannot be identified';

        $user = User::where('remember_token', $token)->first();

        if(!is_null($user)){
          if(is_null($user->is_verified )){
              $user->is_verified  = 1;
              $user->save();
              $message = 'Email Verified Now you can Login';
          }else{
            $message = "Your e-mail is already verified. You can now login.";
          }
        }
        return redirect('/login')->with('success', $message);
      }

    public function postLogin(Request $request){
      $request->validate([
          'email' => 'required|email',
          'password' => 'required',
      ]);

      $user = User::where('email', '=', $request->email)->first();
      if($user){
        $is_verified = $user->is_verified;
        if($is_verified ==0){
          return back()->with('fail', 'Please verify your Account');
        }
      }
      if(!$user){
            return back()->with('fail','We do not recognize your email address');
        }else{
          if(Hash::check($request->password, $user->password)){
            $request->session()->put('LoggedUser', $user->id);
                return redirect('/dashboard')->withSuccess('you are logged in');;
          }
          else{
              return back()->with('fail','enter correct credentials');
          }
        }
      }

    public function dashboard(){
      return view('dashboard');
    }

    public function forgetPassword(){
      return view('forgetPassword');
    }

    public function postForgetPassword(Request $request){
      $request->validate([
          'email' => 'required|email',
        ]);

      Mail::send('email.password', ['mail' => $request->email], function($message) use($request){
              $message->to($request->email);
              $message->subject('Forget Password Reset');
          });
      return back()->with('success', 'Email has been sent');
    }

    public function setPassword($mail){
      $user = User::where('email', $mail)->first();
      if($user){
        return view('setPassword')->with('user', $user);
      }else{
        return redirect('login')->with('fail', 'email not found');
      }
    }

    public function postSetPassword(Request $request, $id){
      $request->validate([
          'password' => 'required|min:6|max:12',
          'confirm-password' => 'required|min:6|max:12',
        ]);
        if($request->input('password') == $request->input('confirm-password')){
            $user = User::find($id);
            $password = Hash::make($request->input('password'));
            $user->password = $password;
            $user->save();
            return redirect('/login')->with('success', 'password changed successfully');
        }else{
          return back()->with('fail', 'password did not matched');
        }
    }

    public function addRecipe(){
      $categories = Category::all();
      return view('addRecipe')->with('categories', $categories);
    }

    public function postAddRecipe(Request $request){
      $request->validate([
        "name" => 'required|unique:recipes',
        "category" => 'required',
        "description" => 'required',
        "image" => 'required|mimes:jpg,png,jpeg|max:5048',
      ]);

      $category_id = Category::where('name', $request->input('category'))->first();
      $newImageName = time(). '.' . $request->image->extension();
      $test = $request->image->move(public_path('images'), $newImageName);

      Recipe::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'category_id' => $category_id->id,
        'image' => $newImageName,
        'user_id' => session()->get('LoggedUser'),
      ]);

      return back()->with('success', 'Recipes Added SuccessFully');
    }

    public function showRecipe($id){
      $recipe = Recipe::find($id);
      $logged_user_id = session()->get('LoggedUser');
      $favorite = Favorite::select('recipe_id')->where('user_id', $logged_user_id)->get();
      $emptyArray = array();
      foreach ($favorite as $favorite) {
        array_push($emptyArray, $favorite->recipe_id);
      }
      //dd($emptyArray);
      return view('viewRecipe')->with('recipe', $recipe)
                             ->with('favorite', $emptyArray);
    }

    public function storeAjaxComment(Request $request){

      $validator = Validator::make($request->all(), [
          'review_detail' => 'required',
          'recipe_id' => 'required',
          'ratings' => 'required|min:1|max:5',
      ]);

      if ($validator->passes()) {
        $review = Review::create([
          'review_detail' => $request->input('review_detail'),
          'recipe_id' => $request->input('recipe_id'),
          'ratings' => $request->input('ratings'),
          'user_id' => $request->input('user_id'),
        ]);
        if($review){
          return response()->json(['success' => 'Review Added SuccessFully']);
        }else{
          return response()->json(['error' => 'Opps! Something Went Wrong.']);
        }
        }else{
          return response()->json(['error' => 'Opps! Something Went Wrong.']);
        }
      }

      public function favoriteRecipe(Request $request){
        if($request->input('class') == 'has'){
          Favorite::Create([
            'recipe_id' => $request->input('recipe_id'),
            'user_id' => $request->input('user_id'),
          ]);
          return response()->json(['success' => "added to favorite"]);
        }else{
          $favorite = Favorite::select('id')
                    ->where('recipe_id', '=' , $request->input('recipe_id'))
                    ->where('user_id', '=', $request->input('user_id'))
                    ->delete();
          return response()->json(['success' => "Removed From Favorite"]);
        }
      }
      public function Favorite(){
        $logged_user_id = session()->get('LoggedUser');
        $user = User::find($logged_user_id);
        $user::paginate(1);
        return view('favorites',)->with('favorites', $user);
      }

      public function searchCategories(Request $request){
        if($request->input('categories')){
            $query = $request->input('categories');
            $data = Category::where('name', 'like', '%'.$query.'%')
                            ->get();
            $output = '<ul style="display:block !important; margin-left:300px;" class="dropdown-menu">';
            if($data->count()>0){
              foreach($data as $row){
                $output .= '<li id="find-categories" class="find-categories"
                            style="cursor:pointer;" value='.$row->id.'>'.$row->name.'</li>';
              }
              $output .= '</ul>';
              echo $output;
            }else{
                $output .= '<li>Record  Not Found </li>';
                $output;
            }
        }
      }

      public function searchByCategories(Request $request){
        $category_id = Category::where('name', $request->input('search-categories'))->first();
        $recipes_filter = Recipe::where('category_id', $category_id->id)->get();
        return back()->with('recipes_filter', $recipes_filter);
      }
  }

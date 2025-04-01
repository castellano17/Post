<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
      //dd($request->all());
   //   dd($request->all());
   //  dd($request->user());
    //  dd($request->user()->id);

    // dd(
    //   $request->user()->friendsFrom()->get(),
    //   $request->user()->friendsTo()->get()
    
    // );

    if($request->get('for-my')){
      // $posts = Post::where('user_id', $request->user()->id)->latest()->get();
      $user = $request->user();
      $friends_from_ids = $user->friendsFrom()->pluck('users.id');
      $friends_to_ids = $user->friendsTo()->pluck('users.id');
      $user_ids = $friends_from_ids->merge($friends_to_ids)->push($user->id);

      $posts = Post::whereIn('user_id', $user_ids)->latest()->get();
  
     
    }else{
      $posts = Post::latest()->get();
    }
        
        
      
         return view('dashboard', compact('posts'));
    }

    public function profile(User $user)
    {
      $posts = $user->posts()->latest()->get();
        return view('profile', compact('user', 'posts'));
    }

    public function status(Request $request)
    {
       $requests = $request->user()->pendingTo;
      $sent = $request->user()->pendingFrom;
        return view('status', compact('requests', 'sent'));
    }
}

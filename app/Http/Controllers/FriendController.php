<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function store(Request $request, User $user)
    {

         //para verificar si el usuario ya es amigo
        //  dd(
        //     $request->user()->id,
        //     $user->id,
        //     $request->user()->from()->where('to_id', $user->id)->exists(),
        //     $request->user()->to()->where('from_id', $user->id)->exists()

        //  );
       // $is_from = $request->user()->from()->where('to_id', $user->id)->exists();
       // $is_to = $request->user()->to()->where('from_id', $user->id)->exists();

      
        if(!$request->user()->isRelated($user)){
            
            $request->user()->from()->attach($user);
        }
    }
    
  


    public function update(Request $request, User $user)
    {
    
        // dd(
        //     $user->id,
        //     $request->user()->pendingTo
        // );
        // $request->user()->pendingTo()->where('from_id', $user->id)->update([
        //     'accepted' => true,
        // ]);
        $request->user()->pendingTo()->updateExistingPivot($user,['accepted' => true]);
        return back();
    }
}

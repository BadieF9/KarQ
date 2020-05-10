<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterAndLogin extends Controller
{
   public function register(RegisterRequest $request){

       $validated_data = $request->validated();

       User::create([
           'name' => $validated_data['name'],
           'email' => $validated_data['email'],
           'password' => Hash::make($validated_data['password'],)
       ]);
       return redirect('login');

   }

   public function login(){



   }
}

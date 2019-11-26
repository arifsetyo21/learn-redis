<?php
namespace App\Services;

use App\Update as Update;

class UpdateRegistrar {
   /** 
    * Get a Validator for incomming post submission
    * @param array $data
    * @return \Illuminate\Contracts\Validation\Validator
   */
   public function validator(array $data){
      return \Validator::make($data, [
         'update' => 'required|max:50|min:5'
      ])->validate();
   }

   /**
    * Create new post instance after a valid submission
    * 
    * @param 
    * @return User
    */ 

   public function create(array $data, $id){
      
      return Update::create([
         'update' => $data['update'],
         'userID' => $id
      ]);
   }
}
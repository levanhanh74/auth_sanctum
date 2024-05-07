<?php

namespace App\Http\Services;

use App\Models\User;

class Users
{
    // get one record 
    function getById($id)
    {
        return User::where('id', $id)->get();
    }
    // Save user 
    function store($data)
    {
        return User::create($data);
    }
    // get 1 record
    function getRecord($email)
    {
       return User::where('email', $email)->first();
    }
}

<?php

namespace App\Http\Repository;

use App\Models\User;
use Hash;

class UserRepository
{
    public function createUser($data)
    {
        $model = new User;
        $model->firstname = $data->firstname;
        $model->lastname = $data->lastname;
        $model->password = Hash::make($data->password);

        if($model->save()) return true;

        return false;
    }   

}
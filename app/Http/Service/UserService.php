<?php

namespace App\Http\Service;

use App\Http\Repository\UserRepository;
use Validator;
use Exception;
use Hash;

class UserService
{
    public function __construct(UserRepository $repo){
        $this->repo = $repo;
    }

    public function createUser($data)
    {
        try{
            $validate =  $this->validationRequest($data);

            $res['code'] = 401;
            $res['message'] = 'Missing Mandatory Fields';

            if($validate){
                $save = $this->repo->createUser($data);

                if($save){
                    $res['code'] = 200;
                    $res['message'] = 'Success';
                }else{
                    $res['code'] = 402;
                    $res['message'] = 'Error Creating Data';
                }
            }


        }catch(Exception $e){

            $res['code'] = 400;
            $res['message'] = $e->getMessage();
            $res['file'] = $e->getFile();
            $res['line'] = $e->getLine();
        }

        return $res;
    }


    public function validationRequest($data)
    {
        $validator = Validator::make($data->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return false;

        return true;
    }
}
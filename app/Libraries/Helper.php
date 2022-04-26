<?php

namespace App\Libraries;


class Helper
{
    public static function responseApp($status='success',$message=null,$data=null) : array
    {
        $output = [
            'status' => $status,
            'message' => $message,
            'data'=> $data
        ];
        return $output;
    }
    public static function generatePassword($password): string
    {
        return md5(sha1($password));
    }
}






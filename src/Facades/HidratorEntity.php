<?php

namespace App\Facades;

trait HidratorEntity
{
    public function hidrate(array $request)
    {
        foreach ($request as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->{$method}($value);
            }
        }
    }
}
<?php
if (!function_exists('views'))
{
     function views($price)
    {
        return number_format($price,2,'.',' ');
    }
}

if (!function_exists('flash'))
{
     function flash($class, $message)
    {
       $info = "flex items-center mb-4 bg-blue-500 text-white text-sm font-bold px-4 py-3";
       $danger = "flex items-center mb-4 bg-red-500 text-white text-sm font-bold px-4 py-3";

       if ($class == 1)
       {
           session()->flash('alert.class',$info);
           session()->flash('alert.message',$message);
       }else
       {
           session()->flash('alert.class',$danger);
           session()->flash('alert.message',$message);

       }


    }
}

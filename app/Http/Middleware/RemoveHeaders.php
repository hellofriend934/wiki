<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveHeaders
{
         protected array $removeHeader =[
           'X-Powered-By',
           'x-Powered-by',
             'Server',
             'server',
         ];

         protected array $addHeaders =[
             'Expect-CT'=>'enforce, max-age=30', // защищает от поддельных сертификатов
             'strict-transport-security'=>'max-age=31536000, includeSubDomains',// Разрешен только https конект, включая субдомены
             'X-Content-Type-Options'=>'nosniff', //Показывает только html разметку, если не указать может принять исполняемы js код за html
             'referrer-policy'=>'no-referrer-when-downgrade', //Не указывает на переход с https на http
             'certificate-transparency'=>'enforce, max-age=30',// enforce - указывает что конект возможен только через ccl(сертификат) соединение
         ];

    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);
        foreach ($this->removeHeader as $header)
        {
            header_remove($header);
        }

        foreach ($this->addHeaders as $key => $value)
        {
            $response->headers->set(key: $key, values: $value);
        }
        return $response;
    }
}

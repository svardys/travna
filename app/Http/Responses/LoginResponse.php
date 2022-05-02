<?php

namespace App\Http\Responses;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {

        return new UserResource(Auth::user());

    }
}

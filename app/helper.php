<?php

use App\relationTypeUsers;
use Illuminate\Support\Facades\Auth;


/**
 *
 */
function roleUser()
{
    $userType = relationTypeUsers::query()->where('id_user', Auth::user()->id)->first();
    return $userType->id_type;
}

function statusUser()
{
    $userType = relationTypeUsers::query()->where('id_user', Auth::user()->id)->first();
    return $userType->status;
}
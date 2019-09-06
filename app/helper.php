<?php

use App\relationTypeUsers;


/**
 *
 */
function roleUser()
{
    $userType = relationTypeUsers::query()->where('id_user', Auth::user()->id)->first();
    return $userType->id_type;
}
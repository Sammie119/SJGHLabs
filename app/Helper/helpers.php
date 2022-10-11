<?php

use Illuminate\Support\Facades\DB;

    function getUsername($user_id)
    {
        return DB::table('users')->select('username')->where('user_id', $user_id)->first()->username ?? DB::table('users')->select('username')->where('user_id', 3)->first()->username;
    }

    function getDepartment($id)
    {
        return DB::table('dropdowns')->select('dropdown')->where('dropdown_id', $id)->first()->dropdown ?? DB::table('dropdowns')->select('dropdown')->where('dropdown_id', 2)->first()->dropdown;
    }
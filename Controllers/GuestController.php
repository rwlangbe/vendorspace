<?php

namespace vendorspace\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use vendorspace\models\User;


class GuestController extends Controller
{
    public function getVendorarea()
    {
        return view('guest.vendorarea');
    }

    public function getPlannerarea()
    {
        return view('guest.plannerarea');
    }

    public function getEntertainerarea()
    {
        return view('guest.entertainerarea');
    }
}


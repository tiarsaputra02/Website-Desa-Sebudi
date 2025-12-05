<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;

class CitizenController extends Controller
{
    //
    public function Show($id)
    {
        $citizen = Citizen::findOrfail($id);
        if ($citizen) {

           $birthdate = $citizen->tanggal_lahir ;

            $dateofbirth =  Carbon::parse($birthdate);

            $age = floor($dateofbirth->diffInYears(Carbon::now()));
            $age = round($dateofbirth->diffInYears(Carbon::now()),0);

        }
        $dateOfBirth = Carbon::createFromFormat('Y-m-d', $citizen->tanggal_lahir);
        $tanggal_lahir = $dateOfBirth->format('d-m-Y');

        return view('citizen.pura.show',compact('citizen','age','tanggal_lahir'));
    }
}

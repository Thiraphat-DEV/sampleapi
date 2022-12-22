<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dummy extends Controller
{
    public function index() {
        $data = ['name' => "Thiraphat", "Email" => "thiraboaty@gmail.com", "work" => "Remote Worker And Work From Anywhere"];
        // dd($data);
        return $data;
    }
}

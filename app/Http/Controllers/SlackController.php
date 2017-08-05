<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlackTeam;

class SlackController extends Controller
{
  
  public function index()
  {
    return view('layouts.dashboard');
  }
  
}

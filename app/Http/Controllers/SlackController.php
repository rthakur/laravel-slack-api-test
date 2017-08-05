<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlackTeam;
use Auth;

class SlackController extends Controller
{
  
  public function index()
  {
    $slackTeams = SlackTeam::where('user_id', Auth::id())->get();
    
    return view('slack.index', ['slackTeams' => $slackTeams]);
  }
  
  
  public function disconnect($id)
  {
    
    SlackTeam::where('id', $id)->where('user_id', Auth::id())->delete();
    
    return redirect('/');
  }
  
}

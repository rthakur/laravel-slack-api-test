<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlackTeam;
use App\SlackTeamUsers;
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
    $SlackTeam = SlackTeam::where('id', $id)->where('user_id', Auth::id())->first();
    
    if( $SlackTeam )
    {
      SlackTeamUsers::where('slack_team_id', $SlackTeam->id)->delete();
      $SlackTeam->delete();
    }
    
    
  
    return redirect('/');
  }
  
  public function users($id)
  {
    $slackTeam = SlackTeam::where('id', $id)->where('user_id', Auth::id())->first();
    
    if( !$slackTeam ) 
    return redirect('/');
    
    return view('slack.users', ['slackTeam' => $slackTeam]);
  }

  
}

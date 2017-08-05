<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlackTeam;
use App\SlackTeamUsers;
use Auth;

class SlackAPIController extends Controller
{
  public function getConnect(Request $request)
  {
    $authCode = $request->code;
    
    if($authCode)
    {
      $data = array(
                  'client_id' => env('SLACK_CLIENT_ID'),
                  'client_secret' => env('SLACK_CLIENT_SECRET'),
                  'code' => $authCode,
                  'redirect_uri' => 'http://testslack.app/slack/connect'
                  );
                  
        $data_string = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://slack.com/api/oauth.access");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        $response =  json_decode($response, true);
        curl_close ($ch);
        
        if(isset($response['ok']) && $response['ok'])
        {
          $this->saveSlackTeam($response); 
          
          return redirect('/'); 
        }
        elseif(isset($response['error']))
        {
          return $response['error'];
        }
        
        return "Something went wrong";  
    
     }else{
      echo "Invalid Code";
    }
  
            
  }
  
  
  
  private function saveSlackTeam($response)
  {
    $slackTeam = SlackTeam::firstOrNew(['user_id'=> Auth::id(), 'team_id' => $response['team_id']]);
    $slackTeam->team_name = $response['team_name'];
    $slackTeam->access_token = $response['access_token'];
    $slackTeam->save();
    
    $this->saveSlackTeamUsers($slackTeam);
    
  }
  
  
  private function saveSlackTeamUsers($slackTeam)
  {
    $getdata = @file_get_contents('https://slack.com/api/users.list?token='.$slackTeam->access_token);
    $getdata = json_decode($getdata, true);
    
    if(isset($getdata['members']) && is_array($getdata['members']))
      
      foreach ($getdata['members'] as $member) 
      {
        if($member['name'] == 'slackbot') continue;
        
        $slackuser = SlackTeamUsers::firstOrNew(['slack_team_id' => $slackTeam->id, 'slack_id' => $member['id']]);
        $slackuser->name = $member['name'];
        $slackuser->real_name = $member['real_name'];
        $slackuser->tz = $member['tz'];
        $slackuser->tz_label = $member['tz_label'];
        $slackuser->tz_offset = $member['tz_offset'];
        $slackuser->profile_image = isset($member['profile']['image_512'])? $member['profile']['image_512'] : '';
        $slackuser->save();
      }
      
  }
  
}

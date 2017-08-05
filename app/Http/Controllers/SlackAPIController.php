<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SlackTeam;
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
  }
  
}

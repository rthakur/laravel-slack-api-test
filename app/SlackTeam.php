<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlackTeam extends Model
{
    protected $guarded = [];
    
    
    public function getUsers()
    {
      return $this->hasMany('App\SlackTeamUsers', 'slack_team_id', 'id');
    }
    
}

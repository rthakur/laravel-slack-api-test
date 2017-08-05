@extends('layouts.dashboard')
@section('title', 'Slack Accounts')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Slack Accounts</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li class="active">
                <strong>Slack Accounts</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
    <div class="wrapper wrapper-content animated fadeInUp">
      @if(count($slackTeams))
        <div class="ibox">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a href="https://slack.com/oauth/authorize?client_id={{ env('SLACK_CLIENT_ID') }}&scope=team:read&redirect_uri={{ env('SLACK_CLIENT_REDIRECT_URL')}}" class="btn btn-primary btn-xs">Connect Slack Account</a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="project-list">
                  
                    <table class="table table-hover">
                        <tbody>
                        @foreach($slackTeams as $team)  
                        <tr>
                            <td class="project-title">
                                <a href="#">{{$team->team_name}}</a>
                                <br/>
                                <small>Connect At: {{ $team->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="project-people">
                                <a href="/assets/"><img alt="image" class="img-circle" src="/assets/img/a3.jpg"></a>
                                <a href="/assets/"><img alt="image" class="img-circle" src="/assets/img/a1.jpg"></a>
                                <a href="/assets/"><img alt="image" class="img-circle" src="/assets/img/a2.jpg"></a>
                                <a href="/assets/"><img alt="image" class="img-circle" src="/assets/img/a4.jpg"></a>
                                <a href="/assets/"><img alt="image" class="img-circle" src="/assets/img/a5.jpg"></a>
                            </td>
                            <td class="project-actions">
                                <a href="/slack/disconnect/{{$team->id}}" class="btn btn-default btn-sm"> Disconnect </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        @else
          <h3 class="text-center"> You have not connected any slack account yet, click here to <a href="https://slack.com/oauth/authorize?client_id={{ env('SLACK_CLIENT_ID') }}&scope=team:read&redirect_uri={{ env('SLACK_CLIENT_REDIRECT_URL')}}" class="btn btn-primary"> Connect to slack</a></h3>
        @endif 
    </div>
</div>
</div>
@endsection
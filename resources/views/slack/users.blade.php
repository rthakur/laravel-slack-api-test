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
        <div class="ibox">
            <div class="ibox-content">
                <div class="project-list">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($slackTeam->getUsers as $user)  
                        <tr>
                            <td class="project-title" width="40">
                                <a href="#"><img title="{{ $user->real_name }}" alt="{{ $user->real_name }}" class="img-circle" src="{{ $user->profile_image }}" style="width:40px"></a>
                            </td>
                            <td class="project-title">
                                <a href="#">{{$user->real_name}}</a>
                            </td>
                            <td class="project-people">
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
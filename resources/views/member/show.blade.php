@extends('layouts.app')
@section('page-title')
    {{ ucfirst($member->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view m-b-15">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#">
                                    <img class="avatar"
                                         src="{{ ($member->info->face) ? asset('storage/' . $member->info->face) : asset('img/user.jpg') }}"
                                         alt="{{ $member->name }}" title="{{ $member->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 m-b-0">{{ $member->info->full_name }}</h3>
                                        <small
                                                class="text-muted">{{ ucfirst($member->premium->category->category) }}</small>
                                        <div class="staff-id">{{ __('validation.attributes.id') }} : {{ $member->slug }}</div>
                                        <div class="staff-id">{{ ucfirst(__('validation.attributes.status')) }} :
                                            @if($member->premium->status->status === 'inactive')
                                                <span class="label label-warning-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @elseif($member->premium->status->status === 'active')
                                                <span class="label label-success-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @else
                                                <span class="label label-danger-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @endif
                                        </div>
                                        <div class="staff-id">{{ __('validation.attributes.limit_date') .' : ' . Carbon\Carbon::parse($member->premium->limit)->format('d-m-Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.phone') }} :</span>
                                            <span class="text"><a href="#">{{ $member->info->tels[0]->tel }}</a></span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.email') }} :</span>
                                            <span class="text">
                                                <a href="#"
                                                   title="{{ $member->info->emails[0]->email }}">{{ $member->info->emails[0]->email }}</a>
                                            </span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.birth') }} :</span>
                                            <span
                                                    class="text">{{ ($member->info->birth) ? Carbon\Carbon::parse($member->info->birth)->format('d-m') : 'inconnu' }}</span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.address') }} :</span>
                                            <span class="text">
                                                {{ $member->info->address . ', ' . ucfirst($member->info->city->city) }}
                                            </span>
                                        </li>
                                        @if($member->info->sex)
                                            <li class="row text-left">
                                                <span class="title">{{ __('validation.attributes.sex') }} :</span>
                                                <span class="text">{{ $member->info->sex }}</span>
                                            </li>
                                        @endif
                                        @if($member->info->cin)
                                            <li class="row text-left">
                                                <span class="title">{{ __('validation.attributes.cin') }} :</span>
                                                <span class="text">{{ $member->info->cin }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
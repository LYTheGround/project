<?php

namespace App\Http\Controllers\Rh;

use App\Http\Requests\InfoRequest;
use App\Http\Requests\PswRequest;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{

    public function show(Member $member)
    {
        return view('member.show',compact('member'));
    }

    public function params()
    {
        return view('member.params',['member' => auth()->user()->member]);
    }

    public function updateParams(InfoRequest $request)
    {
        // update info
        $member = auth()->user()->member;
        $info = $member->info;
        $r = $request->all();
        $r['city_id'] = $request->city;
        // update face
        if(!is_null($request->file('face'))){
            if($info->face){
                Storage::disk('public')->delete($info->face);
            }
            $face = $request->file('face')->store('users');
            $r['face'] = $face;
        }
        $info->update($r);
        $member->update($r);
        // update email
        $member->info->emails[0]->update(['email' => $request->email]);
        // update tel
        $member->info->tels[0]->update(['tel' => $request->phone]);

        session()->flash('status', __('rh/member.success_params'));

        return redirect()->route('member.show',compact('member'));
    }

    public function psw()
    {
        return view('member.psw');
    }

    public function updatePsw(PswRequest $request)
    {
        auth()->user()->update(['password' => bcrypt($request->password)]);
        session()->flash('status', __('rh/member.psw_success'));
        return redirect()->route('member.show',['member' => auth()->user()->member]);
    }
}

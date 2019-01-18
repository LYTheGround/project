<?php

namespace App\Http\Controllers\Rh;

use App\City;
use App\Info;
use App\Notifications\Rh\CreatePositionNotification;
use App\Notifications\Rh\UpdatePositionNotification;
use App\Position;
use App\Rules\PhoneRule;
use App\Rules\SexRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{

    public function index()
    {
        return view('position.index', [
            'positions' => auth()->user()->member->company->positions,
            'cities'    => City::all(),
        ]);
    }

    public function create()
    {
        return view('position.create',['cities' => City::all()]);
    }

    private function validated(Request $request)
    {
        return Validator::make($request->all(), [
            'position'  => 'required|string|min:3|max:20',
            'first_name' => 'required|string|min:3|max:20',
            'last_name' => 'required|string|min:3|max:20',
            'address' => 'nullable|string|min:10|max:100',
            'sex' => ['required', 'string', new SexRule()],
            'city' => 'required|int|exists:cities,id',
            'birth' => ['bail','required','date','before:' . date('Y-m-d', strtotime("-18 years"))],
            'cin' => 'nullable|string|min:6|max:15',
            'face' => 'nullable|mimes:png,jpg,jpeg,bmp',
            'email' => 'required|email',
            'tel' => ['required','min:10','max:10', new PhoneRule()],
        ]);
    }

    public function store(Request $request)
    {
        $v = $this->validated($request);
        if($v->fails()){
            return redirect()
                ->route('position.create')
                ->withErrors($v)
                ->withInput();
        }


        $data = $request->all();
        if($request->face){
            $data = array_merge($data, ['face' => $request->file('face')->store('positions')]);
        }
        $data = array_merge($data, ['city_id' => $request->city]);

        $info = Info::create($data);
        $info->emails()->create(['email' => $data['email'], 'default' => 1]);
        $info->tels()->create(['tel' => $data['tel'], 'default' => 1]);

        $position = $info->position()->create([
            'position' => $request->position,
            'member_id' => auth()->user()->member->id,
            'company_id' => auth()->user()->member->company->id
        ]);

        Notification::send($position->colleagues(), new CreatePositionNotification($position));

        session()->flash('status',__('rh/position.stored',['value' => $request->poste]));

        return redirect()->route('position.show',compact('position'));
    }

    public function show(Position $position)
    {

        $this->authorize('view',$position);

        $cities = City::all();

        return view('position.show', compact('position','cities'));
    }

    public function edit(Position $position)
    {

        $this->authorize('update',$position);

        $cities = City::all();

        return view('position.edit', compact('position', 'cities'));
    }

    public function update(Request $request, Position $position)
    {
        $this->authorize('update',$position);

        $validate = $this->validated($request);

        if($validate->fails()){
            return redirect()
                ->route('position.edit',compact('position'))
                ->withErrors($validate)
                ->withInput();
        }

        $position->update(['position' => $request->position]);

        $data = $request->all();

        $data = array_merge($data, ['city_id' => $request->city]);

        $position->info->update($data);

        $position->info->emails[0]->update(['email' => $request->email]);

        $position->info->tels[0]->update(['tel' => $request->tel]);

        if ($request->file('face')) {
            Storage::disk('public')->delete($position->info->face);
            $position->info->update([
                'face'  => $request->file('face')->store('positions'),
            ]);
        }

        Notification::send($position->colleagues(), new UpdatePositionNotification($position));

        session()->flash('status', __('rh/position.updated',['value' => $position->info->full_name]));

        return redirect()->route('position.show',compact('position'));

    }

    public function destroy(Position $position)
    {
        $this->authorize('update',$position);

        $position->info->emails()->delete();
        $position->info->tels()->delete();
        $position->info->delete();

        if($position->info->face){
            if (file_exists('storage/' . $position->info->face)) {
                @unlink('storage/' . $position->info->face);
            }
        }

        $position->delete();

        session()->flash('status', __('rh/position.deleted'));

        return redirect()->route('position.index');
    }

}

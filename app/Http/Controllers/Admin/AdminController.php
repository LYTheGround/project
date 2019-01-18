<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        $this->authorize('owner',Admin::class);

        return view('admin.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $this->authorize('owner',Admin::class);

        session()->flash('status', __('admin/admin.stored'));

        return redirect()
            ->route('admin.show', ['admin' =>  Admin::onCreate($request)]);
    }

    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    public function params()
    {
        return view('admin.edit');
    }

    public function updateParams(UpdateAdminRequest $request,Admin $admin)
    {

        session()->flash('status', __('admin/admin.updated'));

        return redirect()->route('admin.show',['admin' => $admin->onUpdate($request)]);
    }

    public function destroy(Admin $admin)
    {
        $this->authorize('owner',Admin::class);

        if($admin->type != 'A'){

            if($admin->companies[0]){
                $admin->ownerSwitch(auth()->user()->admin->id);
            }

            $admin->delete();

            session()->flash('status',__('admin/admin.deleted'));

            return redirect()->route('admin.index');
        }

        session()->flash('danger', __('admin/admin.owner'));

        return back();

    }
}

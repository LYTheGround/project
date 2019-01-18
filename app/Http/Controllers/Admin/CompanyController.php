<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\City;
use App\Company;
use App\Http\Requests\Company\CompanyRequest;
use App\Http\Requests\Company\SoldRequest;
use App\Http\Requests\Company\StatusRequest;
use App\Info;
use App\Info_box;
use App\Premium;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

/**
 * seuls les admin A et B ont accès a cette class
 *
 * Class CompanyController
 * @package App\Http\Controllers\Admin
 */
class CompanyController extends Controller
{

    /**
     * la list de toutes les company sans exception.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (auth()->user()->admin->type === "A")?
            $companies = Company::all()
        :
            $companies = auth()->user()->companies;
        ;
        return view('company.index',compact('companies'));
    }

    /**
     * le profil de la compagnie
     *
     * @param Company $company
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Company $company)
    {
        $token = $company->tokens()->where('category_id',2)->first();
        return view('company.show',compact('company','token'));
    }

    /**
     * le formulaire de creation
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Créer une nouvel company.
     * Auto premium sold = 10 range = 5.
     * Le month est créer automatiquement avec le premier achat.
     *
     * @param CompanyRequest $request
     * @param Premium $premium
     * @param Info_box $info_box
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request,Premium $premium,Info_box $info_box,Company $company)
    {
        $brand = null;
        // brand
        if($request->brand_){
            $brand = $request->brand_->store('companies');
        }

        $request->request->add(['brand' => $brand, 'city_id' => $request->city]);

        $premium = $premium->onCreateCompany();

        $info_box= $info_box->onCreate($request);

        $info_box->emails()->create(['email' => $request->email, "default" => 1]);

        $info_box->tels()->create(['tel' => $request->tel, "default" => 1]);

        $company->onCreate(auth()->user()->admin,$premium,$info_box,str_slug($request->name . ' ' . $info_box->id));

        return redirect()->route('company.show',compact('company'));
    }

    /**
     * Modification des info's de base de la compagnie.
     *
     * @param Company $company
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Company $company)
    {
        $cities = City::all();

        return view('company.edit',compact('company','cities'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $info_box = $company->info_box;
        $brand = $info_box->brand;
        // brand
        if($request->brand_){
            if($brand){
                Storage::disk('public')->delete($info_box->brand_);
            }
            $brand = $request->brand_->store('company/brand');
        }
        // update
        $company->info_box()->update([
            'brand'     => $brand,
            'name'      => $request->name,
            'licence'   => $request->licence,
            'turnover'  => $request->turnover,
            'fax'       => $request->fax,
            'speaker'   => $request->speaker,
            'address'   => $request->address,
            'build'     => $request->build,
            'floor'     => $request->floor,
            'apt_nbr'   => $request->apt_nbr,
            'zip'       => $request->zip,
            'city_id'   => $request->city,
        ]);

        return redirect()->route('company.show',compact('company'));
    }

    public function sold(Company $company)
    {
        $this->authorize('owner',Admin::class);
        return view('company.sold',compact('company'));
    }

    public function updateSold(SoldRequest $request, Company $company)
    {
        $premium = $company->premium;
        $premium->update(['sold' => $request->sold + $premium->sold]);
        return redirect()->route('company.show',compact('company'));
    }

    public function status(Company $company)
    {
        $this->authorize('owner',Admin::class);
        return view('company.status',compact('company'));
    }

    public function updateStatus(StatusRequest $request, Company $company)
    {
        $premium = new Premium();
        $premium->updateStatus($request->status,$company);
        return back();
    }


}

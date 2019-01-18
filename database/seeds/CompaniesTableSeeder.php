<?php

use App\Admin;
use App\Company;
use App\Info_box;
use App\Premium;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Premium $premium
     * @param Request $request
     * @param Info_box $info_box
     * @param Company $company
     * @return void
     */
    public function run(Premium $premium, Request $request, Info_box $info_box, Company $company):void
    {
        $premium = $premium->onCreateCompany();

        $request->request->add([
            'brand'     => 'companies/logo.png',
            'name'      => "Company SARL",
            'licence'   => "123456",
            'ice'       => "12345678900001",
            'turnover'  => 10000,
            'taxes'     => 10,
            'fax'       => "0522334455",
            'speaker'   => "pdg",
            'address'   => "BD Zektouni maârif",
            'build'     => 15,
            'floor'     => 5,
            'apt_nbr'   => 18,
            'zip'       => 20000,
            'city_id'   => 2
        ]);

        $info_box= $info_box->onCreate($request);
        $info_box->emails()->create(['email' => "company@ly.ly", "default" => 1]);
        $info_box->tels()->create(['tel' => "0522447788", "default" => 1]);

        $company->onCreate(Admin::find(1),$premium,$info_box,"company-sarl-1");
    }
}

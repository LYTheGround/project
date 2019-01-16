<?php

use App\Category;
use App\Company;
use App\Info;
use App\Member;
use App\Premium;
use App\Token;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Category $category
     * @param User $user
     * @param Info $info
     * @param Token $token
     * @param Premium $premium
     * @param Member $member
     * @return void
     */
    public function run(Category $category, User $user, Info $info, Token $token, Premium $premium, Member $member)
    {

        foreach ($category->where('category', '!=', 'company')->get() as $categori) {
            $category = $categori->category;
            $data = [
                "name"      => $category,
                'slug'      => $category,
                "email"     => "$category@ly.ly",
                "password"  => "066145392mM",
                'face'      => $this->face($category),
                'last_name' => "last_$category",
                'first_name'=> "fist_$category",
                'sex'       => "homme",
                'birth'     => Carbon::parse('20-07-1987'),
                'address'   => "D mouhamed 6 jamila I n° 1443",
                'cin'       => "bh461945",
                'city'      => 2,
                "tel"       => "0657834565"
            ];
            // users
            $user = $user->onCreate($data);
            // info
            $info = $info->onCreate($data['face'], $data);
            // email
            $info->emails()->create(['email' => $data['email'], 'default' => 1]);
            // tels
            $info->tels()->create(['tel' => $data['tel'], 'default' => 1]);
            // token
            $company = Company::first();
            $token = $token->onCreate($company->premium, 2,$categori->id);
            // premium
            $premium = $premium->onCreate($token);
            // member
            $member->onCreate($user, $info, $premium, $company->id, $data);
        }


    }

    /**
     * @param string $category
     * @return null|string
     */
    private function face(string $category)
    {
        if($category === 'pdg')                 return "users/user-02.jpg";
        else if ($category === 'manager')       return 'users/user-03.jpg';
        else if ($category === 'accounting')    return 'users/user-04.jpg';
        else if ($category === 'commercial')    return 'users/user-05.jpg';
                                                return null;
    }
}

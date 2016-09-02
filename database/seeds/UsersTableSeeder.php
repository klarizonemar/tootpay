<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use App\Models\Role;
use App\Models\TootCard;
use Carbon\Carbon;
use App\Models\Setting;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create(User::adminJson())->roles()->attach(Role::find(admin()));
        User::create(User::guestJson())->roles()->attach(Role::find(guest()));

        foreach (User::cashiersJson() as $cashier) {
            User::create($cashier)->roles()->attach(Role::find(cashier()));
        }

        foreach (User::cardholdersJson() as $cardholder) {
            $user = User::create($cardholder);
            $user->roles()->attach(Role::find(cardholder()));

            $faker = Faker::create();
            $toot_card = TootCard::create([
                'id' => '000' . $faker->randomNumber(7),
                'uid' => '100012' . $faker->randomNumber(7),
                'pin_code' => $faker->randomNumber(4),
                'load' => floatval($faker->randomNumber(3)),
                'points' => floatval($faker->randomNumber(2)),
                'is_active' => 'on',
                'expires_at' => Carbon::now()->addYear(intval(Setting::value('toot_card_expire_year_count'))),
            ]);
            $user->tootCards()->attach($toot_card);
        }

        $test = User::create(User::testJson());
        $test->roles()->attach(Role::find(cardholder()));
        $test->tootCards()->attach(TootCard::create(TootCard::testJson()));
    }
}

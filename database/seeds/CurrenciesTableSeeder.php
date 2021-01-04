<?php

use App\Currency;
use App\ExchangeRate;
use App\Position;
use App\ProductCategory;
use App\Salary;
use App\UnitOfMeasure;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_titles=[
            ['name'=>'human resources','salary_id'=>1],
            ['name'=>'supervisor','salary_id'=>2],
            ['name'=>'manager','salary_id'=>1],
            ['name'=>'cashier','salary_id'=>3],
            ['name'=>'admin','salary_id'=>1],
            ];

            $grades=[
                ['grade'=>'A','amount'=>200],
                ['grade'=>'B','amount'=>500],
                ['grade'=>'C','amount'=>900],
                ];
        $currencies=[
            ['currency_code'=>'ZWL','currency_name'=>'RTGS Dollar Bond'],
            ['currency_code'=>'USD','currency_name'=>'United States Dollar'],
            ['currency_code'=>'ZAR','currency_name'=>'South African Rand'],
            ['currency_code'=>'ECO','currency_name'=>'Ecocash'],
            ['currency_code'=>'SWP','currency_name'=>'Swipe'],
        ];
        $categories=[
            ['category_name'=>'Hardware'],
            ['category_name'=>'Plumbing'],
            ['category_name'=>'Building'],
            ['category_name'=>'Carpentry'],
            ['category_name'=>'Electrical'],
            ['category_name'=>'Other'],
        ];
        $units=[
            ['unit_of_measure'=>'Each'],
            ['unit_of_measure'=>'Box'],
            ['unit_of_measure'=>'Packet'],
            ['unit_of_measure'=>'Pair'],
            ['unit_of_measure'=>'KGs'],
        ];
        $users=[
           ['name'=>'Farai Zihove','email'=>'fzihove@agribank.co.zw','password'=>Hash::make('12345678'),'admin'=>true,'cashier'=>true],
            ['name'=>'Insta Cashier','email'=>'cashier@insta.co.zw','password'=>Hash::make('12345678'),'admin'=>false,'cashier'=>true],
        ];
        foreach ($currencies as $currency){
          $code=  Currency::query()->create($currency);
          ExchangeRate::query()->create([
            'currency_code'=>$code->id,
            'rate'=>rand(1.0,25.0),
          ]);
        }
        foreach ($categories as $category){
            ProductCategory::query()->create($category);
        }
        foreach ($units as $unit){
            UnitOfMeasure::query()->create($unit);
        }
        foreach ($users as $user){
            User::query()->create($user);
        }
        foreach ($grades as $grade){
            Salary::query()->create($grade);
        }
        foreach ($job_titles as $job_title){
            Position::query()->create($job_title);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Seo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* ===Default USER Data Inserted with command php artisan db:seed===  */
        User::create([
            'name'          =>'Shariful Isam',
            'email'         =>'shariful971@gmail.com',
            'password'      =>Hash::make('said'),
            'is_admin'      =>true,
        ]);

        /* ===Default SEO Data Inserted with command php artisan db:seed===  */
        Seo::create([
            'meta_title'          =>'Ecommerce',
            'meta_author'         =>'shariful971'
        ]);

        /* ===Default SMTP Data Inserted with command php artisan db:seed===  */  
        $smtp=array();
        $smtp['mailer']='smtp';
        $smtp['host']='smtp.gmail.com';
        DB::table('smtps')->insert($smtp);

    }
}


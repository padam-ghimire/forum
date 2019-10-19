<?php

use App\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Channel::create([
            'name'=> 'Laraval 6',
            'slug'=> Str::slug('Laravel 6')
        ]);

         Channel::create([
            'name'=> 'React Js',
            'slug'=> Str::slug('React Js')
        ]);

        Channel::create([
            'name'=> 'Vue Js',
            'slug'=> Str::slug('Vue Js')
        ]);

        Channel::create([
            'name'=> 'Android and ios',
            'slug'=> Str::slug('Anddroid and ios')
        ]);
    }
}

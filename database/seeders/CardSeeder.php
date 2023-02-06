<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CardSeeder extends Seeder
{
    public function run()
    {
        if (App::environment(['local'])) {
            Card::factory()
                ->count(3)
                ->create();
        }
    }
}

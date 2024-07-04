<?php

use App\Models\Newsletter;
use Illuminate\Database\Seeder;

class NewsletterSeeder extends Seeder
{
    public function run()
    {
        Newsletter::create([
            'name' => 'Test Newsletter',
            'description' => 'This is a test newsletter',
            'active' => true,
        ]);

        Newsletter::create([
            'name' => 'Another Newsletter',
            'description' => 'Another test newsletter',
            'active' => true,
            'created_at' => now()->subDays(1),
            'updated_at' => now(),
        ]);
    }
}

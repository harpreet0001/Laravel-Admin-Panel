<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory(100)->create();
    }
}

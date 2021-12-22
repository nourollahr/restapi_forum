<?php

namespace Database\Seeders;


use App\Models\Thread;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thread::factory()->count(50)->create()->each(function ($thread) {
//        	\App\Traits\RecordsActivity::create([
//        		'user_id' => $thread->user_id,
//				'subject_id' => $thread->id,
//				'subject_type' =>
//			]);
		});
    }
}

<?php

namespace Tests\Feature\app\Http\Controllers\Api;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IndexControllerTest extends TestCase
{
	use DatabaseMigrations;
	 /**
     * A basic test example.
     *
     *@test
     * @return void
     */

    public function IndexController(){

    	// $users = factory(App\User::class)->create([
    	// 		'name' => "Ok",
    	// 		'age' => 12,
    	// 		'address' => "NV",
    	// 		'photo' => "pk.jpg",
    	// 		]);
    	// return $users;
    	// foreach ($users as $user) {
    	// 	$this->seeJson([
    	// 		'name' => $user->name,
    	// 		'age' => $user->age,
    	// 		'address' => $user->address,
    	// 		'photo' => $user->photo,
    	// 		]);
    	// }
    }
}

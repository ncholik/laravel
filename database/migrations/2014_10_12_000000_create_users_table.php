<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
			$table->string('username')->unique();
            $table->string('email')->unique();
			$table->integer('unit')->nullable()->unsigned();
			$table->integer('staff')->nullable()->unsigned();//pengusul cuman pada staff no 3 & 4
            $table->string('status');//status 0 = tidak aktif, 1 = internal, 2 = eksternal
			$table->string('role_aktif')->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
		
		/* // Insert some stuff
		$data = [
			array(
				'name' => 'Administrator',
				'email' => 'ncadvertise@gmail.com',
				'username' => 'super',
				'password' => Hash::make('admin!@#123'),
				'unit' => 0,
				'staff' => 0,
				'status' => 2
			),
			array(
				'name' => 'Fendi',
				'email' => 'fendihermawan@yahoo.co.id',
				'username' => 'fendi',
				'password' => '',
				'unit' => 77,
				'staff' => 3,
				'status' => 2
			)
		];
		DB::table('users')->insert($data); */

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

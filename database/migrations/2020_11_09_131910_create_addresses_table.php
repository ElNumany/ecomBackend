<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street_name');
            $table->string('street_number');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('post_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
// 'street_name'=>$this->faker->streetName,
// 'street_number'=> $this->faker->numberBetween(1 , 500),
// 'city'=>$this->faker->city,
// 'state'=> $this->faker->countryCode,
// 'country'=> $this->faker->country,
// 'post_code'=> $this->faker->postcode,
// ];
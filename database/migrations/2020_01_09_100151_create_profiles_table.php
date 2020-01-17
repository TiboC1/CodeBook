<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('nickname')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->string('banner')->nullable();
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->string('relationship')->nullable();
            $table->string('work')->nullable();
            $table->string('education')->nullable();
            $table->boolean('priDob')->default(0);   
            $table->boolean('priCity')->default(0);   
            $table->boolean('priRelationship')->default(0);   
            $table->boolean('priWork')->default(0);   
            $table->boolean('priEducation')->default(0);   
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
        Schema::dropIfExists('profiles');
    }
}

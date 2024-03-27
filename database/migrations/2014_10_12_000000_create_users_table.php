<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('userSurname');
            $table->string('adrUser');
            $table->string('secretCode');
            $table->date('accountDateCreation',now());
            $table->string('accountStatue');
            $table->string('profilePicture')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->unique();
            $table->bigInteger('accountNumber')->unique();
            $table->bigInteger('ammount')->default(0);
            // $table->unsignedBigInteger('type_user_id')->unique(); // clé étrangère
            // $table->foreign('type_user_id')->references('id')->on('type_users');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

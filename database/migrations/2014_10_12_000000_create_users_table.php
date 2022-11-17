<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('nip')->unique();
            $table->string('name');
            $table->string('email')->unique();
            // We don't need this! $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // We don't need this! $table->rememberToken();
            $table->boolean('is_admin')->default(false);
            $table->string('position')->nullable();
            $table->string('address')->nullable();
            $table->string('telp')->nullable();
            $table->unsignedTinyInteger('quota')->default(12);
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
        Schema::dropIfExists('users');
    }
};

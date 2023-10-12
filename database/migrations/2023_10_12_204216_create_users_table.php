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
        Schema::connection("mysql::read")->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('email')->unique();
            $table->smallInteger('age');
        });

        Schema::connection("mysql::write")->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('email')->unique();
            $table->smallInteger('age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection("mysql.read")->dropIfExists('users');
        Schema::connection("mysql.write")->dropIfExists('users');
    }
};

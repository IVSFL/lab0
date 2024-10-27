<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->text('speciallity')->nullable(false);
            $table->string('email', 255)->unique()->nullable(false);
        });

        DB::statement("ALTER TABLE teacher ADD CONSTRAINT valid_email CHECK (email ~* '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$')");
    
        DB::statement("ALTER TABLE teacher ADD CONSTRAINT valid_name CHECK (trim(name) <> '' AND name ~* '^[^\\s]+.*$')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}

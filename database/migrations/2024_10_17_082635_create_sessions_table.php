<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('course')->onDelete('cascade');
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
        });

        DB::statement("ALTER TABLE session ADD CONSTRAINT check_date CHECK (end_date > start_date)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session');
    }
}

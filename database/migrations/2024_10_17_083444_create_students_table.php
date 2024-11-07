<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->string('email', 255)->unique()->nullable(false);
            $table->string('phone_number', 11)->nullable(false);
        });

        DB::statement("CREATE UNIQUE INDEX unique_student_email_trimmed ON teacher (LOWER(TRIM(email)))");

        DB::statement("ALTER TABLE teacher ADD CONSTRAINT valid_student_email CHECK (email ~* '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$')");

        DB::statement("ALTER TABLE teacher ADD CONSTRAINT valid_student_name CHECK (TRIM(name) <> '')");
   
        DB::statement("ALTER TABLE student ADD CONSTRAINT valid_student_phone CHECK (phone_number ~* '^\\+?[0-9]{10,15}$')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}

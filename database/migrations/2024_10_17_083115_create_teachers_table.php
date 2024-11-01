<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTeachersTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        // Создаем таблицу
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->text('speciality')->nullable(false);
            $table->string('email', 255)->unique()->nullable(false);
        });

        DB::statement("DROP INDEX IF EXISTS unique_teacher_email_trimmed");
        DB::statement("ALTER TABLE teacher DROP CONSTRAINT IF EXISTS valid_email");
        DB::statement("ALTER TABLE teacher DROP CONSTRAINT IF EXISTS valid_name");
        DB::statement("ALTER TABLE teacher DROP CONSTRAINT IF EXISTS valid_speciality");

        DB::statement("CREATE UNIQUE INDEX unique_teacher_email_trimmed ON teacher (LOWER(TRIM(email)))");

        DB::statement("ALTER TABLE teacher ADD CONSTRAINT valid_teacher_email CHECK (email ~* '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$')");

        DB::statement("ALTER TABLE teacher ADD CONSTRAINT valid_teacher_name CHECK (TRIM(name) <> '')");
        DB::statement("ALTER TABLE teacher ADD CONSTRAINT valid_teacher_speciality CHECK (TRIM(speciality) <> '')");
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}
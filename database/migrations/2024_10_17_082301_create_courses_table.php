<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->unique()->nullable(false);
            $table->text('description')->unique()->nullable(false);
            $table->decimal('price', 10, 2)->nullable(false);
            $table->smallInteger('duration')->nullable(false);
        });

        DB::statement("CREATE UNIQUE INDEX unique_course_title_trimmed ON course (LOWER(TRIM(title)))");
        DB::statement("CREATE UNIQUE INDEX unique_course_description_trimmed ON course (LOWER(TRIM(description)))");

        DB::statement("ALTER TABLE course ADD CONSTRAINT valid_course_title CHECK (trim(title) <> '')");

        DB::statement("ALTER TABLE course ADD CONSTRAINT valid_course_description CHECK (trim(description) <> '')");
        
        DB::statement("ALTER TABLE course ADD CONSTRAINT positive_course_price CHECK (price > 0)");

        DB::statement("ALTER TABLE course ADD CONSTRAINT positive_course_duration CHECK (duration > 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
}

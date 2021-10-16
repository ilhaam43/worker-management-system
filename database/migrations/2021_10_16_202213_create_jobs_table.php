<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('product_category_id')->constrained('product_category')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('country');
            $table->foreignId('job_status_id')->constrained('jobs_status');
            $table->string('company_website')->unique();
            $table->string('company_email')->unique();
            $table->string('screenshot_url')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsFormSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_form_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->nullable()->constrained('product_category')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('website');
            $table->boolean('email');
            $table->boolean('country');
            $table->boolean('screenshot');
            $table->boolean('remark');
            $table->boolean('name');
            $table->boolean('number');
            $table->boolean('link');
            $table->boolean('text');
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
        Schema::dropIfExists('jobs_form_settings');
    }
}

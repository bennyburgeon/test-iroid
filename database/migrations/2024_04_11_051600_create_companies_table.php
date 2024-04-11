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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('company_id');
            $table->string('name');
            $table->text('description');
            $table->string('logo');
            $table->string('contact_number');
            $table->bigInteger('annual_turnover');
            $table->integer('created_by')->unsigned()->references('admin_id')->on('admins')->nullable(); 
            $table->integer('updated_by')->unsigned()->references('admin_id')->on('admins')->nullable(); 
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
        Schema::dropIfExists('companies');
    }
};

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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employee_id');
            $table->string('name');
            $table->string('email');
            $table->integer('company')->unsigned()->references('company_id')->on('companies')->nullable(); 
            $table->string('mobile_number');
            $table->string('image');
            $table->date('join_date');
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
        Schema::dropIfExists('employees');
    }
};

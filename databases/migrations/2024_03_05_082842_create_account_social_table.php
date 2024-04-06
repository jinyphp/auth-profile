<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_social', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('enable')->default(1);

            // 사용자 id 연동
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // facebook, github, youtube ...
            $table->string('type')->nullable();

            $table->string('twitter')->nullable();
            $table->string('github')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();




            // link
            $table->string('link')->nullable();


            $table->text('description')->nullable();


            // 관리 담당자
            $table->unsignedBigInteger('manager_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_social', function (Blueprint $table) {
            Schema::dropIfExists('account_social');
        });
    }
}

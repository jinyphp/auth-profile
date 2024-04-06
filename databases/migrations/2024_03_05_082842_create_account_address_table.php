<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_address', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('enable')->default(1);

            // 사용자 id 연동
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // 지역정보
            $table->string('country')->nullable();

            $table->string('state')->nullable();
            $table->string('region')->nullable();

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();

            $table->string('zipcode')->nullable();

            // 기본설정값
            $table->string('selected')->nullable();

            // 설명
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
        Schema::table('account_address', function (Blueprint $table) {
            Schema::dropIfExists('account_address');
        });
    }
}

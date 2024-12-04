<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone_number')->nullable()->after('last_name');
            $table->text('address')->nullable()->after('phone_number');
            $table->unsignedBigInteger('RoleID')->nullable()->after('address');

            // Adding foreign key constraint to RoleID
            $table->foreign('RoleID')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['RoleID']);
            $table->dropColumn(['first_name', 'last_name', 'phone_number', 'address', 'RoleID']);
        });
    }
}

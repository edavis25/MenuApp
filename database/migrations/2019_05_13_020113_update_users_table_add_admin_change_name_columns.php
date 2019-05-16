<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableAddAdminChangeNameColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name']);

            // This is a hacky workaround to avoid SQLite oddities...I want phpunit tests to run in an SQLite in-memory
            // database, however, the migrations throw exceptions for no default value on not null field or something
            // and I'd like to keep DB integrity enforcing at least 1 name for an account
            $connection_name = $driver = Schema::connection($this->getConnection())->getConnection()->getDriverName();
            if ($connection_name === 'sqlite') {
                $table->string('first_name')->nullable();
            }
            else {
                $table->string('first_name');
            }

            $table->string('last_name')->nullable();
            $table->boolean('is_admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name']);
            $table->dropColumn(['last_name']);
            $table->dropColumn(['is_admin']);
            $table->string('name');
        });
    }
}

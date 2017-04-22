<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailLoginsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('email_logins', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('email_logins');
    }
}

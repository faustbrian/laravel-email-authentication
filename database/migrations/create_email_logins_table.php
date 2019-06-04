<?php

declare(strict_types=1);

/*
 * This file is part of Laravel E-Mail Authentication.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

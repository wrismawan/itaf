<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPackagesTable extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id', 'author_fk_3648266')->references('id')->on('users');
        });
    }
}

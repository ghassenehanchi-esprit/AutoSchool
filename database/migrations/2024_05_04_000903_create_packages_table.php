<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->required();
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->unsignedTinyInteger('promo')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}

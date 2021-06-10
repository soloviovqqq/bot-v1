<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTradesTable
 */
class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->float('entry_price');
            $table->timestamp('entry_time');
            $table->float('exit_price')->nullable();
            $table->timestamp('exit_time')->nullable();
            $table->float('pln')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
}

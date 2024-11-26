<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportHistoryTable extends Migration
{

    // php artisan queue:work
    public function up()
    {
        Schema::create('import_history', function (Blueprint $table) {
            $table->id();
            $table->string('table_type')->nullable();
            $table->foreignId('pays_id')->constrained('pays')->nullable();
            $table->string('user_name')->default('admin');
            $table->string('tag')->nullable();
            $table->string('action')->nullable();
            $table->string('filename')->nullable();
            $table->integer('total_records')->default(0);
            $table->integer('imported_records')->default(0);
            $table->integer('skipped_records')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('import_history');
    }
}
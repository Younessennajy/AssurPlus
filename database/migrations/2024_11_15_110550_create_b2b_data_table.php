<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('b2b', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('director_name');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('phone');
            $table->string('gsm')->nullable();
            $table->foreignId('country_id')->constrained('countries');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('b2b');
    }
};

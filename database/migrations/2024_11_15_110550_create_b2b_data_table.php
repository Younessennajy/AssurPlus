<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('b2b', function (Blueprint $table) {
            $table->id();
            $table->string('raison_social');
            $table->string('dirigeant_name');
            $table->string('dirigeant_prenom');
            $table->string('address');
            $table->string('postal_code');
            $table->string('ville');
            $table->string('phone');
            $table->string('gsm')->nullable();
            $table->foreignId('pays_id')->constrained('pays');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('b2b');
    }
};

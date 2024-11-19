<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('b2b', function (Blueprint $table) {
            $table->id();
            $table->string('raison_social')->nullable();
            $table->string('dirigeant_name')->nullable();
            $table->string('dirigeant_prenom')->nullable();
            $table->string('address')->nullable();;
            $table->string('postal_code')->nullable();
            $table->string('ville')->nullable();
            $table->string('phone')->nullable();
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

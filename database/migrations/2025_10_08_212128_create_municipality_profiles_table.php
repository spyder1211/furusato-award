<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('municipality_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('prefecture');
            $table->string('city');
            $table->decimal('population', 10, 2)->nullable()->comment('人口（万人）');
            $table->text('characteristics')->nullable()->comment('特色');
            $table->integer('election_count')->nullable()->comment('当選回数');
            $table->string('birthplace')->nullable()->comment('出身地');
            $table->string('university')->nullable()->comment('出身大学');
            $table->text('philosophy')->nullable()->comment('信条');
            $table->text('expertise')->nullable()->comment('得意分野');
            $table->bigInteger('furusato_tax_amount')->nullable()->comment('ふるさと納税金額（円）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipality_profiles');
    }
};

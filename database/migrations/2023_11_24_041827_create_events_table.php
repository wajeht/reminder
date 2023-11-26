<?php

use App\Enums\RecurringType;
use App\Enums\UnitType;
use App\Models\User;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->text('description')->nullable();

            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();

            $table->enum('recurrence_type', RecurringType::getValues())->nullable();
            $table->integer('recurrence_interval')->nullable();

            $table->string('logo_url')->nullable();
            $table->string('color')->nullable();
            $table->string('unit')->default(UnitType::Days->value);

            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

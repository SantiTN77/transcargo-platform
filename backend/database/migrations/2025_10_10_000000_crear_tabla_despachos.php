<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('despachos', static function (Blueprint $tabla): void {
            $tabla->id();
            $tabla->string('conductor', 120);
            $tabla->string('vehiculo', 20);
            $tabla->string('estado', 40);
            $tabla->date('fecha');
            $tabla->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('despachos');
    }
};


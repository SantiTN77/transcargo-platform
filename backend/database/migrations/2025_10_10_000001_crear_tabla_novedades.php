<?php

declare(strict_types=1);

use App\Enums\TipoNovedadEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('novedades', static function (Blueprint $tabla): void {
            $tabla->id();
            $tabla->foreignId('id_despacho')
                ->constrained('despachos')
                ->cascadeOnDelete();
            $tabla->string('tipo')->index();
            $tabla->string('descripcion', 500);
            $tabla->dateTime('fecha');
            $tabla->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('novedades');
    }
};


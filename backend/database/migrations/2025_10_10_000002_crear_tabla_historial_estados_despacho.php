<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('historial_estados_despacho', static function (Blueprint $tabla): void {
            $tabla->id();
            $tabla->foreignId('id_despacho')
                ->constrained('despachos')
                ->cascadeOnDelete();
            $tabla->string('estado_anterior', 40);
            $tabla->string('estado_nuevo', 40);
            $tabla->dateTime('cambiado_en');
            $tabla->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_estados_despacho');
    }
};

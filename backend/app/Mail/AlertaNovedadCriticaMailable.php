<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\NovedadDespacho;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertaNovedadCriticaMailable extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(private readonly NovedadDespacho $novedad)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('Alerta crítica de despacho')
            ->view('emails.alerta_novedad_critica', [
                'novedad' => $this->novedad,
                'despacho' => $this->novedad->despacho,
            ]);
    }
}

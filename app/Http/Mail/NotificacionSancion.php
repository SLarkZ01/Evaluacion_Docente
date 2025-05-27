<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionSancion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    /**
     * Datos de la sanción
     * @var object
     */
    public $sancion;

    /**
     * Contenido del PDF generado
     * @var string
     */
    protected $pdfContent;

    /**
     * Nombre del archivo PDF
     * @var string
     */
    protected $pdfFileName;

    /**
     * Create a new message instance.
     *
     * @param object $sancion
     * @param string $pdfContent
     * @param string $pdfFileName
     */
    public function __construct($sancion, $pdfContent, $pdfFileName)
    {
        $this->sancion = $sancion;
        $this->pdfContent = $pdfContent;
        $this->pdfFileName = $pdfFileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo('rrhh@institucion.edu', 'Departamento de RRHH')
                    ->subject('Notificación de Resolución de Sanción - ' . $this->sancion->numero_resolucion)
                    ->view('emails.notificacion_sancion')
                    ->attachData($this->pdfContent, $this->pdfFileName, [
                        'mime' => 'application/pdf',
                    ])
                    ->with([
                        'sancion' => $this->sancion,
                        'fecha' => now()->format('d/m/Y'),
                    ]);
    }
   
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificacion Sancion',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

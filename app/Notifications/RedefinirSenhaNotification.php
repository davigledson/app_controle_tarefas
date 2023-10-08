<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;
    /**
     * Create a new notification instance.
     */
    public function __construct($token,$email,$name)
    {
        //
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url ='http://localhost:8000/password/reset/'. $this->token .'?email='.$this->email;
        $minutos = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        $saudacao ='Olá ' . $this->name;

        return (new MailMessage)
        ->subject('Atualização de senha')
        ->greeting($saudacao)
        ->line('Esqueceu a senha? Sem problemas, vamos resolver isso!!!')
        ->action('Clique aqui para modificar a senha', $url)
        ->line("O link acima expira em $minutos minutos", ['count' => $minutos])
        ->line('Caso você não tenha requisitado a alteração de senha, então nenhuma ação é necessaria')
        ->salutation('Até breve!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KycStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;
    protected $status;
    protected $notes;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $notes)
    {
       $this->status = $status;
       $this->notes = $notes;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('KYC Verification Update')
            ->greeting('Hello ' . $notifiable->name . '!');
        if($this->status === 'verified'){
            $message->line('Great news! Your KYC documents have been verified. ')
                    ->line('Your account is now fully active.')
                    ->action('Go to Dashboard', url('/admin/dashboard'));
        }else{
            $message->error()
                    ->line('Your KYC verification was rejected.')
                    ->line('Reason: ' . ($this->notes ?? 'Please contact support.'))
                    ->line('Please upload valid documents to reactivate your account.')
                    ->action('Re-upload Documents', url('/admin/kyc/upload'));
        }
        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'KYC Status: ' . ucfirst($this->status),
            'status' => $this->status,
            'message' => $this->status === 'verified'
                ? 'Your account has been verified successfully.'
                : 'KYC Rejected: ' . $this->notes,
                'action_url' => '/kyc-upload',
            //
        ];
    }
}

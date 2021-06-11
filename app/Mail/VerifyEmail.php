<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable {
    use Queueable, SerializesModels;

    protected $user, $url;

    public function __construct($user, $url) {
        $this->user = $user;
        $this->url = $url;
    }

    public function build() {
        return $this->from('noreply@teeta.com')
            ->to($this->user->email)
            ->subject('Teeta Reminder - Verify Email')
            ->markdown('mails.verify-email')
            ->with([
                'name' => $this->getLastName($this->user->name),
                'url' => $this->url
            ]);
    }

    private function getLastName($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        return $last_name;
    }

}

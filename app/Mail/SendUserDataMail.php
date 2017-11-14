<?php
declare(strict_types=1);

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendUserDataMail
 *
 * @package App\Mail
 */
class SendUserDataMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\User
     */
    private $user;
    private $password;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\User $user
     * @param $pass
     */
    public function __construct(User $user, $pass)
    {
        $this->user     = $user;
        $this->password = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Регистрация в сервисе');

        return $this->view('mail.sendData')->with([
            'email'    => $this->user->email,
            'password' => $this->password,
        ]);
    }
}

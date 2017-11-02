<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Mail\SendUserDataMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

/**
 * Class SendUserMailJob
 *
 * @package App\Jobs
 */
class SendUserMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\User
     */
    private $user;
    /**
     * @var
     */
    private $password;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendUserDataMail($this->user, $this->password);

        Mail::to($this->user)->send($email);
    }
}

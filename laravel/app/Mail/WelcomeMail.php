<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $examlink;
    public $student_id;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->examlink = $data['examlink'];
        $this->student_id = $data['student_id'];
        $this->email = $data['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to the Career Test')
                    ->with([
                        'name' => $this->name,
                        'examlink' => $this->examlink,
                        'student_id' => $this->student_id,
                        'email' => $this->email
                    ]);
    }
}

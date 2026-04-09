<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class TestInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $testUrl;

    public function __construct(Student $student)
    {
        $this->student = $student;
        $this->testUrl = URL::signedRoute('test', [
            'student' => $student->id
        ]);
    }

    public function build()
    {
        return $this->markdown('emails.test-invitation')
            ->subject('Your Test Invitation');
    }
}
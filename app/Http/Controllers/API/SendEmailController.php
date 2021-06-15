<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Mail;
use App\Mail\API\NotifyMail;

class SendEmailController extends BaseController
{
         
     
    public function sendEmail()
    {
 
      Mail::to('paco.portada@protonmail.com')->send(new NotifyMail());
 
      if (Mail::failures()) {
		  return $this->sendError('paco.portada@protonmail.com', 'Sorry! Please try again latter');
      } else {
		  return $this->sendResponse('paco.portada@protonmail.com', 'Great! Email sent OK');
      }
    } 
    
    public function sendMail(Request $request) {
    $data = $request->all();

    $messageBody = $this->getMessageBody($data);

    Mail::raw($messageBody, function ($message) {
        $message->from('yourEmail@domain.com', 'Learning Laravel');
        $message->to('paco.portada@protonmail.com');
        $message->subject('Learning Laravel test email');
    });

    // check for failures
      if (Mail::failures()) {
		  return $this->sendError('paco.portada@protonmail.com', 'Sorry! Please try again latter');
      } else {
		  return $this->sendResponse('paco.portada@protonmail.com', 'Great! Email sent OK');
      }
}
}

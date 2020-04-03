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
                     "add-review-status" => "Thank you for your review!",
                     "add-to-cart-status" => "Added to cart!",
                     "remove-from-cart-status" => "Removed from cart!",
                     "subscribe-status" => "Subscribed!",
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please contact support.",
					 "signup-status-error" => "There was a problem creating your account, please contact support.",
					 "profile-status-error" => "There was a problem updating your profile, please contact support.",
					 "update-status-error" => "There was a problem updating the account, please contact support.",
					 "contact-status-error" => "There was a problem sending your message, please contact support.",
					 "add-review-status-error" => "There was a problem sending your review, please contact support.",
					 "add-to-cart-status-error" => "There was a problem adding this product to your cart, please contact support.",
					 "remove-from-cart-status-error" => "There was a problem removing this product from your cart, please contact support.",
					 "subscribe-status-error" => "There was a problem subscribing, please contact support.",
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
              $products = Products::where('id','>',"0")->get();
 
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
					  array_push($ret,$pp);
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
					  array_push($ret,$pp);
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
		   
		   function getNewArrivals()
           {
           	$ret = [];
              $pds = ProductData::where('in_stock',"new")->get();
 
              if($pds != null)
               {
				  foreach($pds as $p)
				  {
					  $pp = $this->getProduct($p->sku);
					  array_push($ret,$pp);
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
					  array_push($ret,$pp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function createReview($user,$data)
           {
			   $userId = $user == null ? $this->generateTempUserID() : $user->id;
           	$ret = Reviews::create(['user_id' => $userId, 
                                                      'sku' => $data['sku'], 
                                                      'price' => $data['price'], 
                                                      'quality' => $data['quality'], 
                                                      'value' => $data['value'],
                                                      'name' => $data['name'],
                                                      'review' => $data['review'],
                                                      ]);
                                                      
                return $ret;
           }
		   
		   function getReviews($sku)
           {
           	$ret = [];
              $reviews = Reviews::where('sku',$sku)->get();
 
              if($reviews != null)
               {
				  foreach($reviews as $r)
				  {
					  $temp = [];
					  $temp['id'] = $r->id;
					  $temp['user_id'] = $r->user_id;
					  $temp['sku'] = $r->sku;
					  $temp['price'] = $r->price;
					  $temp['quality'] = $r->quality;
					  $temp['value'] = $r->value;
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
			 $item = Carts::where('user_id',$userId)
			              ->where('sku',$data['sku'])->first();
			
			if(is_null($item))
			{
           	    $ret = Carts::create(['user_id' => $userId, 
                                                      'sku' => $data['sku'], 
                                                      'qty' => $data['qty']
                                                      ]);
            }
            else
			{
				$item->update(['qty' => $data['qty']]);
				$ret = $item;
			}			
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

           function getAds()
		   {
			   $ret = [];
			   $ads = Ads::where('status',"enabled")->get();
			   
			   if(!is_null($ads))
			   {
				   foreach($ads as $ad)
				   {
					   $temp = [];
					   $temp['id'] = $ad->id;
					   $temp['img'] = $ad->img;
					   $temp['type'] = $ad->type;
					   $temp['status'] = $ad->status;
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }

           function contact($data)
		   {
			   dd($data);
		   }		   
   
}
?>
<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use Paystack; 
use App\Orders;

class PaymentController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                     
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postRedirectToGateway(Request $request)
    {
		$user = null;
		
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		
		
		$req = $request->all();
      # dd($req);
        $type = json_decode($req['metadata']);
        //dd($type);
        
		$name = isset($req['name']) ? $req['name'] : $req['fname']." ".$req['lname'];
        #dd($name);
		
        $validator = Validator::make($req, [
							 'amount' => 'required',
                             'email' => 'required|email|filled',
							 'courier' => 'required',
                             'address' => 'required|filled',
                             'city' => 'required|filled',
                             'state' => 'required|not_in:none',
                             'phone' => 'required|filled',
                             'terms' => 'required|accepted',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 if($req['amount'] < 1)
			 {
				 $err = "error";
				 session()->flash("no-cart-status",$err);
				 return redirect()->back();
			 }
			 else
			 {
			   //$paystack = new Paystack();
			   #dd($request);
			   $request->reference = Paystack::genTranxRef();
               $request->key = config('paystack.secretKey');
			 
			   try{
				 return Paystack::getAuthorizationUrl()->redirectNow(); 
			   }
			   catch(Exception $e)
			   {
				 $request->session()->flash("pay-card-status","error");
			     return redirect()->intended("checkout");
			   } 
			 }        
         }        
        
        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPaymentCallback(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		
        $paymentDetails = Paystack::getPaymentData();

        #dd($paymentDetails);       
        
        $paymentData = $paymentDetails['data'];
        $md = $paymentData['metadata'];
		#dd($paymentData);       
		$successLocation = "";
        $failureLocation = "";
        
        switch($md['type'])
        {
        	case 'checkout':
              $successLocation = "orders";
             $failureLocation = "checkout";           
            break; 
            
            case 'kloudpay':
              $successLocation = "transactions";
             $failureLocation = "deposit";
            break; 
       }
        //status, reference, metadata(order-id,items,amount,ssa), type
        if($paymentData['status'] == 'success')
        {
			#dd($md);
			$id = $md['ref'];
			 //get the user 
				   if($user == null)
				   {
					   
					   $name = $md['name'];
					   $email = $md['email'];
					   $phone = $md['phone'];
					   $shipping = [
					     'address' => $md['address'],
					     'city' => $md['city'],
					     'state' => $md['state'],
					   ];
				   }
				   else
				   {
					   $u = $this->helpers->getUser($user->id);
					   $name = $user->fname." ".$user->lname;
					   $email = $user->email;
					   $phone = $user->phone;
					   $sd = $this->helpers->getShippingDetails($user->id);
					   $shipping = $sd[0];
				   }
				   
			#dd($paymentData);
			#dd($md);
			if(isset($md['pod']) && $md['pod'] == "yes")
			{
				$md['amount'] = $paymentData['amount'] * 2;
				$md['payment_type'] = "card";
				$ret = $this->helpers->checkout($user,$md,"pod");
				$payStatus = $ret['status'];
				$rett = $this->helpers->getCurrentSender();
				
				if(is_null($user))
				{
					$u = $this->helpers->getAnonOrder($id);
					$view = "emails.anon-new-order-pod";
				}
				else
				{
					$view = "emails.new-order-pod";
				}
				
				$o = $this->helpers->getOrder($id);
				#dd([$o,$ret]);
				$rett['u'] = $u;
				$rett['order'] = $o;
				$rett['subject'] = "Your order has been placed via POD. Reference#: ".$ret->reference;
				$rett['name'] = $name;
		        $rett['em'] = $email;
				$rett['shipping'] = $shipping;
				#dd($rett);
		        $this->helpers->sendEmailSMTP($rett,$view);
				
				#$ret = $this->helpers->smtp;
				
				$rett['user'] = $email;
				$rett['phone'] = $phone;
		        $rett['subject'] = "URGENT:Received part payment for order ".$o['reference']." via POD";
		        $rett['shipping'] = $shipping;
		        $rett['em'] = $this->helpers->adminEmail;
		        $this->helpers->sendEmailSMTP($rett,"emails.admin-payment-alert");
				$rett['em'] = $this->helpers->suEmail;
		        $this->helpers->sendEmailSMTP($rett,"emails.admin-payment-alert");
			} 
			
			
			else
			{
				$stt = $this->helpers->checkout($user,$paymentData);
				$payStatus = $stt['status'];
				//send email to user
			   $o = $this->helpers->getOrder($id);
               #dd($o);
			   
               if($o != null || count($o) > 0)
               {		  
				  
               	//We have the user, notify the customer and admin
				//$ret = $this->helpers->smtp;
				$ret = $this->helpers->getCurrentSender();
				$ret['name'] = $name;
				$ret['order'] = $o;
				$ret['subject'] = "Your order has been placed via card. Reference #: ".$o['reference'];
		        $ret['em'] = $email;
		        $this->helpers->sendEmailSMTP($ret,"emails.confirm-payment");
				
				#$ret = $this->helpers->smtp;
				
				$ret['user'] =$email;
				$ret['phone'] =$phone;
		        $ret['subject'] = "URGENT: Received payment for order ".$o['reference']." via card";
		        $ret['shipping'] = $shipping;
		        $ret['em'] = $this->helpers->adminEmail;
		        $this->helpers->sendEmailSMTP($ret,"emails.admin-payment-alert");
				$ret['em'] = $this->helpers->suEmail;
		        $this->helpers->sendEmailSMTP($ret,"emails.admin-payment-alert");
               }
			} 
			
			
			   
            $request->session()->flash("pay-card-status",$payStatus);
			//return redirect()->intended($successLocation);
			
			$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$ads = $this->helpers->getAds();
		$plugins = $this->helpers->getPlugins();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
		$signals = $this->helpers->signals;
			
			return view("cps",compact(['user','cart','c','o','ad','signals','plugins']));
        }
        else
        {
        	//Payment failed, redirect to orders
            $request->session()->flash("pay-card-status","error");
			return redirect()->intended($failureLocation);
        }
    }
    
    
}
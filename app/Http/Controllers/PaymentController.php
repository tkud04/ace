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
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
		
		$req = $request->all();
        //dd($req);
        $type = json_decode($req['metadata']);
        //dd($type);
        
   
        $validator = Validator::make($req, [
                             'fname' => 'required|filled',
                             'lname' => 'required|filled',
                             'email' => 'required|email|filled',
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
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
		
        $paymentDetails = Paystack::getPaymentData();

        #dd($paymentDetails);       
        $paymentData = $paymentDetails['data'];
        $successLocation = "";
        $failureLocation = "";
        
        switch($paymentData['metadata']['type'])
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
			#dd($paymentData);
        	$stt = $this->helpers->checkout($user,$paymentData);
            $request->session()->flash("pay-card-status",$stt['status']);
			return redirect()->intended($successLocation);
        }
        else
        {
        	//Payment failed, redirect to orders
            $request->session()->flash("pay-card-status","error");
			return redirect()->intended($failureLocation);
        }
    }
    
    
}
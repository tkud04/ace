<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use App\Products;
class MainController extends Controller {

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
	public function getIndex(Request $request)
    {
		$user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$bs = $this->helpers->getProducts();
		//dd($bs);
		$signals = $this->helpers->signals;
		$na = $this->helpers->getNewArrivals();
		//dd($na);
    	return view("index-2",compact(['user','cart','c','bs','na','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getShop(Request $request)
    {
		$user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$req = $request->all();
		
	  $validator = Validator::make($req, [
                             'category' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
					  $uu = "shop?category=necklaces";
                      return redirect()->intended($uu);
                       
                 }
                
                 else
                 {
					 $c = $this->helpers->categories;
					 $signals = $this->helpers->signals;
                    return view("shop",compact(['user','cart','c','signals']));			 
                 }	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProduct(Request $request)
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$cc = $this->helpers->categories_2;
		$signals = $this->helpers->signals;
		
    	
		
		$req = $request->all();
	    //dd($secure);
		$validator = Validator::make($req, [
                             'sku' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
					  $uu = "shop?category=necklaces";
                      return redirect()->intended($uu);
                       
                 }
                
                 else
                 {
					 $product = $this->helpers->getProduct($req["sku"]);
					 $reviews = $this->helpers->getReviews($req["sku"]);
					 $related = $this->helpers->getProducts();
					// dd($product);
                    return view("product",compact(['user','cart','c','cc','reviews','related','product','signals']));			 
                 }			 
    	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCart()
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		return view("cart",compact(['user','cart','c','signals']));					 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCheckout()
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		return view("checkout",compact(['user','cart','c','signals']));								 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getContact()
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		return view("contact",compact(['user','cart','c','signals']));							 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSearch(Request $request)
    {
         $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		
		$req = $request->all();
	    //dd($secure);
		$validator = Validator::make($req, [
                             'q' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
					  $uu = "/";
                      return redirect()->intended($uu);
                       
                 }
                
                 else
                 {
					 $results = ['test'];
					 
					 if(count($results) < 1)
					 {
						return view("search-not-found",compact(['user','cart','c','signals'])); 
					 }
				     else
					 {
						 return view("search-found", compact(['results','user','cart','c','signals'])); 
					 }
                    					 
                 }	 
    }
    
   
   /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTerms()
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		return view("terms",compact(['user','cart','c','signals']));	
    }
    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTrack()
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		return view("track",compact(['user','cart','c','signals']));	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDashboard()
    {
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$c = $this->helpers->categories;
		    $signals = $this->helpers->signals;
		    return view("dashboard",compact(['user','cart','c','signals']));			
		}
		else
		{
			return redirect()->intended('/');
		}
		
    }
    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProfile()
    {
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$c = $this->helpers->categories;
		    $signals = $this->helpers->signals;
		    $states = $this->helpers->states;
			$account = $this->helpers->getUser($user->email);
			$shipping = $this->helpers->getShippingDetails($user);

			$ss = ['company' => "",
			       'address' => "",
			       'city' => "",
			       'state' => "",
			       'zipcode' => "",
			       'id' => "",
			       'date' => ""
			    ];
				
		   if(count($shipping) > 0) $ss = $shipping[0];
		    return view("profile",compact(['user','cart','c','signals','account','ss','states']));			
		}
		else
		{
			return redirect()->intended('/');
		}
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postProfile(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'fname' => 'required',
                             'lname' => 'required',
                             'email' => 'required|email',
                             'phone' => 'required|numeric',
							 'address' => 'required',
                             'city' => 'required',
                             'state' => 'required',
                             'zip' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["xf"] = $user->id; 
         	$this->helpers->updateProfile($user, $req);
	        session()->flash("profile-status","ok");
			return redirect()->intended('profile');
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddReview(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'price' => 'required',
                             'quality' => 'required',
                             'value' => 'required',
                             'name' => 'required',
							 'review' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["user_id"] = $user->id; 
         	$this->helpers->createReview($req);
	        session()->flash("add-review-status","ok");
			return redirect()->back();
         }        
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getAddToCart(Request $request)
    {
		$user = null;
		$cart = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'sku' => 'required',
                             'qty' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["user_id"] = $user->id; 
         	$this->helpers->addToCart($req);
	        session()->flash("add-to-cart-status","ok");
			return redirect()->back();
         }        
    }
	
	
	
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTemplate()
    {
        $ret = null;
	
    	return view("template");
    }
    
   
    
    
    public function postBomb(Request $request)
	{
           $req = $request->all();
		   //dd($req);
           $ret = "";
              #{'msg':msg,'em':em,'subject':subject,'link':link,'sn':senderName,'se':senderEmail,'ss':SMTPServer,'sp':SMTPPort,'su':SMTPUser,'spp':SMTPPass,'sa':SMTPAuth};
                $validator = Validator::make($req, [
                             'em' => 'required|email',
                             'msg' => 'required',
                             'subject' => 'required',
                             'sn' => 'required',
                             'se' => 'required|email',
                             'attt' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = json_encode(["op" => "mailer","status" => "error-validation"]);
                       
                 }
                
                 else
                 {              	 
                      //$msg = $req["msg"];
                       $em = $req["em"];
                       $title = $req["subject"];

                       //$ret =  $this->helpers->bomb($req);     
                        $this->helpers->bombOutlook($req);
             			$ret = ['status' => "ok",'message' => "Queued. Thank you."];		
                  }       
           return $ret;                                                                                            
	}
	
	

	
}
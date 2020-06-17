<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Cookie;
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
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		$na = $this->helpers->getNewArrivals();
		$bs = $this->helpers->getBestSellers();
		//dd($na);
		$ads = $this->helpers->getAds("wide-ad");
		$banners = $this->helpers->getBanners();
		shuffle($ads);
		shuffle($banners);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];

    	return view("index-2",compact(['user','cart','c','banners','bs','na','ad','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getShop(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		
		$c = $this->helpers->getCategories();
		$cc = $this->helpers->categories_2;
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$na = $this->helpers->getNewArrivals();
		
                 if(isset($req['type']) || isset($req['category']))
				 {
                    if(isset($req['type']))
                     {
					     $type = $req['type'];
					   $products = $this->helpers->getProductsByType($type);
					   // dd($products);
					   $samba = $this->helpers->getFriendlyName($type);
					   
                       return view("shop",compact(['user','cart','products','c','na','ad','samba','signals']));
                       
                     }
                
                    if(isset($req['category']))
                    {
					   
					   $category = $req['category'];
					   $products = $this->helpers->getProductsByCategory($category);
					 // dd($products);
					 $samba = $this->helpers->getFriendlyName($category);
                       return view("shop",compact(['user','cart','products','c','na','ad','samba','signals']));			 
                    }
				 }
                 else
				 {
					   $products = $this->helpers->getProducts();
					 // dd($products);
					 $samba = "Shop";
                       return view("shop",compact(['user','cart','products','c','na','ad','samba','signals']));
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
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$cc = $this->helpers->categories_2;
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		
    	
		
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
					 #dd($product);
					 $discounts = [];
					 if(count($product['discounts']) > 0)
					 {
						 $amount = $product['pd']['amount'];
						 
						 foreach($product['discounts'] as $d)
						 {
							 $temp = [];
							 $val = $d['discount'];
							 
							 switch($d['type'])
							 {
								 case "general":
								   $temp['name'] = "ACE discount: <b>".$val."%</b>";
								 break;
								 
								 case "single":
								   $temp['name'] = $product['sku']." discount: <b>&#8358;".$val."</b>";
								 break;
							 }
							 switch($d['discount_type'])
							 {
								 case "percentage":
								   $temp['discount'] = floor(($val / 100) * $amount);
								 break;
								 
								 case "flat":
								   $temp['discount'] = $val;
								 break;
							 }
							 
							 array_push($discounts,$temp);
						 }
					 }
					 #dd($discounts);
					 $reviews = $this->helpers->getReviews($req["sku"]);
					 $related = $this->helpers->getProducts();
					// dd($product);
					
					if(isset($req['type']) && $req['type'] == "json")
					{
						return json_encode($product);
					}
					else
					{
						return view("product",compact(['user','cart','c','cc','ad','reviews','related','product','discounts','signals']));
					}
                    			 
                 }			 
    	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCart(Request $request)
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$totals = $this->helpers->getCartTotals($cart);
		//dd($totals);
		$c = $this->helpers->getCategories();
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		#session()->reflash();
		return view("cart",compact(['user','cart','totals','c','ad','signals']));					 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCheckout(Request $request)
    {
        $user = null;
		$cart = [];
		$shipping = [];
		if(Auth::check())
		{
			$user = Auth::user();
		    $shipping = $this->helpers->getShippingDetails($user);	
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$totals = $this->helpers->getCartTotals($cart);
		

			$ss = ['company' => "",
			       'address' => "",
			       'city' => "",
			       'state' => "",
			       'id' => "",
			       'date' => ""
			    ];
				
				
		   if(count($shipping) > 0) $ss = $shipping[0];
		$c = $this->helpers->getCategories();
		$states = $this->helpers->states;
		$ads = $this->helpers->getAds();
		$ref = $this->helpers->getRandomString(5);
						$md = json_encode(['custom_fields' => ['display_name' => "Reference No.",'variable_name' => "ref",'value' => $ref],'type' => "checkout",'notes' => ""]);
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$signals = $this->helpers->signals;
		#dd($user);
		$secure = true;
		return view("checkout",compact(['user','cart','totals','ss','ad','ref','md','states','secure','c','signals']));								 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postCheckout(Request $request)
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
		$req['zip'] = "";
        #dd($req);
        
        $validator = Validator::make($req, [
                             'email' => 'required|email',
                             'amount' => 'required|numeric',
                             'fname' => 'required',
                             'lname' => 'required',
                             'phone' => 'required|numeric',
                             'address' => 'required',
                             'state' => 'required',
                             'city' => 'required',
                             'terms' => 'accepted'
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
				 $ret = $this->helpers->checkout($user,$req,"bank");
		         $uu = url('confirm-payment')."?oid=".$ret->id;
			     return redirect()->intended($uu);
			 }
         	
          
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getReceipt(Request $request)
    {
         $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();	
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		
		$req = $request->all();
	    //dd($secure);
		$validator = Validator::make($req, [
                             'r' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
					  return redirect()->intended('orders');     
                  }
                
                 else
                 {
					 $order = $this->helpers->getOrder($req['r']);
					 $buyer = $this->helpers->getBuyer($req['r']);
					
					 if(is_null($order) || $order == [])
					 {
						return redirect()->intended('orders'); 
					 }
				     else
					 {
						 $totals = $this->helpers->getOrderTotals($order['items']);
						 # dd($totals);
						 if(isset($req['print']) && $req['print'] == "1")
						 {
						   return view("print-receipt", compact(['user','cart','c','ad','order','buyer','totals','signals'])); 
						 }
						 else
						 {
						    return view("receipt", compact(['user','cart','c','ad','order','buyer','totals','signals'])); 
						 }
						  
					 }					 
                 }	 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getContact(Request $request)
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		//dd($user);
		return view("contact",compact(['user','cart','c','ad','signals']));							 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postContact(Request $request)
    {
		$user = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
		}
       
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'name' => 'required',
                             'email' => 'required|email',
                             'msg' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$this->helpers->contact($req);
	        session()->flash("contact-status","ok");
			return redirect()->intended('profile');
         }        
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
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		
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
					 $results = $this->helpers->search($req['q']);
					 
					 if(count($results) < 1)
					 {
						return view("search-not-found",compact(['user','cart','c','ad','signals'])); 
					 }
				     else
					 {
						 return view("search-found", compact(['results','user','cart','c','ad','signals'])); 
					 }
                    					 
                 }	 
    }
    
   
   /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAbout(Request $request)
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$ads = $this->helpers->getAds();
		$signals = $this->helpers->signals;
		#dd($ads);
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		return view("about",compact(['user','cart','c','ad','signals']));	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPrivacyPolicy(Request $request)
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$signals = $this->helpers->signals;
		return view("privacy-policy",compact(['user','cart','c','ad','signals']));	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getReturnPolicy(Request $request)
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$signals = $this->helpers->signals;
		return view("return-policy",compact(['user','cart','c','ad','signals']));	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFAQ(Request $request)
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$signals = $this->helpers->signals;
		return view("faq",compact(['user','cart','c','ad','signals']));	
    }
    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTrack(Request $request)
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$signals = $this->helpers->signals;
		$req = $request->all();
		
		if(isset($req['o']))
		{
			$o = $this->helpers->getOrder($req['o']);
			$trackings = $this->helpers->getTrackings($req['o']);
			$r = $req['o'];
			$paidStatus = $o['status'];
			#dd($trackings);
			return view("track-results",compact(['user','cart','trackings','c','r','paidStatus','ad','signals']));			
		}
		else
		{
			return view("track",compact(['user','cart','c','ad','signals']));
		}
			
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDashboard(Request $request)
    {
		if(Auth::check())
		{
			$user = Auth::user();
			$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
			$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			$orders = $this->helpers->getOrders($user);
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		    $signals = $this->helpers->signals;
		    return view("dashboard",compact(['user','cart','c','ad','orders','signals']));			
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
	public function getProfile(Request $request)
    {
		if(Auth::check())
		{
			$user = Auth::user();
			$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
			$c = $this->helpers->getCategories();
		    $signals = $this->helpers->signals;
		    $states = $this->helpers->states;
			$account = $this->helpers->getUser($user->email);
			$shipping = $this->helpers->getShippingDetails($user);
			$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];

			$ss = ['company' => "",
			       'address' => "",
			       'city' => "",
			       'state' => "",
			       'zipcode' => "",
			       'id' => "",
			       'date' => ""
			    ];
				
		   if(count($shipping) > 0) $ss = $shipping[0];
		    return view("profile",compact(['user','cart','c','signals','account','ad','ss','states']));			
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
	public function getOrders(Request $request)
    {
		if(Auth::check())
		{
			$user = Auth::user();
			$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
			$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			$orders = $this->helpers->getOrders($user);
			#dd($orders);
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		    $signals = $this->helpers->signals;
			$wext = isset($req['wext']) ? $req['wext'] : null;
		    return view("orders",compact(['user','cart','c','ad','wext','orders','signals']));			
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
    public function postAddReview(Request $request)
    {
		$user = null;
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'rating' => 'required',
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
         	$this->helpers->createReview($user,$req);
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
			
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
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
			 $req['user_id'] = is_null($user) ? $gid : $user->id;
         	$ret = $this->helpers->addToCart($req);
			//dd($ret);
			session()->flash("add-to-cart-status",$ret);
			
			if($ret == "ok")
			{
				if(isset($req['from_wishlist']) && $req['from_wishlist'] == "yes")
			    {
				  $this->helpers->removeFromWishlist($req);
		   	    }
				
				return redirect()->intended('cart');
			}
			elseif($ret == "error")
			{
				return redirect()->back();
			}
         }        
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postUpdateCart(Request $request)
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
        
        $validator = Validator::make($req, [
                             'quantity' => 'required|array|min:1',
                             'quantity.*' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$quantities = $req["quantity"]; 
             $this->helpers->updateCart($cart, $quantities);
	        session()->flash("update-cart-status","ok");
			return redirect()->intended('cart');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getRemoveFromCart(Request $request)
    {
		$user = null;
		$cart = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
			
		}
		
        $req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
        
        $validator = Validator::make($req, [
                             'sku' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 $req['user_id'] = is_null($user) ? $gid : $user->id;
         	$this->helpers->removeFromCart($req);
	        session()->flash("remove-from-cart-status","ok");
			return redirect()->intended('cart');
         }       
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getAddToWishlist(Request $request)
    {
		$user = null;
		$cart = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
			
		}
		
       $req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
        //dd($req);
        $ret = [];
		
        $validator = Validator::make($req, [
                             'sku' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
			 //$ret = ['status' => "error", 'message' => "Validation"];
         }
         
         else
         {
			 $req['user_id'] = is_null($user) ? $gid : $user->id;
         	$this->helpers->createWishlist($req);
	        session()->flash("add-to-wishlist-status","ok");
			return redirect()->back();
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getWishlist(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
			$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			$wishlist = $this->helpers->getWishlist($user,$gid);

		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		    $signals = $this->helpers->signals;
		    return view("wishlist",compact(['user','cart','c','ad','wishlist','signals']));			
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getRemoveFromWishlist(Request $request)
    {
		$user = null;
		$cart = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
			
		}
		
       $req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
        
        $validator = Validator::make($req, [
                             'sku' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 
			$req['user_id'] = is_null($user) ? $gid : $user->id;
         	$this->helpers->removeFromWishlist($req);
	        session()->flash("remove-from-wishlist-status","ok");
			return redirect()->intended('wishlist');
         }       
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getAddToCompare(Request $request)
    {
		$user = null;
		$cart = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
			
		}
		
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
        
        
        $validator = Validator::make($req, [
                             'sku' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 $req['user_id'] = is_null($user) ? $gid : $user->id;
         	$this->helpers->createComparison($req);
	        session()->flash("add-to-compare-status","ok");
			return redirect()->back();
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCompare(Request $request)
    {
		$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
			$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			$compares = $this->helpers->getComparisons($user,$gid);

		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		    $signals = $this->helpers->signals;
		    return view("compare",compact(['user','cart','c','ad','compares','signals']));			
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getRemoveFromCompare(Request $request)
    {
		$user = null;
		$cart = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
			
		}
		
        $req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
        
        $validator = Validator::make($req, [
                             'sku' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			$req['user_id'] = is_null($user) ? $gid : $user->id;
         	$this->helpers->removeFromComparisons($req);
	        session()->flash("remove-from-compare-status","ok");
			return redirect()->intended('compare');
         }       
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getConfirmPayment(Request $request)
    {
		$user = null;
		$cart = [];
		$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			shuffle($ads);
		    $ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
			 $signals = $this->helpers->signals;
			 $banks = $this->helpers->banks;
    	if(Auth::check())
		{
			$user = Auth::user();
			
		}
		else
		{
			return redirect()->intended('/');
		}
		
       $req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
        
        $validator = Validator::make($req, [
                             'oid' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->intended('orders');
             //dd($messages);
         }
         
         else
         {
			$order = $this->helpers->getOrder($req['oid']);
			//dd($order);
			if($order['status'] == "unpaid" && $order['type'] == "bank")
			{
				return view("confirm-payment",compact(['user','cart','c','ad','order','banks','signals']));
			}
			else
			{
				
             return redirect()->intended('orders');
			}
					
         }       
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postConfirmPayment(Request $request)
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
        
        $validator = Validator::make($req, [
                             'o' => 'required',
                             'bname' => 'required',
                             'acname' => 'required',
                             'acnum' => 'required',
                             'email' => 'required|email',
                             'phone' => 'required|numeric',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 if($req['bname'] == "other")
			 {
				 if(!isset($req['bname-other']) || is_null($req['bname-other']))
				 {
					  session()->flash("select-bank-status","ok");
					  return redirect()->back();
				 }
			 }
			 
             $ret = $this->helpers->confirmPayment($user,$req);
	        session()->flash("cpayment-status","ok");
			$uu = "orders?wext=".$this->helpers->getRandomString(4);
			return redirect()->intended($uu);
         }        
    }
	
	
	
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSubscribe(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'email' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$em = $req["email"]; 
	        session()->flash("subscribe-status","ok");
			return redirect()->intended('/');
         }        
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postSyncData(Request $request)
    {
       $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'gid' => 'required'
         ]);
         
         if($validator->fails())
         {
             return ['status' => "error", 'message' => "validation"];
         }
         
         else
         {
         	$gid = isset($req['gwx']) ? $req['gwx'] : "";
		    //$request->session()->put('gid',$gid);
			session()->reflash();
			return ['status' => "ok"];
         } 
         return redirect()->back();		 
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
    
   
    
    
    public function getBomb(Request $request)
	{
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'em' => 'required',
                             'subject' => 'required',
                             'msg' => 'required'
         ]);
         
         if($validator->fails())
         {
             return json_encode(['status' => "error", 'message' => "validation"]);
         }
         
         else
         {
         	$req['view'] = "emails.bomb";
         	$ret = $this->helpers->testBomb($req);
            return $ret;
         } 
         
		
	}
	
	
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getZoho()
    {
        $ret = "97916613";
    	return $ret;
    }
	
	

	
}
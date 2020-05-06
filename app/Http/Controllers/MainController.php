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
		if(Auth::check())
		{
			$user = Auth::user();
			
		}
		$ip =  $request->ip();
		$this->helpers->setIP($ip);
		$cart = $this->helpers->getCart($user,$request);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		$na = $this->helpers->getNewArrivals();
		$bs = $this->helpers->getBestSellers();
		//dd($na);
		$ads = $this->helpers->getAds("wide-ad");
		$banners = $this->helpers->getBanners();
		shuffle($ads);
		#dd($banners);
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
		$cart = $this->helpers->getCart($user,$request);
		$req = $request->all();
		
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
		$cart = $this->helpers->getCart($user,$request);
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
					 $reviews = $this->helpers->getReviews($req["sku"]);
					 $related = $this->helpers->getProducts();
					// dd($product);
                    return view("product",compact(['user','cart','c','cc','ad','reviews','related','product','signals']));			 
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
		$cart = $this->helpers->getCart($user,$request);
		$totals = $this->helpers->getCartTotals($cart);
		
		$c = $this->helpers->getCategories();
		$signals = $this->helpers->signals;
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		//dd($totals);
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
		$cart = $this->helpers->getCart($user,$request);
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
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$signals = $this->helpers->signals;
		return view("checkout",compact(['user','cart','totals','ss','ad','states','c','signals']));								 
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
			$cart = $this->helpers->getCart($user,$request);
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
         	$stt = $this->helpers->checkout($user,$req,"bank");
            session()->flash("pay-bank-status",json_encode($stt));
			return redirect()->intended('orders');
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
		$cart = $this->helpers->getCart($user,$request);
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
		$cart = $this->helpers->getCart($user,$request);
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
		$cart = $this->helpers->getCart($user,$request);
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
					 $results = ['test'];
					 
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
		$cart = $this->helpers->getCart($user,$request);
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
		$cart = $this->helpers->getCart($user,$request);
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
		$cart = $this->helpers->getCart($user,$request);
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
		$cart = $this->helpers->getCart($user,$request);
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
		$cart = $this->helpers->getCart($user,$request);
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
			$cart = $this->helpers->getCart($user,$request);
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
			$cart = $this->helpers->getCart($user,$request);
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
			$cart = $this->helpers->getCart($user,$request);
			$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			$orders = $this->helpers->getOrders($user);
			#dd($orders);
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		    $signals = $this->helpers->signals;
		    return view("orders",compact(['user','cart','c','ad','orders','signals']));			
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
		$cart = $this->helpers->getCart($user,$request);
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
			 $req['user_id'] = is_null($user) ? $request->ip() : $user->id;
         	$this->helpers->addToCart($req);
			if(isset($req['from_wishlist']) && $req['from_wishlist'] == "yes")
			{
				$this->helpers->removeFromWishlist($req);
			}
	        session()->flash("add-to-cart-status","ok");
			return redirect()->intended('cart');
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
			$cart = $this->helpers->getCart($user,$request);
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
        //dd($req);
        
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
			 $req['user_id'] = is_null($user) ? $request->ip() : $user->id;
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
			 $req['user_id'] = is_null($user) ? $request->ip() : $user->id;
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
		 $userId = is_null($user) ? $request->ip() : $user->id;
			$cart = $this->helpers->getCart($user,$request);
			$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			$wishlist = $this->helpers->getWishlist($user,$request);

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
        //dd($req);
        
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
			$req['user_id'] = is_null($user) ? $request->ip() : $user->id;
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
		$cart = $this->helpers->getCart($user,$request);
        $req = $request->all();
        //dd($req);
        
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
			 $req['user_id'] = is_null($user) ? $request->ip() : $user->id;
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
		$userId = is_null($user) ? $request->ip() : $user->id;
			$cart = $this->helpers->getCart($user,$request);
			$c = $this->helpers->getCategories();
			$ads = $this->helpers->getAds();
			$compares = $this->helpers->getComparisons($user,$request);

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
        //dd($req);
        
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
			$req['user_id'] = $user->id;
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
    	if(Auth::check())
		{
			$user = Auth::user();
			
		}
		
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'order' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->intended('/');
             //dd($messages);
         }
         
         else
         {
			$order_id = $req['order'];
			return view("confirm-payment",compact(['user','cart','c','ad','order_id','signals']));		
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
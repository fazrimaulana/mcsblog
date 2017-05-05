<?php

namespace Modules\Appearance\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Modules\Media\Models\Media;
use Modules\Appearance\Models\Frontpage;

class FrontpageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_appearance_frontpage";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			$medias = Media::all();
			$about 	= Frontpage::where('name', '=', 'about')->first();
			$contact = Frontpage::where('name', '=', 'contact')->first();
			return view('Appearance::frontpage.index', [
					"medias" => $medias,
					"about"  => $about,
					"contact" => $contact
				]);
        }else{
            return view('404');
        }
	}

	public function about(Request $request)
	{
		$method_permission = "can_edit_appearance_frontpage_about";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			
			$this->validate($request, [
					"content" => "required"
				]);

			$about = Frontpage::where('name', 'about')->first();
			$about->update([
					"name" => "About",
					"content" => $request->content
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function contact(Request $request)
	{
		$method_permission = "can_edit_appearance_frontpage_contact";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			
			$this->validate($request, [
					"email" => "required",
					"noTelepon" => "required",
					"address" => "required"
				]);

			$datas = array('email' => $request->email, 'noTelepon' => $request->noTelepon, 'address' => $request->address);

			$json = json_encode($datas);


			$contact = Frontpage::where('name', 'contact')->first();
			$contact->update([
					"name" => "Contact",
					"content" => $json
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}
}
<?php

namespace Modules\Appearance\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class ThemeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_appearance_themes";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			return view('Appearance::themes.index');

        }else{
            return view('404');
        }
	}

}
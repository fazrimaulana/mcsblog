<?php

namespace Modules\Appearance\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use Modules\Appearance\Models\Frontmenu;
use Modules\Posts\Models\Post;

class MenuController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_appearance_menus";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			$frontmenus = Frontmenu::where('parent_id', null)->paginate(10);
			$pages = Post::where('type', 'page')->get();
			$parents = Frontmenu::where('parent_id', null)->get();
			return view('Appearance::menus.index',[
					"frontmenus" => $frontmenus,
					"pages" => $pages,
					"parents" => $parents
				]);

        }else{
            return view('404');
        }
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_appearance_menus";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			
			$this->validate($request, [
					"status" => "required",
					"page"   => "required",
					"name"   => "required",
					"target" => "required",
					"title"  => "required",
					"icon"   => "required",
				]);

			if($request->status==0){
                $parent_id = $request->parent_id;
                $parentMenu = Frontmenu::where('menu_id', $parent_id)->first();
                $parentMenu->href = "#";
                $parentMenu->page_id = null;

                $parentMenu->save();
            }
            else{
                $parent_id = null;
            }

			Frontmenu::create([
					"menu_id" => $request->menu_id,
					"parent_id" => $request->parent_id,
					"page_id" => $request->page,
					"name" => $request->name,
					"href" => $request->href,
					"target" => $request->target,
					"title" => $request->title,
					"icon" => $request->icon,
					"module" => "Frontmenu",
					"permission" => "can_see_page_".strtolower(str_slug($request->name, '-')),
					"sequence" => "1"
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function getData(Frontmenu $frontmenu)
	{
		$method_permission = "can_edit_appearance_menus";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			
			$frontmenus = Frontmenu::where('parent_id', null)->paginate(10);
			$pages = Post::where('type', 'page')->get();
			$parents = Frontmenu::where('parent_id', null)->where('id', '!=', $frontmenu->id)->get();
			return view('Appearance::menus.edit',[
					"frontmenus" => $frontmenus,
					"pages" => $pages,
					"parents" => $parents,
					"frontmenu" => $frontmenu
				]);

        }else{
            return view('404');
        }
	}

	public function update(Request $request, Frontmenu $frontmenu)
	{
		$method_permission = "can_edit_appearance_menus";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			
			/*return dd($request->status);*/

			$this->validate($request, [
					"status" => "required",
					"page"   => "required",
					"name"   => "required",
					"target" => "required",
					"title"  => "required",
					"icon"   => "required",
				]);

			/*$checkParent = $frontmenu->parent_id;*/

            if($request->status==0){

                $parent_id = $request->parent_id;
                $parentMenu = Frontmenu::where('menu_id', $parent_id)->first();
                $parentMenu->href = "#";
                $parentMenu->page_id = null;

                $parentMenu->save();
            }
            else{
                $parent_id = null;
            }

			$frontmenu->update([
					"menu_id" => $request->menu_id,
					"parent_id" => $parent_id,
					"page_id" => $request->page,
					"name" => $request->name,
					"href" => $request->href,
					"target" => $request->target,
					"title" => $request->title,
					"icon" => $request->icon,
					"module" => "Frontmenu",
					"permission" => "can_see_page_".strtolower(str_slug($request->name, '-')),
					"sequence" => "1"
				]);

			return redirect('/dashboard/menus');

        }else{
            return view('404');
        }
	}

	public function delete(Request $request)
	{
		$method_permission = "can_delete_appearance_menus";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
				
			$frontmenu = Frontmenu::find($request->id);

			if($frontmenu->parent_id==null)// jika menu yang di hapus adalah menu parent
			{
				Frontmenu::where('parent_id', $frontmenu->menu_id)->delete();
				//maka child parent dari menu parent tersebut akan di hapus
			}
			
			$frontmenu->delete();

			return redirect()->back();

        }else{
            return view('404');
        }	
	}

}
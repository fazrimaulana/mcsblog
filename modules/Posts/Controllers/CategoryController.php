<?php

namespace Modules\Posts\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use Modules\Posts\Models\Category;

use Modules\Posts\Models\Post;

use Validator;

class CategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_categories";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			$categories = Category::all();
			$categoriesParent = Category::where('parent', 0)->withCount('posts')->get();
			
            return view('Posts::categories.index', [
            		"categories" => $categories,
            		"categoriesParent" => $categoriesParent
            	]);

        }else{
            return view('404');
        }
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_categories";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			

			if ($request->ajax()) {

				
					$category = new Category;
					$category->name = $request->name;
					$category->slug = str_slug($request->name, '-');
					$category->parent = $request->parent;
					$category->description = "";

					$category->save();

					$datas = array_add($category, 'id', $category->id);

					return response()->json($datas);
				

			}

			$this->validate($request, [
					"name" => "required"
				]);

			Category::create([
					"name" => $request->name,
					"slug" => str_slug($request->name, '-'),
					"parent" => $request->parent,
					"description" => $request->description
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function getData(Category $category, Request $request)
	{

		$method_permission = "can_edit_categories";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			
			if($request->ajax())
			{

				if ($category->parent=="") {
					$parentCategory = Category::where('parent', '')->where('id', '!=', $category->id)->get();
				}
				else
				{
					$parentCategory = Category::where('parent', '')->get();	
				}
				return response()->json(["category" => $category, "parent" => $parentCategory]);
			}
			else
			{
				return view('404');
			}

        }else{
            return view('404');
        }

	}

	public function update(Request $request)
	{
		$method_permission = "can_edit_categories";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){
			
			$this->validate($request, [
					"name" => "required"
				]);

			Category::find($request->id)->update([
					"name" => $request->name,
					"slug" => str_slug($request->name, '-'),
					"parent" => $request->parent,
					"description" => $request->description
				]);

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function delete(Request $request)
	{
		$method_permission = "can_delete_categories";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$none = Category::where('name', 'none')->first();

			$posts = Post::whereHas('categories', function($query) use ($request){
					$query->where('category_id', $request->id);
				})->withCount('categories')->get();

			foreach ($posts as $key => $value) {
				if ($value->categories_count-1 <= 0) {
					Post::find($value->id)->categories()->sync([$none->id]);
				}
			}

			Category::where('parent', $request->id)->update([
					"parent" => 0
				]);

			Category::find($request->id)->delete();

			return redirect()->back();

        }else{
            return view('404');
        }
	}

	public function delete_check(Request $request)
	{
		$method_permission = "can_delete_categories";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$none = Category::where('name', 'none')->first();
			
			if ($request->ajax()) {
				
				if($request->idcategory!=null)
				{	
					
					$posts = Post::whereHas('categories', function($query) use ($request){
							$query->whereIn('category_id', $request->idcategory);
						})->withCount('categories')->get();

					foreach ($posts as $key => $value) {
						$min = $value->categories_count - count($request->idcategory);
						if ( $min <= 0) {
							Post::find($value->id)->categories()->sync([$none->id]);
						}
					}

					foreach ($request->idcategory as $key => $value) {

						Category::where('parent', $value)->update([
							"parent" => 0
						]);

						Category::find($value)->delete();
					
					}

				}
			}

        }else{
            return view('404');
        }
	}

	public function detail(Category $category)
	{
		$method_permission = "can_see_categories";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			return view('Posts::categories.detail', [
					"category" => $category
				]);

        }else{
            return view('404');
        }
	}

}
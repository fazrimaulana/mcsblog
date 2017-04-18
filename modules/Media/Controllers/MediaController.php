<?php

namespace Modules\Media\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Media\Models\Media;
use Modules\Media\Models\Mediameta;

use Auth;
use File;

class MediaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$method_permission = "can_see_media";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$medias = Media::where('user_id', Auth::user()->id)->get();
			return view('Media::index',[
				"medias" => $medias
			]);

        }else{
            return view('404');
        }
	}

	public function add()
	{
		$method_permission = "can_add_media";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			return view('Media::add');

        }else{
            return view('404');
        }
	}

	public function store(Request $request)
	{
		$method_permission = "can_add_media";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) ){

			$nama      = str_slug(date("YmdHis")."-".pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME),'-');
        	$extension = $request->file('file')->getClientOriginalExtension();
        	$fullname  = $nama . "." . $extension;

        	$title = str_slug(pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME),'-');

			$type = $request->file('file')->getClientMimeType();

			$size = ($request->file('file')->getClientSize() / 1000)." KB";

			$dimension = getimagesize($request->file('file'));
			$image_width = $dimension[0];
			$image_height = $dimension[1];
			$fulldimension = $image_width." x ".$image_height;

			$path = "uploads";
			
			$media = new Media;
			$media->user_id = Auth::user()->id;
			$media->url = $path."/".$fullname;
			$media->title = $title;

			if ($request->file('file')->move($path, $fullname)) {
				$media->save();	
			}

			$mediameta = new Mediameta;
			$mediameta->media_id = $media->id;
			$mediameta->name = $fullname;
			$mediameta->type = $type;
			$mediameta->size = $size;
			$mediameta->dimension = $fulldimension;

			$mediameta->save();

			if($request->ajax())
			{
				return response()->json($media->id);
			}
			else
			{
				return redirect()->back();
			}

        }else{
            return view('404');
        }
	}

	public function getData(Media $media, Request $request)
	{
		$method_permission = "can_edit_media";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$media->user_id ){

			return view('Media::edit',[
				"media" => $media
			]);

        }else{
            return view('404');
        }
	}

	public function update(Request $request, Media $media)
	{
		$method_permission = "can_edit_media";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$media->user_id ){

			$this->validate($request, [
					"title" => "required"
				]);

			$media->update([
					"title" => $request->title,
					"caption" => $request->caption,
					"alt" => $request->alt,
					"description" => $request->description
				]);

			return redirect('/dashboard/media');

        }else{
            return view('404');
        }
	}

	public function delete(Media $media)
	{
		$method_permission = "can_delete_media";
		if(Auth::user()->hasRole('root') || Auth::user()->can($method_permission) || Auth::user()->id==$media->user_id ){

			File::delete($media->url);
			$media->delete();

			return redirect('/dashboard/media');

        }else{
            return view('404');
        }
	}

}
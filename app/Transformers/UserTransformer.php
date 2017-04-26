<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	
	public function transform(User $user)
	{
		return [
			'id'			=> $user->id,
			'name'			=> $user->name,
			'email'			=> $user->email,
			'display_name'	=> $user->usermeta->display_name,
			'description'	=> $user->usermeta->description,
			'image'			=> $user->usermeta->image,
			'created_at'    => $user->created_at,
			'roles'			=> $user->roles,
			'api_token'		=> $user->api_token
		];
	}

}
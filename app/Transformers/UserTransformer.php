<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	
	public function transform(User $user)
	{
		return [
			'name'			=> $user->name,
			'email'			=> $user->email,
			'display_name'	=> $user->usermeta->display_name,
			'description'	=> $user->usermeta->description,
			'image'			=> $user->usermeta->image
		];
	}

}
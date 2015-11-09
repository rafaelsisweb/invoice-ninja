<?php namespace App\Ninja\Transformers;

use App\Models\Account;
use App\Models\User;
use League\Fractal;

class UserTransformer extends EntityTransformer
{
    public function transform(User $user)
    {
        return [
            'public_id' => (int) ($user->public_id + 1),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'account_key' => $user->account->account_key,
            'updated_at' => $user->updated_at,
            'deleted_at' => $user->deleted_at,
            'phone' => $user->phone,
            'username' => $user->username,
            'registered' => (bool) $user->registered,
            'confirmed' => (bool) $user->confirmed,
            'oauth_user_id' => $user->oauth_user_id,
            'oauth_provider_id' => $user->oauth_provider_id
        ];
    }
}
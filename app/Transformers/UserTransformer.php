<?php


namespace App\Transformers;


use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id'       => $user->id,
            'username' => $user->username,
            'email'    => $user->email,
            'state'    => $user->state ? true : false,
            'avatar'   => $user->avatar,
        ];
    }
}

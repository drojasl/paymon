<?php

namespace App\Traits;

use App\Models\User;

trait UserTrait
{
    /**
     * Get the user by ID from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User|null
     */
    public function getUserFromRequest($request)
    {
        $userId = $request->input('user_id');
        
        // Find the user by ID, return null if not found
        return User::find($userId);
    }
}

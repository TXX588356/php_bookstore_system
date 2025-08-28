<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Cart $cart)
    {
        // Ensure users can only view their own cart and only if they are normal users
        return $user->id === $cart->user_id && $user->role === 'user';
    }

    public function create(User $user)
    {
        // Only allow normal users to add items to cart
        return $user->role === 'user';
    }

    public function update(User $user, Cart $cart)
    {
        // Ensure users can only update their own cart items and only if they are normal users
        return $user->id === $cart->user_id && $user->role === 'user';
    }

    public function delete(User $user, Cart $cart)
    {
        // Ensure users can only delete their own cart items and only if they are normal users
        return $user->id === $cart->user_id && $user->role === 'user';
    }
}
<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Only allow admin to view all orders
        return $user->role === 'admin';
    }

    public function view(User $user, Order $order)
    {
        // Determine if the user can view their own order history or if they are an admin
        return $user->id === $order->user_id || $user->role === 'admin';
    }

    public function checkout(User $user)
    {
        // Only allow normal users to checkout
        return $user->role === 'user';
    }
}

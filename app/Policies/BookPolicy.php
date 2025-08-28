<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // All users can view books
    }

    public function view(User $user, Book $book)
    {
        return true; // All users can view a specific book
    }

    public function create(User $user)
    {
        // Only allow admin to create books
        return $user->role === 'admin';
    }

    public function update(User $user, Book $book)
    {
        // Only allow admin to update books
        return $user->role === 'admin';
    }

    public function delete(User $user, Book $book)
    {
        // Only allow admin to delete books
        return $user->role === 'admin';
    }

}

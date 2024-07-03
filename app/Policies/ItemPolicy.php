<?php

namespace App\Policies;

use App\Models\GlobalUser;
use App\Models\Card;
use App\Models\Item;

class ItemPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if a user can create an item.
     */
    public function create(GlobalUser $user, Item $item): bool
    {
        // GlobalUser can only create items in cards they own.
        return $user->id === $item->card->user_id;
    }

    /**
     * Determine if a user can update an item.
     */
    public function update(GlobalUser $user, Item $item): bool
    {
        // GlobalUser can only update items in cards they own.
        return $user->id === $item->card->user_id;
    }

    /**
     * Determine if a user can delete an item.
     */
    public function delete(GlobalUser $user, Item $item): bool
    {
        // GlobalUser can only delete items in cards they own.
        return $user->id === $item->card->user_id;
    }
}

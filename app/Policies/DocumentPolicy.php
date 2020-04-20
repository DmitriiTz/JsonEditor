<?php

namespace App\Policies;

use App\User;
use App\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @param Document $document
     * @return bool|void
     */
    public function update(?User $user, Document $document)
    {
        if ($document->status === 'published') {
            return abort(400);
        }
        return true;
    }

    /**
     * @param User|null $user
     * @param $document
     * @return bool|void
     */
    public function publish(?User $user, $document)
    {
        if ($document->status === 'published') {
            return abort(200);
        }
        return true;
    }
}

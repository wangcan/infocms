<?php

namespace Larabase\Policies;

use Larabase\Models\BaseModel;
use Larabase\Models\Foundation\BaseUser;

/**
 * Class Policy
 *
 * @category Larabase
 * @package Larabase\Policies
 * @license https://opensource.org/licenses/MIT MIT
 */
abstract class AbstractPolicy
{
    /**
     * Get The owner
     *
     * @param BaseUser $user user
     * @param BaseModel $model model
     *
     * @return bool
     */
    public function owner(BaseUser $user, BaseModel $model)
    {
        return $model->getUserId() == $user->getUserId();
    }
}

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is admin for all authorization.
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the comment.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->author_id;
    }
}
use App\Models\Media;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is admin for all authorization.
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can store a medium.
     */
    public function store(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the medium.
     */
    public function delete(User $user, Media $medium): bool
    {
        return $user->isAdmin();
    }
}

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is admin for all authorization.
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can store a post.
     */
    public function store(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }
}
<?php

/*
 * This file is part of the Jiannei/lumen-api-starter.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Policies;

use App\Repositories\Enums\PermissionEnum;
use App\Repositories\Models\Post;
use App\Repositories\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can(PermissionEnum::ROUTE_POSTS_VIEW_ANY()->name)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  User|null  $user
     * @param  Post  $post
     * @return mixed
     */
    public function view(?User $user, Post $post)
    {
        if ($post->published) {
            return true;
        }

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }

        // admin overrides published status
        if ($user->can(PermissionEnum::ROUTE_POSTS_VIEW()->name)) {
            return true;
        }

        // authors can view their own unpublished posts
        return $user->isOwnerOf($post);
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can(PermissionEnum::ROUTE_POSTS_CREATE()->name)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if ($user->isOwnerOf($post) || $user->can('edit all posts')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if ($user->isOwnerOf($post) || $user->can(PermissionEnum::ROUTE_POSTS_DELETE()->name)) {
            return true;
        }

        return false;
    }
}

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is admin for all authorization.
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the user.
     */
    public function update(User $current_user, User $user): bool
    {
        return $current_user->id === $user->id;
    }

    /**
     * Determine whether the user can generate a personnal access token.
     */
    public function api_token(User $current_user, User $user): bool
    {
        return $current_user->id === $user->id;
    }
}

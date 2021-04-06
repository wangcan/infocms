<?php

namespace Larabase\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class Event
 *
 * @category Larabase
 * @package Larabase\Events
 * @license https://opensource.org/licenses/MIT MIT
 */
abstract class AbstractEvent
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user User
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}

namespace App\Events;

use App\Http\Resources\Comment as CommentResource;
use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Comment details
     *
     * @var CommentResource
     */
    public $comment;

    /**
     * Post details
     *
     * @var Post
     */
    private $post;

    /**
     * Create a new event instance.
     */
    public function __construct(CommentResource $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('post.' . $this->post->id);
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'comment.posted';
    }
}

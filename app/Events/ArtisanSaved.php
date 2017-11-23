<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ArtisanSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $artisan;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $artisan
     *
     * @return void
     */
    public function __construct(User $artisan)
    {
        $this->artisan = $artisan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getUser()
    {
        return $this->artisan;
    }
}

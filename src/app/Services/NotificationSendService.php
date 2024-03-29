<?php

namespace App\Services;



use App\Notifications\NewReplySubmitted;
use App\Repositories\SubscribeRepository;
use App\Repositories\ThreadRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;


class NotificationSendService
{

    protected ThreadRepository $threadRepo;
    protected UserRepository $userRepo;
    protected SubscribeRepository $subscribeRepo;

    public function __construct(SubscribeRepository $subscribeRepo, ThreadRepository $threadRepo, UserRepository $userRepo)
    {
        $this->threadRepo = $threadRepo;
        $this->userRepo = $userRepo;
        $this->subscribeRepo = $subscribeRepo;
    }

    //get list of user ids which subscribed a thread
    public function getNotifiableUserIds($thread_id): array
    {
        return $this->subscribeRepo->notifiableUser($thread_id);
    }

    //get user instance from ids
    public function getUserInstance($thread_id) : Collection
    {
        return $this->userRepo->find($this->getNotifiableUserIds($thread_id));
    }

    //send NewReplySubmitted notification to subscribed users
    public function notifyUserForNewReply($thread_id)
    {
       return new NewReplySubmitted($this->threadRepo->find($thread_id));
    }
}

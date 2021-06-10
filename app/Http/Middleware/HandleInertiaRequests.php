<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;

class HandleInertiaRequests extends Middleware {
    
    public function __construct(EventRepositoryInterface $event, TaskRepositoryInterface $task) {
        $this->event = $event;
        $this->task = $task;
    }

    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request) {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request) {
        $auth = (auth()->user()) ?? 0;
        $todaysTasks = ($auth) ? $this->task->getTodaysTasks($auth['id']) : [];
        $dailyTasks = ($auth) ? $this->task->getDailyTasks($auth['id']) : [];
        $todaysEvents = ($auth) ? $this->event->getTodaysEvents($auth['id']) : [];
        $dailyEvents = ($auth) ? $this->event->getDailyEvents($auth['id']) : [];
        
        return array_merge(parent::share($request), [
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error')
                ];
            }
        ], [
            'todayEvents' => ($auth) ? array_merge($todaysEvents->toArray(), $dailyEvents->toArray()) : [],
            'todayTasks' => ($auth) ? array_merge($todaysTasks->toArray(), $dailyTasks->toArray()): [],
            'unreadNotificationsCount' => (auth()->user()) ? auth()->user()->unreadNotifications()->count() : 0
        ]);
    }
}

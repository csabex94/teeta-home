<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface {

    public function getTask($id);
    public function getAllTasks($id);
    public function getTodaysTasks($id);
    public function getUncompletedTasksForToday($id);
    public function getDailyTasks($id);
    public function getCompletedTasks($id);
    public function getFollowingDaysTasks($days, $email, $userId);
    public function getFollowingWeeksTasks($weeks, $email, $userId);
    public function deletePreviousTasks($toDate);
    public function completeTask($id);
    public function store($request);
    public function update($request);
    public function deleteTask($id);
}

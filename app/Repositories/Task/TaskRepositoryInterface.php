<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface {
    
    public function getTask($id);
    public function getAllTasks();
    public function getTodaysTasks();
    public function getDailyTasks();
    public function getCompletedTasks();
    public function getFollowingDaysTasks($days, $email);
    public function getFollowingWeeksTasks($weeks, $email);
    public function deletePreviousTasks($toDate);

    
}

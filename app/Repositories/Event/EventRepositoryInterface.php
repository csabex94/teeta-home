<?php

namespace App\Repositories\Event;

interface EventRepositoryInterface {
    
    public function getEvent($id);
    public function getAllEvents();
    public function getTodaysEvents();
    public function getDailyEvents();
    public function getImportantEvents();
    public function getFollowingDaysEvents($days, $email);
    public function getFollowingWeeksEvents($weeks, $email);
    public function deletePreviousEvents($toDate);
    
}

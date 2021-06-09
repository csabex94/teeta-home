<?php

namespace App\Repositories\Event;

interface EventRepositoryInterface {

    public function getEvent($id);
    public function getAllEvents($id);
    public function getTodaysEvents($id);
    public function getCompletedEvents($id);
    public function getDailyEvents($id);
    public function getImportantEvents($id);
    public function getFollowingDaysEvents($days, $email);
    public function getFollowingWeeksEvents($weeks, $email);
    public function deletePreviousEvents($toDate);
    public function deleteEvent($id);
    public function store($request);
    public function update($request);
    public function completeEvent($id);
}

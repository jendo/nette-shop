<?php

namespace App\Model\Trip;

class Trip
{

	private $id;

	private $name;

	private $userId;

	private $place;

	private $tripDate;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	public function getPlace()
	{
		return $this->place;
	}

	public function setPlace($place)
	{
		$this->place = $place;
	}

	public function getTripDate()
	{
		return $this->tripDate;
	}

	public function setTripDate($tripDate)
	{
		$this->tripDate = $tripDate;
	}

public function toArray()
	{
		return array(
				TripManager::COLUMN_NAME => $this->getName(),
				TripManager::COLUMN_USER_ID => $this->getUserId(),
				TripManager::COLUMN_PLACE => $this->getPlace(),
				TripManager::COLUMN_TRIP_DATE => $this->getTripDate()
				);
	}

}
<?php

namespace App\Model\Trip;

/**
 * Description of TripManager
 *
 * @author JenisM01
 */
class TripManager extends \Core\Base\BaseManager
{

	/**
	 * Trip name column
	 *
	 * @var string
	 */
	const COLUMN_NAME = 'name';

	/**
	 * Trip user column
	 *
	 * @var string
	 */
	const COLUMN_USER_ID = 'user_id';

	/**
	 * Trip place column
	 *
	 * @var string
	 */
	const COLUMN_PLACE = 'place';

	/**
	 * Trip date column
	 *
	 * @var string
	 */
	const COLUMN_TRIP_DATE = 'trip_date';

	/**
	 * Manager name
	 *
	 * @var string
	 */
	const NAME = 'trip';


	/**
	 * Insert trip into database
	 *
	 * @param \App\Model\Trip\Trip $trip
	 * @return \App\Model\Trip\Trip $trip Inserterd trip
	 */
	public function add(Trip $trip)
	{
		$newTripId = $this->dibi()->insert($this->getName(), $trip->toArray())->execute(\dibi::IDENTIFIER);
		$trip->setId($newTripId);
		return $trip;
	}

	public function getName()
	{
		return self::NAME;
	}
}

?>

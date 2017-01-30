<?php

class Profile {
	/**
	 * id for the profile; this is a primary key
	 * @var int for profileId
	 **/
	private $profileId;
	/**
	 * id for profileImageId
	 * this is a foreign key that references image (imageId)
	 * @var int $profileImageId
	 **/
	private $profileImageId;
	/**
	 * activation code will be sent to end users email
	 * @var char(16) for profileActivation
	 **/
	private $profileActivation;
	/**
	 *user private access email
	 * @var varchar(255) for profileEmail;
	 **/
	private $profileEmail;
	/**
	 * created by the user and has to be unique
	 * @var varchar(21) is for profileHandlie not null
	 **/
	private $profileHandle;
	/**
	 *
	 **/

}

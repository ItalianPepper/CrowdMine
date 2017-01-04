<?php

/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 08/12/2016
 * Time: 20:38
 */
class FeedbackListObject
{
    private $feedbackID;
    private $feedbackTile;
    private $feedbackDesc;
    private $userFirstName;
    private $userLastName;
    private $userProfileImage;
    private $feedbackRating;

    /**
     * FeedbackListObject constructor.
     * @param $feedbackID
     * @param $feedbackTile
     * @param $feedbackDesc
     * @param $userFirstName
     * @param $userLastName
     * @param $userProfileImage
     * @param $feedbackRating
     */
    public function __construct($feedbackID, $feedbackTile, $feedbackDesc, $userFirstName, $userLastName, $userProfileImage, $feedbackRating)
    {
        $this->feedbackID = $feedbackID;
        $this->feedbackTile = $feedbackTile;
        $this->feedbackDesc = $feedbackDesc;
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->userProfileImage = $userProfileImage;
        $this->feedbackRating = $feedbackRating;
    }


    /**
     * @return mixed
     */
    public function getFeedbackID()
    {
        return $this->feedbackID;
    }

    /**
     * @param mixed $feedbackID
     */
    public function setFeedbackID($feedbackID)
    {
        $this->feedbackID = $feedbackID;
    }

    /**
     * @return mixed
     */
    public function getFeedbackTile()
    {
        return $this->feedbackTile;
    }

    /**
     * @param mixed $feedbackTile
     */
    public function setFeedbackTile($feedbackTile)
    {
        $this->feedbackTile = $feedbackTile;
    }

    /**
     * @return mixed
     */
    public function getFeedbackDesc()
    {
        return $this->feedbackDesc;
    }

    /**
     * @param mixed $feedbackDesc
     */
    public function setFeedbackDesc($feedbackDesc)
    {
        $this->feedbackDesc = $feedbackDesc;
    }

    /**
     * @return mixed
     */
    public function getUserFirstName()
    {
        return $this->userFirstName;
    }

    /**
     * @param mixed $userFirstName
     */
    public function setUserFirstName($userFirstName)
    {
        $this->userFirstName = $userFirstName;
    }

    /**
     * @return mixed
     */
    public function getUserLastName()
    {
        return $this->userLastName;
    }

    /**
     * @param mixed $userLastName
     */
    public function setUserLastName($userLastName)
    {
        $this->userLastName = $userLastName;
    }

    /**
     * @return mixed
     */
    public function getUserProfileImage()
    {
        return $this->userProfileImage;
    }

    /**
     * @param mixed $userProfileImage
     */
    public function setUserProfileImage($userProfileImage)
    {
        $this->userProfileImage = $userProfileImage;
    }

    /**
     * @return mixed
     */
    public function getFeedbackRating()
    {
        return $this->feedbackRating;
    }

    /**
     * @param mixed $feedbackRating
     */
    public function setFeedbackRating($feedbackRating)
    {
        $this->feedbackRating = $feedbackRating;
    }



}
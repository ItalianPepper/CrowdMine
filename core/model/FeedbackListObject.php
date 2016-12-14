<?php

/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 08/12/2016
 * Time: 20:38
 */
class FeedbackListObject implements JsonSerializable
{
    private $feedbackID;
    private $feedbackTitle;
    private $feedbackDesc;
    private $userFirstName;
    private $userLastName;
    private $userProfileImage;
    private $feedbackRating;

    /**
     * FeedbackListObject constructor.
     * @param $feedbackID
     * @param $feedbackTitle
     * @param $feedbackDesc
     * @param $userFirstName
     * @param $userLastName
     * @param $userProfileImage
     * @param $feedbackRating
     */
    public function __construct($feedbackID, $feedbackTitle, $feedbackDesc, $userFirstName, $userLastName, $userProfileImage, $feedbackRating)
    {
        $this->feedbackID = $feedbackID;
        $this->feedbackTitle = $feedbackTitle;
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
    public function getFeedbackTitle()
    {
        return $this->feedbackTitle;
    }

    /**
     * @param mixed $feedbackTitle
     */
    public function setFeedbackTitle($feedbackTitle)
    {
        $this->feedbackTitle = $feedbackTitle;
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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'feedbackID' => $this->getFeedbackID(),
            'feedbackTitle' => $this->getFeedbackTitle(),
            'feedbackDesc' => $this->getFeedbackDesc(),
            'userFirstName' => $this->getUserFirstName(),
            'userLastName' => $this->getUserLastName(),
            'userProfileImage' => $this->getUserProfileImage(),
            'feedbackRating' => $this->getFeedbackRating()
        ];
    }
}
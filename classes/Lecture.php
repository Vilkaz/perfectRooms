<?php

namespace classes;
/**
 * Created by IntelliJ IDEA.
 * User: Vilkaz
 * Date: 18.01.2015
 * Time: 11:46
 */




class Lecture {
    private $shorthand='';
    private $room='';
    private $teacherShort='';
    private $starttime='';
    private $endtime='';
    private $dismissed=false;
    private $swapped=false;

    /**
     * @return boolean
     */
    public function getDismissed()
    {
        return $this->dismissed;
    }

    /**
     * @param boolean $dismissed
     */
    public function setDismissed($dismissed)
    {
        $this->dismissed = $dismissed;
    }

    /**
     * @return string
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * @param string $endtime
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;
    }

    /**
     * @return string
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * @param string $starttime
     */
    public function setStarttime($starttime)
    {
        $this->starttime = $starttime;
    }

    /**
     * @return boolean
     */
    public function getSwapped()
    {
        return $this->swapped;
    }

    /**
     * @param boolean $swapped
     */
    public function setSwapped($swapped)
    {
        $this->swapped = $swapped;
    }





    /**
     * @return string
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param string $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

    /**
     * @return string
     */
    public function getShorthand()
    {
        return $this->shorthand;
    }

    /**
     * @param string $shorthand
     */
    public function setShorthand($shorthand)
    {
        $this->shorthand = $shorthand;
    }

    /**
     * @return string
     */
    public function getTeacherShort()
    {
        return $this->teacherShort;
    }

    /**
     * @param string $teacherShort
     */
    public function setTeacherShort($teacherShort)
    {
        $this->teacherShort = $teacherShort;
    }

}
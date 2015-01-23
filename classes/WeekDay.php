<?php
/**
 * Created by IntelliJ IDEA.
 * User: Vilkaz
 * Date: 18.01.2015
 * Time: 11:51
 */

namespace classes;

class WeekDay
{
    private $timeFlow = array(
        '8:00-8:45',
        '8:45-9:30',
        '9:50-10:35',
        '10:35-11:20',
        '11:40-12:25',
        '12:25-13:10',
        '13:30-14:15',
        '14:15-15:00',
        '15:20-16:05',
        '16:05-16:50',
        '17:10-17:55',
        '17:55-18:40',
        '19:00-19:45',
        '19:45-20:30',
        '20:50-21:35',
        '21:35-22:20'
    );

    private $timeContent = array();



    /**
     * @return array
     */
    public function getTimeContent()
    {
        return $this->timeContent;
    }

    /**
     * @param array $timeContent
     */
    public function setTimeContent($timeContent)
    {
        $this->timeContent = $timeContent;
    }

    /**
     * @return array
     */
    public function getTimeFlow()
    {
        return $this->timeFlow;
    }
    /**
     * @param array $timeFlow
     */
    public function setTimeFlow($timeFlow)
    {
        $this->timeFlow = $timeFlow;
    }
}
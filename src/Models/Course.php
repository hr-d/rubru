<?php

namespace HRD\Rubru\Models;

use Carbon\Carbon;

/**
 * Class Course
 * @package HRD\Rubru\Models
 */
class Course
{
    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var string
     */
    private $title = "";

    /**
     * @var string
     */
    private $description = "";

    /**
     * @var Carbon
     */
    private $startDateTime;
    /**
     * @var Carbon
     */
    private $finishDateTime;


    /**
     * get id
     *
     * @return int|null
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * set id
     * @param int $id
     *
     * @return Course
     */
    public function set_id(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * get title
     *
     * @return string
     */
    public function get_title(): string
    {
        return $this->title;
    }

    /**
     * set title
     * @param string $title
     *
     * @return Course
     */
    public function set_title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * get description
     *
     * @return string
     */
    public function get_description(): string
    {
        return $this->description;
    }

    /**
     * set description
     * @param string $description
     *
     * @return Course
     */
    public function set_description(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * get start dateTime
     *
     * @return Carbon
     */
    public function get_startDateTime(): Carbon
    {
        if (empty($this->startDateTime)) {
            $this->startDateTime = Carbon::now();
        }
        return $this->startDateTime;
    }

    /**
     * set start dateTime
     * @param $startDateTime
     *
     * @return Course
     */
    public function set_startDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime instanceof Carbon ? $startDateTime : Carbon::parse($startDateTime);
        return $this;
    }

    /**
     * get finish dateTime
     *
     * @return Carbon
     */
    public function get_finishDateTime(): Carbon
    {
        if (empty($this->finishDateTime)) {
            $now = Carbon::now();
            $this->finishDateTime = $now->addYear();
        }
        return $this->finishDateTime;
    }

    /**
     * set finish dateTime
     * @param $finishDateTime
     *
     * @return Course
     */
    public function set_finishDateTime($finishDateTime)
    {
        $this->finishDateTime = $finishDateTime instanceof Carbon ? $finishDateTime : Carbon::parse($finishDateTime);
        return $this;
    }

    /**
     * toArray Attribute
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->get_id(),
            'title' => $this->get_title(),
            'description' => $this->get_description(),
            'startDateTime' => $this->get_startDateTime()->format('Y-m-d H:i:s'),
            'finishDateTime' => $this->get_finishDateTime()->format('Y-m-d H:i:s')
        ];
    }

    /**
     * set all attribute
     * @param array $data
     */
    public function setAllAttribute(array $data): Room
    {
        foreach ($data as $param => $value) {
            $function_name = 'set_' . $param;
            if (method_exists($this, $function_name)) {
                $this->$function_name($value);
            }
        }
        return $this;
    }
}

<?php


namespace HRD\Rubru\Collection;


use HRD\Rubru\Exception\DuplicateCourse;
use HRD\Rubru\HttpClients\Request;
use \HRD\Rubru\Models\Course;

/**
 * Class CourseCollection
 * @package HRD\Rubru\Collection
 */
class CourseCollection extends Course
{
    /**
     * @var Request
     */
    private $request;

    /**
     * ClassRoom constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * create or update course
     * @return $this
     */
    public function save()
    {
        $data = $this->toArray();
        try {
            $id = $this->request->make('webinar/course/save', 'POST', $data);
            $this->set_id($id);
        } catch (DuplicateCourse $e) {
            $title = $this->get_title();
            $title .= '-' . rand(1, 99999999);
            $this->set_title($title);
            return $this->save();
        }
        return $this;
    }

    /**
     * get course
     * @param int $id
     *
     * @return $this
     */
    public function get(int $id)
    {
        $room = $this->request->make("webinar/course/{$id}", 'GET', []);
        $this->setAllAttribute($room);
        return $this;
    }
}

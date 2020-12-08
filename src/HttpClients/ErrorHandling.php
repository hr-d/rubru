<?php


namespace HRD\Rubru\HttpClients;


use HRD\Rubru\Exception\AccessDenied;
use HRD\Rubru\Exception\AlreadyExists;
use HRD\Rubru\Exception\CourseNotAccessible;
use HRD\Rubru\Exception\RoomNotAccessible;
use HRD\Rubru\Exception\CourseNotFound;
use HRD\Rubru\Exception\RoomNotFound;
use HRD\Rubru\Exception\DuplicateCourse;
use HRD\Rubru\Exception\DuplicateRoom;
use HRD\Rubru\Exception\InvalidRoomName;
use HRD\Rubru\Exception\UnavailableUsername;
use Psr\Http\Message\ResponseInterface;

class ErrorHandling
{

    private $correspondingErrorExceptions = [
        'Unauthorized' => AccessDenied::class,
        'course.name.exists' => DuplicateCourse::class,
        'classroom.name.exists' => DuplicateRoom::class,
        'ClassroomNotAccessible' => RoomNotAccessible::class,
        'CourseNotAccessible' => CourseNotAccessible::class,
        'ClassroomNotFound' => RoomNotFound::class,
        'CourseNotFound' => CourseNotFound::class,
        'classroomStudentNotFound' => StudentNotFound::class,
    ];

    /**
     * @param int $statusCode
     * @param array $result
     *
     * @throws \Exception
     */
    public function fire(int $statusCode, array $result)
    {
        if (empty($result['title']) && empty($result['status'])) {
            throw new \Exception("i don't know! please connect to Rubru", $statusCode);
        }
        foreach ($this->correspondingErrorExceptions as $errorKey => $class) {
            $result['errorKey'] = $result['errorKey']?: $result['title'];
            if ($result['errorKey'] == $errorKey) {
                throw new $class($result['title'], $result['status']);
            }
        }
        throw new \Exception($result['title'], $result['status']);
    }
}

<?php


namespace HRD\Rubru\Collection;


use HRD\Rubru\HttpClients\Request;
use HRD\Rubru\Models\User;

/**
 * Class UserCollection
 * @package HRD\Rubru\Collection
 */
class UserCollection extends User
{
    /**
     * @var Request
     */
    private $request;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * attach user to the class room
     * create user if not exists username
     * update user when user id exists
     * @return $this
     */
    public function attach()
    {
        $data = $this->toArray();
        $response = $this->request->make('webinar/classroom/student/save', 'POST', $data);
        $this->set_userId($response['userId']);
        $this->set_token($response['token']);

        return $this;
    }

    /**
     * detach user
     * @param int $userId
     * @param int $classroomId
     *
     */
    public function detach(int $classroomId)
    {
        $id = $this->get_userId();
        $this->request->make("/webinar/classroom/student/delete/{$classroomId}/{$id}", 'DELETE', []);
    }

    /**
     * ligin url to the class room
     * @param string $sessionUuidName
     * @return string
     */
    public function loginUrl(string $sessionUuidName)
    {
        $base_url = $this->request->base_url();
        $token = $this->get_token();
        return "{$base_url}/{$sessionUuidName}-{$token}";
    }
}

<?php


namespace HRD\Rubru\Collection;


use HRD\Rubru\Exception\DuplicateRoom;
use HRD\Rubru\HttpClients\Request;
use \HRD\Rubru\Models\Room;

/**
 * Class RoomCollection
 * @package HRD\Rubru\Collection
 */
class RoomCollection extends Room
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
     * create or update room
     * @return $this
     */
    public function save()
    {
        $data = $this->toArray();
        try {
            $response = $this->request->make('webinar/classroom/save', 'POST', $data);
            $this->set_id($response['classroomId']);
            $this->set_sessionUuidName($response['sessionUuidName']);
        } catch (DuplicateRoom $e) {
            $name = $this->get_name();
            if (mb_strlen($name) > 45)
                $name = mb_substr($name, 0, 45);
            $name .= rand(1, 99999);
            $this->set_name($name);
            return $this->save();
        }
        return $this;
    }

    /**
     * get room
     *
     * @return $this
     */
    public function get()
    {
        $id = $this->get_id();
        $room = $this->request->make("webinar/classroom/get/{$id}", 'GET', []);
        $this->setAllAttribute($room);
        return $this;
    }

    /**
     * delete room
     */
    public function delete()
    {
        $id = $this->get_id();
        $this->request->make("webinar/classroom/delete/{$id}", 'DELETE', []);
    }

    /**
     * the class room url
     * @return string
     */
    public function url()
    {
        $base_url = $this->request->base_url();
        $sessionUuidName = $this->get_sessionUuidName();
        return "{$base_url}/{$sessionUuidName}";
    }

    /**
     * timeUsage room
     *
     * @return int
     */
    public function timeUsage(): int
    {
        $id = $this->get_id();
        $response = $this->request->make("classroom/sessions/report/{$id}", 'POST', []);
        $timeUsage = 0;
        foreach ($response as $item) {
            $timeUsage += intval($item['duration']);
        }
        return $timeUsage;
    }

    /**
     * recording ids
     *
     * @return array
     */
    public function recordingIds(): array
    {
        $id = $this->get_id();
        $response = $this->request->make("classroom/recordings/list/{$id}", 'GET', []);
        $ids = [];
        foreach ($response as $item) {
            if ($item['storageStatus'] != 'Downloaded')
                continue;
            $ids[] = (object)['id' => $item['id'], 'fileSize' => $item['fileSize']];
        }
        return $ids;
    }

    /**
     * recording file
     *
     * @param int $id
     */
    public function recordingFile(int $id)
    {
        return $this->request->make("classroom/recording/get/{$id}", 'GET', []);
    }
}

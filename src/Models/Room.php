<?php

namespace HRD\Rubru\Models;

use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;

/**
 * Class Room
 * @package HRD\Rubru\Models
 */
class Room
{
    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var string
     */
    private $name = "";

    /**
     * @var string
     */
    private $sessionUuidName = "";

    /**
     * @var bool
     */
    private $guestSession = true;

    /**
     * @var bool
     */
    private $guestWithSubscriberRole = true;

    /**
     * @var bool
     */
    private $useEnterToken = true;

    /**
     * @var Carbon
     */
    private $startDateTime;
    /**
     * @var Carbon
     */
    private $finishDateTime;

    /**
     * @var int
     */
    private $courseId;

    /**
     * @var bool
     */
    private $hideGlobalChat = true;

    /**
     * @var bool
     */
    private $hidePrivateChat = true;

    /**
     * @var bool
     */
    private $hideParticipantsList = true;

    /**
     * @var bool
     */
    private $disableFileTransfer = false;

    /**
     * @var bool
     */
    private $hideSoundSensitive = false;

    /**
     * @var bool
     */
    private $hidePublishPermit = true;

    /**
     * @var bool
     */
    private $enableSubscriberDirectEnter = false;

    /**
     * @var bool
     */
    private $publisherMustEnterFirst = true;

    /**
     * @var int
     */
    private $maxUserCount;

    /**
     * @var string
     */
    private $recordingMode;

    /**
     * @var bool
     */
    private $moderatorAutoLogin;


    /**
     * set id
     * @param int $id
     *
     * @return ClassRoom
     */
    public function set_id(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

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
     * set name
     * @param string $name
     *
     * @return ClassRoom
     */
    public function set_name(string $name)
    {
        mb_internal_encoding('UTF-8');
        if (mb_strlen($name) > 50)
            $name = mb_substr($name, 0, 50);
        $this->name = $this->clean($name);
        return $this;
    }

    /**
     * get name
     *
     * @return string
     */
    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * set sessionUuidName
     * @param string $sessionUuidName
     *
     * @return ClassRoom
     */
    public function set_sessionUuidName(string $sessionUuidName)
    {
        $this->sessionUuidName = $sessionUuidName;
        return $this;
    }

    /**
     * get sessionUuidName
     *
     * @return string
     */
    public function get_sessionUuidName(): string
    {
        return $this->sessionUuidName;
    }

    /**
     * set guestSession
     * @param bool $guestSession
     *
     * @return ClassRoom
     */
    public function set_guestSession(bool $guestSession)
    {
        $this->guestSession = $guestSession;
        return $this;
    }

    /**
     * get guestSession
     *
     * @return bool
     */
    public function get_guestSession(): bool
    {
        return $this->guestSession;
    }

    /**
     * set guestWithSubscriberRole
     * @param bool $guestWithSubscriberRole
     *
     * @return ClassRoom
     */
    public function set_guestWithSubscriberRole(bool $guestWithSubscriberRole)
    {
        $this->guestWithSubscriberRole = $guestWithSubscriberRole;
        return $this;
    }

    /**
     * get guestWithSubscriberRole
     *
     * @return bool
     */
    public function get_guestWithSubscriberRole(): bool
    {
        return $this->guestWithSubscriberRole;
    }

    /**
     * set useEnterToken
     * @param bool $useEnterToken
     *
     * @return ClassRoom
     */
    public function set_useEnterToken(bool $useEnterToken)
    {
        $this->useEnterToken = $useEnterToken;
        return $this;
    }

    /**
     * get useEnterToken
     *
     * @return bool
     */
    public function get_useEnterToken(): bool
    {
        return $this->useEnterToken;
    }

    /**
     * set start dateTime
     * @param $startDateTime
     *
     * @return ClassRoom
     */
    public function set_startDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime instanceof Carbon ? $startDateTime : Carbon::parse($startDateTime);
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
     * set finish dateTime
     * @param $finishDateTime
     *
     * @return ClassRoom
     */
    public function set_finishDateTime($finishDateTime)
    {
        $this->finishDateTime = $finishDateTime instanceof Carbon ? $finishDateTime : Carbon::parse($finishDateTime);
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
     * set courseId
     * @param int $courseId
     *
     * @return ClassRoom
     */
    public function set_courseId(int $courseId)
    {
        $this->courseId = $courseId;
        return $this;
    }

    /**
     * get courseId
     *
     * @return int
     */
    public function get_courseId(): int
    {
        return $this->courseId;
    }

    /**
     * set hideGlobalChat
     * @param bool $hideGlobalChat
     *
     * @return ClassRoom
     */
    public function set_hideGlobalChat(bool $hideGlobalChat)
    {
        $this->hideGlobalChat = $hideGlobalChat;
        return $this;
    }

    /**
     * get hideGlobalChat
     *
     * @return bool
     */
    public function get_hideGlobalChat(): bool
    {
        return $this->hideGlobalChat;
    }

    /**
     * set hidePrivateChat
     * @param bool $hidePrivateChat
     *
     * @return ClassRoom
     */
    public function set_hidePrivateChat(bool $hidePrivateChat)
    {
        $this->hidePrivateChat = $hidePrivateChat;
        return $this;
    }

    /**
     * get hidePrivateChat
     *
     * @return bool
     */
    public function get_hidePrivateChat(): bool
    {
        return $this->hidePrivateChat;
    }

    /**
     * set hideParticipantsList
     * @param bool $hideParticipantsList
     *
     * @return ClassRoom
     */
    public function set_hideParticipantsList(bool $hideParticipantsList)
    {
        $this->hideParticipantsList = $hideParticipantsList;
        return $this;
    }

    /**
     * get hideParticipantsList
     *
     * @return bool
     */
    public function get_hideParticipantsList(): bool
    {
        return $this->hideParticipantsList;
    }

    /**
     * set disableFileTransfer
     * @param bool $disableFileTransfer
     *
     * @return ClassRoom
     */
    public function set_disableFileTransfer(bool $disableFileTransfer)
    {
        $this->disableFileTransfer = $disableFileTransfer;
        return $this;
    }

    /**
     * get disableFileTransfer
     *
     * @return bool
     */
    public function get_disableFileTransfer(): bool
    {
        return $this->disableFileTransfer;
    }

    /**
     * set hideSoundSensitive
     * @param bool $hideSoundSensitive
     *
     * @return ClassRoom
     */
    public function set_hideSoundSensitive(bool $hideSoundSensitive)
    {
        $this->hideSoundSensitive = $hideSoundSensitive;
        return $this;
    }

    /**
     * get hideSoundSensitive
     *
     * @return bool
     */
    public function get_hideSoundSensitive(): bool
    {
        return $this->hideSoundSensitive;
    }

    /**
     * set hidePublishPermit
     * @param bool $hidePublishPermit
     *
     * @return ClassRoom
     */
    public function set_hidePublishPermit(bool $hidePublishPermit)
    {
        $this->hidePublishPermit = $hidePublishPermit;
        return $this;
    }

    /**
     * get hidePublishPermit
     *
     * @return bool
     */
    public function get_hidePublishPermit(): bool
    {
        return $this->hidePublishPermit;
    }

    /**
     * set enableSubscriberDirectEnter
     * @param bool $enableSubscriberDirectEnter
     *
     * @return ClassRoom
     */
    public function set_enableSubscriberDirectEnter(bool $enableSubscriberDirectEnter)
    {
        $this->enableSubscriberDirectEnter = $enableSubscriberDirectEnter;
        return $this;
    }

    /**
     * get enableSubscriberDirectEnter
     *
     * @return bool
     */
    public function get_enableSubscriberDirectEnter(): bool
    {
        return $this->enableSubscriberDirectEnter;
    }

    /**
     * set publisherMustEnterFirst
     * @param bool $publisherMustEnterFirst
     *
     * @return ClassRoom
     */
    public function set_publisherMustEnterFirst(bool $publisherMustEnterFirst)
    {
        $this->publisherMustEnterFirst = $publisherMustEnterFirst;
        return $this;
    }

    /**
     * get publisherMustEnterFirst
     *
     * @return bool
     */
    public function get_publisherMustEnterFirst(): bool
    {
        return $this->publisherMustEnterFirst;
    }

    /**
     * set maxUserCount
     * @param int $maxUserCount
     *
     * @return ClassRoom
     */
    public function set_maxUserCount(int $maxUserCount)
    {
        $this->maxUserCount = $maxUserCount;
        return $this;
    }

    /**
     * get maxUserCount
     *
     * @return int
     */
    public function get_maxUserCount(): int
    {
        return $this->maxUserCount;
    }

    /**
     * set recordingMode
     * @param string $recordingMode
     *
     * @return ClassRoom
     */
    public function set_recordingMode(string $recordingMode)
    {
        if (RecordingMode::check($recordingMode)) {
            $this->recordingMode = $recordingMode;
        }
        return $this;
    }

    /**
     * get recordingMode
     *
     * @return string
     */
    public function get_recordingMode(): string
    {
        return $this->recordingMode;
    }

    /**
     * set moderatorAutoLogin
     * @param bool $moderatorAutoLogin
     *
     * @return ClassRoom
     */
    public function set_moderatorAutoLogin(int $moderatorAutoLogin)
    {
        $this->moderatorAutoLogin = $moderatorAutoLogin;
        return $this;
    }

    /**
     * get moderatorAutoLogin
     *
     * @return bool
     */
    public function get_moderatorAutoLogin(): bool
    {
        return $this->moderatorAutoLogin;
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
            'name' => $this->get_name(),
            'sessionUuidName' => $this->get_sessionUuidName(),
            'guestSession' => $this->get_guestSession(),
            'guestWithSubscriberRole' => $this->get_guestWithSubscriberRole(),
            'useEnterToken' => $this->get_useEnterToken(),
            'startDateTime' => $this->get_startDateTime()->format('Y-m-d H:i:s'),
            'finishDateTime' => $this->get_finishDateTime()->format('Y-m-d H:i:s'),
            'courseId' => $this->get_courseId(),
            'hideGlobalChat' => $this->get_hideGlobalChat(),
            'hidePrivateChat' => $this->get_hidePrivateChat(),
            'hideParticipantsList' => $this->get_hideParticipantsList(),
            'disableFileTransfer' => $this->get_disableFileTransfer(),
            'hideSoundSensitive' => $this->get_hideSoundSensitive(),
            'hidePublishPermit' => $this->get_hidePublishPermit(),
            'enableSubscriberDirectEnter' => $this->get_enableSubscriberDirectEnter(),
            'publisherMustEnterFirst' => $this->get_publisherMustEnterFirst(),
            'maxUserCount' => $this->get_maxUserCount(),
            'recordingMode' => $this->get_recordingMode(),
            'moderatorAutoLogin' => $this->get_moderatorAutoLogin(),
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

    private function clean($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        $string = $this->convertNumber($string);
        $string = mb_ereg_replace('[^a-z0-9 پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژؤإآأًٌٍَُِّ]', '', $string); // Removes special chars.
        return $string;
    }

    private function convertNumber(string $string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
}

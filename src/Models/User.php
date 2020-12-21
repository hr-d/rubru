<?php

namespace HRD\Rubru\Models;

use Carbon\Carbon;

/**
 * Class User
 * @package HRD\Rubru\Models
 */
class User
{
    /**
     * @var int|null
     */
    private $userId = null;
    /**
     * @var int
     */
    private $classroomId;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $firstName = "";

    /**
     * @var string
     */
    private $lastName = "";

    /**
     * @var string
     */
    private $authorityName = Authority::ACCESS_LEVEL_NORMAL;

    /**
     * @var bool
     */
    private $needsLogin = true;

    /**
     * @var int
     */
    private $maxUseCount = 1;

    /**
     * @var string
     */
    private $token;

    /**
     * set userId
     * @param int $userId
     *
     * @return User
     */
    public function set_userId(int $userId = null)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * get userId
     *
     * @return int|null
     */
    public function get_userId()
    {
        return $this->userId;
    }

    /**
     * set classroomId
     * @param int $classroomId
     *
     * @return User
     */
    public function set_classroomId(int $classroomId)
    {
        $this->classroomId = $classroomId;
        return $this;
    }

    /**
     * get classroomId
     *
     * @return int
     */
    public function get_classroomId(): int
    {
        return $this->classroomId;
    }

    /**
     * set login
     * @param string $login
     *
     * @return User
     */
    public function set_login(string $login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * get login
     *
     * @return string
     */
    public function get_login(): string
    {
        return $this->login;
    }

    /**
     * set password
     * @param string $password
     *
     * @return User
     */
    public function set_password(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * get password
     *
     * @return string
     */
    public function get_password(): string
    {
        return $this->password;
    }

    /**
     * set firstName
     * @param string $firstName
     *
     * @return User
     */
    public function set_firstName(string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * get firstName
     *
     * @return string
     */
    public function get_firstName(): string
    {
        return $this->firstName;
    }

    /**
     * set lastName
     * @param string $lastName
     *
     * @return User
     */
    public function set_lastName(string $lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * get lastName
     *
     * @return string
     */
    public function get_lastName(): string
    {
        return $this->lastName;
    }

    /**
     * set authorityName
     * @param string $authorityName
     *
     * @return User
     */
    public function set_authorityName(string $authorityName)
    {
        if (Authority::check($authorityName)) {
            $this->authorityName = $authorityName;
        }
        return $this;
    }

    /**
     * get authorityName
     *
     * @return string
     */
    public function get_authorityName(): string
    {
        return $this->authorityName;
    }

    /**
     * set needsLogin
     * @param bool $needsLogin
     *
     * @return User
     */
    public function set_needsLogin(bool $needsLogin)
    {
        $this->needsLogin = $needsLogin;
        return $this;
    }

    /**
     * get needsLogin
     *
     * @return bool
     */
    public function get_needsLogin(): bool
    {
        return $this->needsLogin;
    }

    /**
     * set maxUseCount
     * @param int $maxUseCount
     *
     * @return User
     */
    public function set_maxUseCount(int $maxUseCount)
    {
        $this->maxUseCount = $maxUseCount;
        return $this;
    }

    /**
     * get maxUseCount
     *
     * @return int
     */
    public function get_maxUseCount(): int
    {
        return $this->maxUseCount;
    }

    /**
     * set token
     * @param string $token
     *
     * @return User
     */
    public function set_token(string $token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * get token
     *
     * @return string
     */
    public function get_token(): string
    {
        return $this->token;
    }

    /**
     * toArray Attribute
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'userId' => $this->get_userId(),
            'classroomId' => $this->get_classroomId(),
            'login' => $this->get_login(),
            'password' => $this->get_password(),
            'firstName' => $this->get_firstName(),
            'lastName' => $this->get_lastName(),
            'authorityName' => $this->get_authorityName(),
            'needsLogin' => $this->get_needsLogin(),
            'maxUseCount' => $this->get_maxUseCount(),
        ];
    }

    /**
     * set all attribute
     * @param array $data
     */
    public function setAllAttribute(array $data): Room
    {
        foreach ($data as $param=>$value) {
            $function_name = 'set_' . $param;
            if (method_exists($this, $function_name)) {
                $this->$function_name($value);
            }
        }
        return $this;
    }
}

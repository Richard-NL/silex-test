<?php

namespace SoapTypes;

class ApplicationCredentials
{

    /**
     * @var string
     */
    protected $userId = null;

    /**
     * @var string
     */
    protected $password = null;

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


}


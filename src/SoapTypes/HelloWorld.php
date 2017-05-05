<?php

namespace SoapTypes;

use Phpro\SoapClient\Type\RequestInterface;

class HelloWorld implements RequestInterface
{

    /**
     * @var string
     */
    protected $arg0 = null;


    public function __construct(string $name)
    {
        $this->arg0 = $name;
    }

    /**
     * @return string
     */
    public function getArg0()
    {
        return $this->arg0;
    }


}


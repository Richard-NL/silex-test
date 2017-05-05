<?php

namespace SoapTypes;

use Phpro\SoapClient\Type\ResultInterface;

class HelloWorldResponse implements ResultInterface
{

    /**
     * @var string
     */
    protected $return = null;

    /**
     * @return string
     */
    public function getReturn()
    {
        return $this->return;
    }


}


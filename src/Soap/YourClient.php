<?php


namespace Soap;


use Phpro\SoapClient\Client;
use Phpro\SoapClient\Type\RequestInterface;

class YourClient extends Client
{
    /**
     * @param RequestInterface $request
     *
     * @return ResultInterface
     * @throws \Phpro\SoapClient\Exception\SoapException
     */
    public function helloWorld(RequestInterface $request)
    {
        return $this->call('helloWorld', $request);
    }
}
<?php

/*
 * This file is part of the GestPayWS library.
 *
 * (c) Manuel Dalla Lana <endelwar@aregar.it>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EndelWar\GestPayWS;

use EndelWar\GestPayWS\Parameter;
use EndelWar\GestPayWS\Response;

/**
 * Class WsS2S
 * @package EndelWar\GestPayWS
 */
class WSS2S extends Service
{

    /**
     * @param PagamParameter $parameters
     * @return EncryptResponse
     */
    public function pagam(Parameter\PagamParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callPagamS2S($parameters);
        return new Response\PagamResponse($soapResponse);
    }

    /**
     * @param CheckCardParameter $parameters
     * @return EncryptResponse
     */
    public function checkCard(Parameter\CheckCardParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callCheckCartaS2S($parameters);
        return new Response\CheckCardResponse($soapResponse);
    }

    /**
     * @param VerifyCardParameter $parameters
     * @return EncryptResponse
     */
    public function verifyCard(Parameter\erifyCardParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callVerifyCardS2S($parameters);
        return new Response\VerifyCardResponse($soapResponse);
    }

    /**
     * @param SettleParameter $parameters
     * @return EncryptResponse
     */
    public function settle(Parameter\SettleParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callSettleS2S($parameters);
        return new Response\SettleResponse($soapResponse);
    }

    /**
     * @param RefundParameter $parameters
     * @return EncryptResponse
     */
    public function refund(Parameter\RefundParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callRefundS2S($parameters);
        return new Response\RefundResponse($soapResponse);
    }

    /**
     * @param DeleteParameter $parameters
     * @return EncryptResponse
     */
    public function delete(Parameter\DeleteParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callDeleteS2S($parameters);
        return new Response\DeleteResponse($soapResponse);
    }

    /**
     * @param RequestTokenParameter $parameters
     * @return RequestTokenResponse
     */
    public function requestToken(Parameter\RequestTokenParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callRequestTokenS2S($parameters);
        return new Response\RequestTokenResponse($soapResponse);
    }

}

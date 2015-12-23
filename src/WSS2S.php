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

use EndelWar\GestPayWS\Parameter\PagamParameter;
use EndelWar\GestPayWS\Parameter\CheckCardParameter;
use EndelWar\GestPayWS\Parameter\VerifyCardParameter;
use EndelWar\GestPayWS\Parameter\SettleParameter;
use EndelWar\GestPayWS\Parameter\RefundParameter;
use EndelWar\GestPayWS\Parameter\DeleteParameter;
use EndelWar\GestPayWS\Parameter\RequestTokenParameter;
use EndelWar\GestPayWS\Response\PagamResponse;
use EndelWar\GestPayWS\Response\CheckCardResponse;
use EndelWar\GestPayWS\Response\VerifyCardResponse;
use EndelWar\GestPayWS\Response\SettleResponse;
use EndelWar\GestPayWS\Response\RefundResponse;
use EndelWar\GestPayWS\Response\DeleteResponse;
use EndelWar\GestPayWS\Response\RequestTokenResponse;

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
    public function pagam(PagamParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callPagamS2S($parameters);
        return new PagamResponse($soapResponse);
    }

    /**
     * @param CheckCardParameter $parameters
     * @return EncryptResponse
     */
    public function checkCard(CheckCardParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callCheckCartaS2S($parameters);
        return new CheckCardResponse($soapResponse);
    }

    /**
     * @param VerifyCardParameter $parameters
     * @return EncryptResponse
     */
    public function verifyCard(VerifyCardParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callVerifyCardS2S($parameters);
        return new VerifyCardResponse($soapResponse);
    }

    /**
     * @param SettleParameter $parameters
     * @return EncryptResponse
     */
    public function settle(SettleParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callSettleS2S($parameters);
        return new SettleResponse($soapResponse);
    }

    /**
     * @param RefundParameter $parameters
     * @return EncryptResponse
     */
    public function refund(RefundParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callRefundS2S($parameters);
        return new RefundResponse($soapResponse);
    }

    /**
     * @param DeleteParameter $parameters
     * @return EncryptResponse
     */
    public function delete(DeleteParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callDeleteS2S($parameters);
        return new DeleteResponse($soapResponse);
    }

    /**
     * @param RequestTokenParameter $parameters
     * @return RequestTokenResponse
     */
    public function requestToken(RequestTokenParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->callRequestTokenS2S($parameters);
        return new RequestTokenResponse($soapResponse);
    }
}

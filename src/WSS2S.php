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
use EndelWar\GestPayWS\Parameter\RequestTokenParameter;
use EndelWar\GestPayWS\Response\PagamResponse;
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

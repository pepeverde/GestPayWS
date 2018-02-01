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

use EndelWar\GestPayWS\Parameter\DecryptParameter;
use EndelWar\GestPayWS\Parameter\EncryptParameter;
use EndelWar\GestPayWS\Response\DecryptResponse;
use EndelWar\GestPayWS\Response\EncryptResponse;

/**
 * Class WSCryptDecrypt
 * @package EndelWar\GestPayWS
 */
class WSCryptDecrypt extends Service
{
    /**
     * @param EncryptParameter $parameters
     * @return EncryptResponse
     */
    public function encrypt(EncryptParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->Encrypt($parameters);
        return new EncryptResponse($soapResponse);
    }

    /**
     * @param DecryptParameter $parameters
     * @return DecryptResponse
     */
    public function decrypt(DecryptParameter $parameters)
    {
        $this->validateParameters($parameters);
        $soapResponse = $this->soapClient->Decrypt($parameters);
        return new DecryptResponse($soapResponse);
    }
}

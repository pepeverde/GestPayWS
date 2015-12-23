<?php

/*
 * This file is part of the GestPayWS library.
 *
 * (c) Manuel Dalla Lana <endelwar@aregar.it>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EndelWar\GestPayWS\Response;

/**
 * Class VerifyCardResponse
 * @package EndelWar\GestPayWS\Response
 */
class VerifyCardResponse extends Response
{
    protected $parametersName = array(
      'TransactionType',
      'TransactionResult',
      'ErrorCode',
      'ErrorDescription',
      'Country',
      'Company',
    );

    /**
     * @param \stdClass $soapResponse
     * @throws \Exception
     */
    public function __construct($soapResponse)
    {
        $xml = simplexml_load_string($soapResponse->callVerifyCardS2SResult->any);
        parent::__construct($xml);
    }
}

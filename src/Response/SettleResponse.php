<?php

/*
 * This file is part of the GestPayWS library.
 *
 * (c) Cristian Pascottini <cristianp6@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EndelWar\GestPayWS\Response;

/**
 * Class SettleResponse
 * @package EndelWar\GestPayWS\Response
 */
class SettleResponse extends Response
{
    protected $parametersName = array(
      'TransactionType',
      'TransactionResult',
      'ErrorCode',
      'ErrorDescription',
      'ShopTransactionID',
      'BankTransactionID',
    );

    /**
     * @param \stdClass $soapResponse
     * @throws \Exception
     */
    public function __construct($soapResponse)
    {
        $xml = simplexml_load_string($soapResponse->callSettleS2SResult->any);
        parent::__construct($xml);
    }
}

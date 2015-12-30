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
 * Class PagamResponse
 * @package EndelWar\GestPayWS\Response
 */
class PagamResponse extends Response
{
    protected $paymentPageUrl = array(
        'test' => 'https://testecomm.sella.it/pagam/pagam.aspx',
        'production' => 'https://ecomm.sella.it/pagam/pagam.aspx',
    );
    protected $parametersName = array(
      'TransactionType',
      'TransactionResult',
      'ShopTransactionID',
      'BankTransactionID',
      'AuthorizationCode',
      'Currency',
      'Amount',
      'Country',
      'CardBIN',
      'Buyer',
      'CustomInfo',
      'TDLevel',
      'ErrorCode',
      'ErrorDescription',
      'AlertCode',
      'AlertDescription',
      'TransactionKey',
      'VbV',
      'RedResponseCode',
      'RedResponseDescription',
    );

    /**
     * @param \stdClass $soapResponse
     * @throws \Exception
     */
    public function __construct($soapResponse)
    {
        $xml = simplexml_load_string($soapResponse->callPagamS2SResult->any);
        parent::__construct($xml);
    }

    /**
     * @param string $shopLogin
     * @param string $wsdlEnvironment
     * @return string
     */
    public function getPaymentPageUrl($shopLogin, $wsdlEnvironment)
    {
        return $this->paymentPageUrl[$wsdlEnvironment] . '?a=' . $shopLogin . '&b=' . $this->CryptDecryptString;
    }
}

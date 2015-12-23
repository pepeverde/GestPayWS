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
 * Class CheckCartaResponse
 * @package EndelWar\GestPayWS\Response
 */
class CheckCartaResponse extends Response
{
    protected $parametersName = array(
      'TransactionType',
      'TransactionResult',
      'TransactionErrorCode',
      'TransactionErrorDescription',
      'AuthorizationErrorCode',
      'Authorizationresult',
      'AuthorizationCodeDescription',
      'CardCompany',
      'CardCompanyCode',
      'CeckCVV',
      'CeckCVVDescription',
      'IssuerCountry',
      'IssuerCountryCode',
      'CompanyDescription',
      'CompanyCode',
      'Commercial',
      'ProductDescription',
      'ProductType',
      'CheckDigit',
      'CheckDigitDescription',
      'CheckDate',
      'CheckDateDescription',
      'EnrolledCode',
      'EnrolledDescription',
      'Prepaid',
    );

    /**
     * @param \stdClass $soapResponse
     * @throws \Exception
     */
    public function __construct($soapResponse)
    {
        $xml = simplexml_load_string($soapResponse->callCheckCartaS2SResult->any);
        parent::__construct($xml);
    }
}

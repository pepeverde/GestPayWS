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
 * Class RequestTokenResponse
 * @package EndelWar\GestPayWS\Response
 */
class RequestTokenResponse extends Response
{
    protected $parametersName = array(
        'TransactionType',
        'TransactionResult',
        'TransactionErrorCode',
        'TransactionErrorDescription',
        'AuthorizationErrorCode',
        'AuthorizationResult',
        'AuthorizationCodeDescription',
        'CardCountry',
        'CardCountryCode',
        'CheckCVV',
        'CheckCVVDescription',
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
        'CardBIN',
        'Token',
        'TokenExpiryMonth',
        'TokenExpiryYear',
    );

    /**
     * @param \stdClass $soapResponse
     * @throws \Exception
     */
    public function __construct($soapResponse)
    {
        $xml = simplexml_load_string($soapResponse->CallRequestTokenS2SResult->any);
        parent::__construct($xml);
    }

    /**
     * @param string $shopLogin
     * @param string $wsdlEnvironment
     * @return string
     */
    public function getToken()
    {
        return $this->get('Token');
    }
}

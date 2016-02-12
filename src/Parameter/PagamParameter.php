<?php

/*
 * This file is part of the GestPayWS library.
 *
 * (c) Manuel Dalla Lana <endelwar@aregar.it>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EndelWar\GestPayWS\Parameter;

use InvalidArgumentException;

/**
 * Class PagamParameter
 * @package EndelWar\GestPayWS\Parameter
 *
 * @property string $shopLogin
 * @property string $uicCode;
 * @property string $amount;
 * @property string $shopTransactionId;
 * @property string $cardNumber;
 * @property int $expiryMonth;
 * @property int $expiryYear;
 * @property string $buyerName;
 * @property string $buyerEmail;
 * @property string $languageId;
 * @property int $cvv;
 * @property string $min;
 * @property string $transKey;
 * @property string $PARes;
 * @property string $customInfo;
 * @property string $IDEA;
 * @property string $requestToken;
 * @property string $tokenValue;
 * @property string $clientIP;
 * @property string $itemType;
 * @property string $shippingDetails;
 * @property string $redFraudPrevention;
 * @property string $Red_CustomerInfo;
 * @property string $Red_ShippingInfo;
 * @property string $Red_BillingInfo;
 * @property string $Red_CustomerData;
 * @property string $Red_CustomInfo;
 * @property string $Red_Items;
 */
class PagamParameter extends Parameter
{
    protected $parametersName = array(
      'shopLogin',
      'uicCode',
      'amount',
      'shopTransactionId',
      'cardNumber',
      'expiryMonth',
      'expiryYear',
      'buyerName',
      'buyerEmail',
      'languageId',
      'cvv',
      'min',
      'transKey',
      'PARes',
      'customInfo',
      'IDEA',
      'requestToken',
      'tokenValue',
      'clientIP',
      'itemType',
      'shippingDetails',
      'redFraudPrevention',
      'Red_CustomerInfo',
      'Red_ShippingInfo',
      'Red_BillingInfo',
      'Red_CustomerData',
      'Red_CustomInfo',
      'Red_Items',
    );
    protected $mandatoryParameters = array(
      'shopLogin',
      'uicCode',
      'amount',
      'shopTransactionId',
    );
    private $invalidChars = array(
        '&',
        ' ',
        '§', //need also to be added programmatically, because UTF-8
        '(',
        ')',
        '*',
        '<',
        '>',
        ',',
        ';',
        ':',
        '*P1*',
        '/',
        '[',
        ']',
        '?',
        '=',
        '--',
        '/*',
        '%',
        '//',
    );
    private $invalidCharsFlattened = '';

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = array())
    {
        $this->invalidChars[] = chr(167); //§ ascii char

        parent::__construct($parameters);
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        if (!in_array($key, $this->parametersName, true)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid parameter name.', $key));
        }
        $this->verifyParameterValidity($value);
        parent::set($key, $value);
    }

    /**
     * @param $value
     * @return bool
     */
    public function verifyParameterValidity($value)
    {
        if (strlen($this->invalidCharsFlattened) === 0) {
            $invalidCharsQuoted = array_map('preg_quote', $this->invalidChars);
            $this->invalidCharsFlattened = implode('|', $invalidCharsQuoted);
        }

        if (preg_match_all('#' . $this->invalidCharsFlattened . '#', $value, $matches)) {
            $invalidCharsMatched = '"' . implode('", "', $matches[0]) . '"';
            throw new InvalidArgumentException(
                'String ' . $value . ' contains invalid chars (i.e.: ' . $invalidCharsMatched . ').'
            );
        }

        return true;
    }
}

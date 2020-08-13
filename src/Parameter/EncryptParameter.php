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
 * Class EncryptParameter
 *
 * @property string $shopLogin
 * @property int $uicCode;
 * @property float $amount;
 * @property string $shopTransactionId;
 * @property string $apikey;
 * @property string $buyerName;
 * @property string $buyerEmail;
 * @property int $languageId;
 * @property string $customInfo;
 * @property string $requestToken;
 * @property string $ppSellerProtection;
 * @property string $shippingDetails;
 * @property string $paymentTypes;
 * @property string $paymentTypeDetail;
 */
class EncryptParameter extends Parameter
{
    protected $parametersName = [
        // Mandatory parameters
        'shopLogin',
        'uicCode',
        'amount',
        'shopTransactionId',
        // Optional parameters
        'apikey',
        'buyerName',
        'buyerEmail',
        'languageId',
        'customInfo',
        'requestToken',
        //'cardNumber', //deprecated
        //'expiryMonth', //deprecated
        //'expiryYear', //deprecated
        //'cvv', //deprecated

        /* to be implemented
        'OrderDetails',
        'ppSellerProtection',
        'shippingDetails',
        'paymentTypes',
        'paymentTypeDetail',
        'redFraudPrevention',
        'Red_CustomerInfo',
        'Red_ShippingInfo',
        'Red_BillingInfo',
        'Red_CustomerData',
        'Red_CustomInfo',
        'Red_Items',
        'Consel_MerchantPro',
        'Consel_CustomerInfo',
        'payPalBillingAgreementDescription'
        */
    ];
    protected $mandatoryParameters = [
        'shopLogin',
        'uicCode',
        'amount',
        'shopTransactionId',
    ];
    protected $separator = '*P1*';
    private $customInfoArray = [];

    /** @see https://api.gestpay.it/#encrypt */
    private $invalidChars = [
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
        '~',
    ];
    private $invalidCharsFlattened = '';

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
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
        if (! in_array($key, $this->parametersName, true)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid parameter name.', $key));
        }
        $this->verifyParameterValidity($value, $key);
        parent::set($key, $value);
    }

    /**
     * @param mixed $customInfo string already encoded or array of key/value to be encoded
     */
    public function setCustomInfo($customInfo)
    {
        if (! is_array($customInfo)) {
            $this->data['customInfo'] = $customInfo;
        } else {
            //check string validity

            foreach ($customInfo as $key => $value) {
                $value = urlencode($value);
                $this->verifyParameterValidity($key);
                $this->verifyParameterValidity($value, $key);

                if (strlen($value) > 300) {
                    $value = substr($value, 0, 300);
                }
                $customInfo[$key] = $value;
            }
            $this->customInfoArray = $customInfo;
            $this->data['customInfo'] = http_build_query($this->customInfoArray, '', $this->separator);
        }
    }

    /**
     * @return array
     */
    public function getCustomInfoToArray()
    {
        $allinfo = explode($this->separator, $this->customInfo);
        $customInfoArray = [];
        foreach ($allinfo as $singleInfo) {
            $tagvalue = explode('=', $singleInfo);
            $customInfoArray[$tagvalue[0]] = urldecode($tagvalue[1]);
        }

        return $customInfoArray;
    }

    /**
     * @param $value
     * @return bool
     */
    public function verifyParameterValidity($value, $key = null)
    {
        if ('' === $this->invalidCharsFlattened) {
            $invalidCharsQuoted = array_map('preg_quote', $this->invalidChars);
            $this->invalidCharsFlattened = implode('|', $invalidCharsQuoted);
        }

        $invalidCharsFlattened = $this->invalidCharsFlattened;

        if (strtolower($key) == 'apikey') {
            $invalidCharsFlattened = str_replace('|\=|', '|', $invalidCharsFlattened);
        }

        if (preg_match_all('#' . $invalidCharsFlattened . '#', $value, $matches)) {
            $invalidCharsMatched = '"' . implode('", "', $matches[0]) . '"';
            throw new InvalidArgumentException(
                'String ' . $value . ' contains invalid chars (i.e.: ' . $invalidCharsMatched . ').'
            );
        }

        return true;
    }
}

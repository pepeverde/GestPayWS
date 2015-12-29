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

class WSCryptDecryptSoapClient extends SoapClient
{
    /**
     * {@inheritdoc}
     */
    public static function getWsdlUrl($wsdlEnvironment)
    {
        $environments = array(
            'test'       => 'https://testecomm.sella.it/gestpay/GestPayWS/WsCryptDecrypt.asmx?wsdl',
            'production' => 'https://ecomms2s.sella.it/gestpay/GestPayWS/WsCryptDecrypt.asmx?wsdl',
        );
        return $environments[$wsdlEnvironment];
    }
}

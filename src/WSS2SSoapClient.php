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

class WSS2SSoapClient extends SoapClient
{
    /**
     * {@inheritdoc}
     */
    public static function getWsdlUrl($wsdlEnvironment)
    {
        $environments = array(
            'test' => 'https://testecomm.sella.it/gestpay/GestPayWS/WsS2S.asmx?wsdl',
            'production' => 'https://ecommS2S.sella.it/gestpay/GestPayWS/WsS2S.asmx?wsdl',
        );
        return $environments[$wsdlEnvironment];
    }
}

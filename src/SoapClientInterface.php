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

/**
 * Interface SoapClient
 * @package EndelWar\GestPayWS
 */
interface SoapClientInterface
{
    /**
     * Returns the WSDL Url of the client for the current environment.
     * @param string $wsdlEnvironment Either "test" or "production"
     * @return string
     */
    public static function getWsdlUrl($wsdlEnvironment);
}

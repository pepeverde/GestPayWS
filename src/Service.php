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

use EndelWar\GestPayWS\Parameter\Parameter;

/**
 * Class Service
 * @package EndelWar\GestPayWS
 */
abstract class Service
{
    protected $soapClient;

    /**
     * @param \SoapClient $soapClient
     */
    public function __construct(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    /**
     * @param EndelWar\GestPayWS\Parameter $parameters
     */
    protected function validateParameters(Parameter $parameters)
    {
      if (!$parameters->areAllMandatoryParametersSet()) {
          throw new \InvalidArgumentException('Missing parameter');
      }
    }
}

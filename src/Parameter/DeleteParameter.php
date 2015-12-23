<?php

/*
 * This file is part of the GestPayWS library.
 *
 * (c) Cristian Pascottini <cristianp6@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EndelWar\GestPayWS\Parameter;

use InvalidArgumentException;

/**
 * Class DeleteParameter
 * @package EndelWar\GestPayWS\Parameter
 *
 * @property string $shopLogin
 * @property string $shopTransactionId;
 * @property string $bankTransactionId;
 * @property string $requestToken;
 * @property string $tokenValue;
 */
class DeleteParameter extends Parameter
{
    protected $parametersName = array(
      'shopLogin',
      'shopTransactionId',
      'bankTransactionId',
      'requestToken',
      'tokenValue',
    );
    protected $mandatoryParameters = array(
      'shopLogin',
      'shopTransactionId',
      'bankTransactionId',
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

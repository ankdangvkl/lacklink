<?php

namespace App\Http\common\Constant;

/**
 * Operator character for sql query, concat string.
 */
class OperatorCharacter
{
  const SPLASH = '/'
        ,EQUAL = '='
        ,SPACE = ' '
        ,NOT_EQUAL_SQL = '<>'
        ,SINGLE_QUOTE = "'"
        ,BEGIN_BLOCK = '{'
        ,END_BLOCK = '}'
        ,EMPTY_BLOCK = '{}'
        ,DOUBLE_QUOTE = '"'
        ,EMPTY_STRING = '';
}

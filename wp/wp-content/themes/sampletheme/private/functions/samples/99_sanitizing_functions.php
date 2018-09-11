<?php

/**
 * エンコード.
 *
 * @param unknown_type $str
 */
function xss($str = null)
{
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

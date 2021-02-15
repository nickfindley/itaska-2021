<?php
function string_to_uc( $str )
{
    $str = strtolower( $str );
    $str = ucwords( $str );
    return $str;
}
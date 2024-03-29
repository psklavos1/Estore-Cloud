<?php

function headersParseArray($str)
{
    $headers = array();
    // break the string of data into an array with all the
    // headers separated by the "\r\n" delimeter
    $headersTmpArray = explode( "\r\n" , $str );
    for ( $i = 0 ; $i < count( $headersTmpArray ) ; ++$i )
    {
        // we dont care about the two \r\n lines at the end of the headers
        if ( strlen( $headersTmpArray[$i] ) > 0 )
        {
            // the headers start with HTTP status codes, which do not contain a colon so we can filter them out too
            if ( strpos( $headersTmpArray[$i] , ": " ) )
            {
                $headerName = substr( $headersTmpArray[$i] , 0 , strpos( $headersTmpArray[$i] , ": " ) );
                $headerValue = substr( $headersTmpArray[$i] , strpos( $headersTmpArray[$i] , ": " )+1 ); // after ':' to the end
                $headers[$headerName] = $headerValue;
            }
        }
    }
    return $headers;
}


?>
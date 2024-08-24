<?php

namespace App\Helpers;

use Tuupola\Base62;

class UrlHelper
{
    /**
     * Encode integer in base62.
     * 
     * @param int $number
     * @return string
     */
    public static function encodeInteger(int $number): string
    {
        $base62 = new Base62;
        return $base62->encodeInteger($number);
    }


    /**
     * Check if url is valid. If invalid make it valid.
     * 
     * 
     * @param string $url
     * @throws \InvalidArgumentException
     * @return string
     */
    function ensureValidUrl(string $url): string
    {
        // Check if the URL already has a scheme
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            // Prepend 'https://' if no scheme is found
            $url = 'https://' . $url;
        }

        // Validate the URL
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        } else {
            // Handle invalid URL (optional)
            throw new \InvalidArgumentException('Invalid URL');
        }
    }
}

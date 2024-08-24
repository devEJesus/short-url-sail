<?php

namespace App\Services;

use App\Helpers\UrlHelper;
use App\Models\Url;

class UrlService
{
    protected $urlHelper;

    public function __construct(UrlHelper $urlHelper)
    {
        $this->urlHelper = $urlHelper;
    }

    /**
     * Save a new url line 
     * 
     * @param string $longUrl
     * @param int $idUser
     * @return void
     */
    public function save(string $longUrl, int $idUser): void
    {
        // Create a new Url instance
        $url = new Url;
        $url->id_user = $idUser;
        $url->long_url = $this->urlHelper->ensureValidUrl($longUrl);

        // Save the url object first to generate the primary key
        $url->save();

        // Now the id_url (or id) is available
        $url->short_url = $this->urlHelper->encodeInteger($url->id_url);

        // Update the url object with the short_url
        $url->save();
    }
}

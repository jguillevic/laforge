<?php

namespace Model\Store\Social;

/**
 * @author JGuillevic
 */
class Social
{
    private $id;
    private $facebookLink;
    private $twitterLink;
    private $youtubeLink;
    private $instagramLink;

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetFacebookLink()
    {
        return $this->facebookLink;
    }

    public function SetFacebookLink($facebookLink)
    {
        $this->facebookLink = $facebookLink;
    }

    public function GetTwitterLink()
    {
        return $this->twitterLink;
    }

    public function SetTwitterLink($twitterLink)
    {
        $this->twitterLink = $twitterLink;
    }

    public function GetYoutubeLink()
    {
        return $this->youtubeLink;
    }

    public function SetYoutubeLink($youtubeLink)
    {
        $this->youtubeLink = $youtubeLink;
    }

    public function GetInstagramLink()
    {
        return $this->instagramLink;
    }

    public function SetInstagramLink($instagramLink)
    {
        $this->instagramLink = $instagramLink;
    }
}
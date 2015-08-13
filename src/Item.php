<?php

namespace Tackk\Cartographer;

class Item
{
    protected $url;
    protected $lastmod;
    protected $changefreq = ChangeFrequency::DAILY;
    protected $priority = 1.0;
    protected $alternateMediaLinks = array();

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function addAlternateMediaLink($media, $href)
    {
        $this->alternateMediaLinks[$media] = $href;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getLastmod()
    {
        if ($this->lastmod === null) {
            $this->lastmod = new \DateTime();
        }
        return $this->lastmod;
    }

    public function getChangefreq()
    {
        return $this->changefreq;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setLastmod($lastmod)
    {
        $this->lastmod = $lastmod;
    }

    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getAlternateMediaLinks()
    {
        return $this->alternateMediaLinks;
    }
}

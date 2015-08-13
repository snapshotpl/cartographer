<?php

namespace Tackk\Cartographer;

class Sitemap extends AbstractSitemap
{
    protected function getRootNodeName()
    {
        return 'urlset';
    }

    protected function getNodeName()
    {
        return 'url';
    }

    /**
     * Adds the URL to the urlset.
     * @param  string     $loc
     * @param  string|int $lastmod
     * @param  string     $changefreq
     * @param  float      $priority
     * @return $this
     */
    public function add($loc, $lastmod = null, $changefreq = null, $priority = null)
    {
        $loc     = $this->escapeString($loc);
        $lastmod = !is_null($lastmod) ? $this->formatDate($lastmod) : null;

        return $this->addUrlToDocument(compact('loc', 'lastmod', 'changefreq', 'priority'));
    }

    public function addItem(Item $item)
    {
        $loc = $item->getUrl();
        $lastmod = $item->getLastmod();
        $changefreq = $item->getChangefreq();
        $priority = $item->getPriority();
        $alternateLinks = $item->getAlternateMediaLinks();

        $this->add($loc, $lastmod, $changefreq, $priority);

        $this->addAlternateMediaLinks($alternateLinks);
    }

    protected function addAlternateMediaLinks(array $links)
    {
        if (empty($links)) {
            return;
        }

        $elements = $this->rootNode->getElementsByTagName($this->getNodeName());

        $lastElement = $elements->item($elements->length - 1);

        foreach ($links as $media => $link) {
            $alternateNode = $this->document->createElementNS('http://www.w3.org/1999/xhtml', 'xhtml:link');
            $alternateNode->setAttribute('rel', 'alternate');
            $alternateNode->setAttribute('media', $media);
            $alternateNode->setAttribute('href', $link);

            $lastElement->appendChild($alternateNode);
        }
    }
}

<?php
namespace WuifDesign\SEO;

class OpenGraph extends SEOElement
{
    protected $configName = 'opengraph';

    /**
     * @var string
     */
    protected $ogPrefix = 'og:';

    /**
     * @var array
     */
    protected $images = [];

    /**
     * Set default values
     */
    protected function setDefault()
    {
        parent::setDefault();
        $this->images = $this->config['tags']['images'];
    }

    /**
     * Get a string of a property
     *
     * @param $key
     * @param $value
     * @param $name
     *
     * @return string
     */
    protected function getProperty($key, $value, $name = 'property')
    {
        if($key == 'images') {
            $return = array();
            foreach($this->images as $image) {
                $return[] = $this->getProperty('image', $image, $name);
            }
            return implode(PHP_EOL, $return);
        }
        if(empty($value)) {
            return null;
        }
        return '<meta property="'.$this->ogPrefix.$key.'" content="'.$value.'">';
    }

    /**
     * Set the url property.
     *
     * @param string $url
     *
     * @return OpenGraph
     */
    public function setUrl($url)
    {
        return $this->addProperty('url', $url);
    }

    /**
     * Set the site_name property
     *
     * @param string $name
     *
     * @return OpenGraph
     */
    public function setSiteName($name)
    {
        return $this->addProperty('site_name', $name);
    }

    /**
     * Add an image to properties
     *
     * @param string $url
     *
     * @return OpenGraph
     */
    public function addImage($url)
    {
        $this->images[] = $url;
        return $this;
    }
}
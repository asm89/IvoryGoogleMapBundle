<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Ground overlay which describes a google map ground overlay
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlay
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlay extends AbstractAsset
{
    /**
     * @var string Group Overlay image url
     */
    protected $url = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Bound Ground overlay bound
     */
    protected $bound = null;

    /**
     * @var array Ground overlay options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlayOptions
     */
    protected $options = array();

    /**
     * Create a ground overlay
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('ground_overlay_');
        
        $this->bound = new Bound();
        $this->bound->setNorthEast(new Coordinate(-1, -1));
        $this->bound->setSouthWest(new Coordinate(1, 1));
    }

    /**
     * Gets the ground overlay image url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the ground overlay image url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets the ground overlay bound
     *
     * @return Ivory\GoogleMapBundle\Model\Bound
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the ground overlay bound
     *
     * Available prototype:
     * 
     * public function setBound(Ivory\GoogleMapBundle\Model\Bound $bound)
     * public function setBount(Ivory\GoogleMapBundle\Model\Coordinate $southWest, Ivory\GoogleMapBundle\Model\Coordinate $northEast)
     * public function setBound(integer $southWestLatitude, integer $southWestLongitude, integer $northEastLatitude, integer $northEastLongitude, boolean southWestNoWrap = true, boolean $northEastNoWrap = true)
     */
    public function setBound()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && ($args[0] instanceof Bound))
            $this->bound = $args[0];
        else if(isset($args[0]) && ($args[0] instanceof Coordinate) && isset($args[1]) && ($args[1] instanceof Coordinate))
        {
            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        }
        else if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]) && isset($args[2]) && is_int($args[2]) && isset($args[3]) && is_int($args[3]))
        {
            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));
            
            if(isset($args[4]) && is_bool($args[4]))
            {
                $this->bound->getSouthWest()->setNoWrap($args[4]);
                
                if(isset($args[5]) && is_bool($args[5]))
                    $this->bound->getNorthEast()->setNoWrap($args[5]);
            }
        }
        else
            throw new \InvalidArgumentException();
    }

    /**
     * Gets the ground overlay options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the ground overlay options
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge(
            $this->options,
            $options
        );
    }

    /**
     * Get a specific ground overlay option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a specific ground overlay option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
}

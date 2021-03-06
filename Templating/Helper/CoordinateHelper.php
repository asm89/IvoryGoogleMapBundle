<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Coordinate;

/**
 * Coordinate helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateHelper
{
    /**
     * Renders the coordinate
     *
     * @param Ivory\GoogleMapBundle\Model\Coordinate $coordinate
     * @return string HTML output
     */
    public function render(Coordinate $coordinate)
    {
        return sprintf('new google.maps.LatLng(%s, %s, %s)',
            $coordinate->getLatitude(),
            $coordinate->getLongitude(),
            $coordinate->isNoWrap()
        );
    }
}

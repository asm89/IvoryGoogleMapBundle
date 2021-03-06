<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Ivory\GoogleMapBundle\Model\InfoWindow;
use Ivory\GoogleMapBundle\Model\Marker;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Info window helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowHelper
{   
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper
     */
    protected $coordinateHelper = null;

    /**
     * Create an info window helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders the info window
     *
     * @param Ivory\GoogleMapBundle\Model\InfoWindow $infoWindow
     * @param boolean $renderPosition TRUE if the position is rendered else FALSE
     * @return string HTML output
     */
    public function render(InfoWindow $infoWindow, $renderPosition = true)
    {
        if($renderPosition)
            $infoWindowJSONOptions = sprintf('{"position":%s,',
                $this->coordinateHelper->render($infoWindow->getPosition())
            );
        else
            $infoWindowJSONOptions = '{';
        
        $infoWindowOptions = array_merge(
            array('content' => $infoWindow->getContent()),
            $infoWindow->getOptions()
        );

        $infoWindowJSONOptions .= substr(json_encode($infoWindowOptions), 1);

        return sprintf('var %s = new google.maps.InfoWindow(%s);'.PHP_EOL,
            $infoWindow->getJavascriptVariable(),
            $infoWindowJSONOptions
        );
    }

    /**
     * Renders the info window open
     *
     * @param Ivory\GoogleMapBundle\Model\InfoWindow $infoWindow
     * @param Ivory\GoogleMapBundle\Model\Marker $marker
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderOpen(InfoWindow $infoWindow, Map $map, Marker $marker = null)
    {
        if($marker !== null)
            return sprintf('%s.open(%s, %s);'.PHP_EOL,
                $infoWindow->getJavascriptVariable(),
                $map->getJavascriptVariable(),
                $marker->getJavascriptVariable()
            );
        else
            return sprintf('%s.open(%s);'.PHP_EOL,
                $infoWindow->getJavascriptVariable(),
                $map->getJavascriptVariable()
            );
    }
}

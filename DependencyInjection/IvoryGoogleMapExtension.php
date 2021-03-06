<?php

namespace Ivory\GoogleMapBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Ivory google map extension
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IvoryGoogleMapExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);
        
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        foreach(array('services.xml') as $file)
            $loader->load($file);

        $this->loadMap($config, $container);
        $this->loadCoordinate($config, $container);
        $this->loadMarker($config, $container);
        $this->loadBound($config, $container);
        $this->loadInfoWindow($config, $container);
        $this->loadPolyline($config, $container);
        $this->loadPolygon($config, $container);
        $this->loadRectangle($config, $container);
        $this->loadCircle($config, $container);
        $this->loadGroundOverlay($config, $container);
        $this->loadPoint($config, $container);
        $this->loadSize($config, $container);
        $this->loadMarkerImage($config, $container);
        $this->loadMarkerShape($config, $container);
        $this->loadEventManager($config, $container);
        $this->loadEvent($config, $container);

        if($config['twig']['enabled'])
            $loader->load('twig.xml');
    }
    
    /**
     * Loads map configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadMap(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.map.class', $config['map']['class']);
        $container->setParameter('ivory_google_map.map.helper', $config['map']['helper']);
        $container->setParameter('ivory_google_map.map.prefix_javascript_variable', $config['map']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.map.html_container', $config['map']['html_container']);
        $container->setParameter('ivory_google_map.map.auto_zoom', $config['map']['auto_zoom']);
        $container->setParameter('ivory_google_map.map.center.longitude', $config['map']['center']['longitude']);
        $container->setParameter('ivory_google_map.map.center.latitude', $config['map']['center']['latitude']);
        $container->setParameter('ivory_google_map.map.center.no_wrap', $config['map']['center']['no_wrap']);
        $container->setParameter('ivory_google_map.map.type', $config['map']['type']);
        $container->setParameter('ivory_google_map.map.zoom', $config['map']['zoom']);
        $container->setParameter('ivory_google_map.map.width', $config['map']['width']);
        $container->setParameter('ivory_google_map.map.height', $config['map']['height']);
        $container->setParameter('ivory_google_map.map.map_options', $config['map']['map_options']);
        $container->setParameter('ivory_google_map.map.stylesheet_options', $config['map']['stylesheet_options']);
    }
    
    /**
     * Loads coordinate configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadCoordinate(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.coordinate.class', $config['coordinate']['class']);
        $container->setParameter('ivory_google_map.coordinate.helper', $config['coordinate']['helper']);
        $container->setParameter('ivory_google_map.coordinate.latitude', $config['coordinate']['latitude']);
        $container->setParameter('ivory_google_map.coordinate.longitude', $config['coordinate']['longitude']);
        $container->setParameter('ivory_google_map.coordinate.no_wrap', $config['coordinate']['no_wrap']);
    }
    
    /**
     * Loads marker configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadMarker(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.marker.class', $config['marker']['class']);
        $container->setParameter('ivory_google_map.marker.helper', $config['marker']['helper']);
        $container->setParameter('ivory_google_map.marker.prefix_javascript_variable', $config['marker']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.marker.position.latitude', $config['marker']['position']['latitude']);
        $container->setParameter('ivory_google_map.marker.position.longitude', $config['marker']['position']['longitude']);
        $container->setParameter('ivory_google_map.marker.position.no_wrap', $config['marker']['position']['no_wrap']);
        $container->setParameter('ivory_google_map.marker.options', $config['marker']['options']);
    }
    
    /**
     * Loads bound configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadBound(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.bound.class', $config['bound']['class']);
        $container->setParameter('ivory_google_map.bound.helper', $config['bound']['helper']);
        $container->setParameter('ivory_google_map.bound.prefix_javascript_variable', $config['bound']['prefix_javascript_variable']);
    }
    
    /**
     * Loads info window configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadInfoWindow(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.info_window.class', $config['info_window']['class']);
        $container->setParameter('ivory_google_map.info_window.helper', $config['info_window']['helper']);
        $container->setParameter('ivory_google_map.info_window.prefix_javascript_variable', $config['info_window']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.info_window.position.latitude', $config['info_window']['position']['latitude']);
        $container->setParameter('ivory_google_map.info_window.position.longitude', $config['info_window']['position']['longitude']);
        $container->setParameter('ivory_google_map.info_window.position.no_wrap', $config['info_window']['position']['no_wrap']);
        $container->setParameter('ivory_google_map.info_window.content', $config['info_window']['content']);
        $container->setParameter('ivory_google_map.info_window.options', $config['info_window']['options']);
        $container->setParameter('ivory_google_map.info_window.open', $config['info_window']['open']);
    }
    
    /**
     * Loads polyline configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadPolyline(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.polyline.class', $config['polyline']['class']);
        $container->setParameter('ivory_google_map.polyline.helper', $config['polyline']['helper']);
        $container->setParameter('ivory_google_map.polyline.prefix_javascript_variable', $config['polyline']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.polyline.options', $config['polyline']['options']);
    }
    
    /**
     * Loads polygon configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadPolygon(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.polygon.class', $config['polygon']['class']);
        $container->setParameter('ivory_google_map.polygon.helper', $config['polygon']['helper']);
        $container->setParameter('ivory_google_map.polygon.prefix_javascript_variable', $config['polygon']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.polygon.options', $config['polygon']['options']);
    }
    
    /**
     * Loads rectangle configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadRectangle(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.rectangle.class', $config['rectangle']['class']);
        $container->setParameter('ivory_google_map.rectangle.helper', $config['rectangle']['helper']);
        $container->setParameter('ivory_google_map.rectangle.prefix_javascript_variable', $config['rectangle']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.rectangle.bound.south_west.latitude', $config['rectangle']['bound']['south_west']['latitude']);
        $container->setParameter('ivory_google_map.rectangle.bound.south_west.longitude', $config['rectangle']['bound']['south_west']['longitude']);
        $container->setParameter('ivory_google_map.rectangle.bound.south_west.no_wrap', $config['rectangle']['bound']['south_west']['no_wrap']);
        $container->setParameter('ivory_google_map.rectangle.bound.north_east.latitude', $config['rectangle']['bound']['north_east']['latitude']);
        $container->setParameter('ivory_google_map.rectangle.bound.north_east.longitude', $config['rectangle']['bound']['north_east']['longitude']);
        $container->setParameter('ivory_google_map.rectangle.bound.north_east.no_wrap', $config['rectangle']['bound']['north_east']['no_wrap']);
        $container->setParameter('ivory_google_map.rectangle.options', $config['rectangle']['options']);
    }
    
    /**
     * Loads circle configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadCircle(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.circle.class', $config['circle']['class']);
        $container->setParameter('ivory_google_map.circle.helper', $config['circle']['helper']);
        $container->setParameter('ivory_google_map.circle.prefix_javascript_variable', $config['circle']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.circle.center.longitude', $config['circle']['center']['longitude']);
        $container->setParameter('ivory_google_map.circle.center.latitude', $config['circle']['center']['latitude']);
        $container->setParameter('ivory_google_map.circle.center.no_wrap', $config['circle']['center']['no_wrap']);
        $container->setParameter('ivory_google_map.circle.radius', $config['circle']['radius']);
        $container->setParameter('ivory_google_map.circle.options', $config['circle']['options']);
    }
    
    /**
     * Loads ground overlay configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadGroundOverlay(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.ground_overlay.class', $config['ground_overlay']['class']);
        $container->setParameter('ivory_google_map.ground_overlay.helper', $config['ground_overlay']['helper']);
        $container->setParameter('ivory_google_map.ground_overlay.prefix_javascript_variable', $config['ground_overlay']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.ground_overlay.bound.south_west.latitude', $config['ground_overlay']['bound']['south_west']['latitude']);
        $container->setParameter('ivory_google_map.ground_overlay.bound.south_west.longitude', $config['ground_overlay']['bound']['south_west']['longitude']);
        $container->setParameter('ivory_google_map.ground_overlay.bound.south_west.no_wrap', $config['ground_overlay']['bound']['south_west']['no_wrap']);
        $container->setParameter('ivory_google_map.ground_overlay.bound.north_east.latitude', $config['ground_overlay']['bound']['north_east']['latitude']);
        $container->setParameter('ivory_google_map.ground_overlay.bound.north_east.longitude', $config['ground_overlay']['bound']['north_east']['longitude']);
        $container->setParameter('ivory_google_map.ground_overlay.bound.north_east.no_wrap', $config['ground_overlay']['bound']['north_east']['no_wrap']);
        $container->setParameter('ivory_google_map.ground_overlay.options', $config['ground_overlay']['options']);
    }
    
    /**
     * Loads point configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadPoint(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.point.class', $config['point']['class']);
        $container->setParameter('ivory_google_map.point.helper', $config['point']['helper']);
        $container->setParameter('ivory_google_map.point.x', $config['point']['x']);
        $container->setParameter('ivory_google_map.point.y', $config['point']['y']);
    }
    
    /**
     * Loads size configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadSize(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.size.class', $config['size']['class']);
        $container->setParameter('ivory_google_map.size.helper', $config['size']['helper']);
        $container->setParameter('ivory_google_map.size.width', $config['size']['width']);
        $container->setParameter('ivory_google_map.size.height', $config['size']['height']);
        $container->setParameter('ivory_google_map.size.width_unit', $config['size']['width_unit']);
        $container->setParameter('ivory_google_map.size.height_unit', $config['size']['height_unit']);
    }
    
    /**
     * Loads marker image configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadMarkerImage(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.marker_image.class', $config['marker_image']['class']);
        $container->setParameter('ivory_google_map.marker_image.helper', $config['marker_image']['helper']);
        $container->setParameter('ivory_google_map.marker_image.prefix_javascript_variable', $config['marker_image']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.marker_image.url', $config['marker_image']['url']);
    }
    
    /**
     * Loads marker shape configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadMarkerShape(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.marker_shape.class', $config['marker_shape']['class']);
        $container->setParameter('ivory_google_map.marker_shape.helper', $config['marker_shape']['helper']);
        $container->setParameter('ivory_google_map.marker_shape.prefix_javascript_variable', $config['marker_shape']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.marker_shape.type', $config['marker_shape']['type']);
    }
    
    /**
     * Loads event manager configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadEventManager(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.event_manager.class', $config['event_manager']['class']);
    }
    
    /**
     * Loads event configuration
     *
     * @param array $config
     * @param ContainerBuilder $container 
     */
    protected function loadEvent(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ivory_google_map.event.helper', $config['event']['helper']);
        $container->setParameter('ivory_google_map.event.class', $config['event']['class']);
        $container->setParameter('ivory_google_map.event.prefix_javascript_variable', $config['event']['prefix_javascript_variable']);
    }
}

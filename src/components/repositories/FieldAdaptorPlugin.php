<?php
namespace extas\components\repositories;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;

/**
 * Class FieldAdaptor
 *
 * @package extas\components\repositories
 * @author jeyroik@gmail.com
 */
abstract class FieldAdaptorPlugin extends Plugin
{
    /**
     * @param IItem $item
     */
    public function __invoke(IItem &$item)
    {
        $fields = $item->__toArray();
        $markers = $this->getMarkers();

        foreach ($markers as $dispatcher) {
            foreach ($fields as $name => &$value) {
                $item[$name] = $value = $dispatcher($value);
            }
        }
    }

    /**
     * @return array
     */
    abstract protected function getMarkers();
}

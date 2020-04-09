<?php
namespace extas\components\repositories;

use extas\components\TIsApplicableArray;
use extas\interfaces\repositories\IFieldAdaptor;

/**
 * Class FieldAdaptor
 *
 * @package extas\components\repositories
 * @author jeyroik@gmail.com
 */
abstract class FieldAdaptor implements IFieldAdaptor
{
    use TIsApplicableArray;

    public function __invoke($value)
    {
        return $this->applyToArray($value);
    }
}

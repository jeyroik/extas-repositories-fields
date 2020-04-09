<?php
namespace extas\interfaces\repositories;

/**
 * Interface IFieldAdaptor
 *
 * @package extas\interfaces\repositories
 * @author jeyroik@gmail.com
 */
interface IFieldAdaptor
{
    /**
     * @param string $value
     * @return string|mixed
     */
    public function apply(string $value);

    /**
     * @param string $value
     * @return bool
     */
    public function isApplicable(string $value): bool;

    /**
     * @param mixed $value
     * @return mixed
     */
    public function __invoke($value);
}

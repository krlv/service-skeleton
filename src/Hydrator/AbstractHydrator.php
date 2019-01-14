<?php

declare(strict_types=1);

namespace Skeleton\Hydrator;

abstract class AbstractHydrator implements HydratorInterface
{
    /**
     * @param object $entity
     * @param string $property
     * @param mixed  $value
     *
     * @return $this
     */
    protected function setPrivateProperty(object $entity, string $property, $value): self
    {
        \Closure::bind(static function ($entity, $value) use ($property): void {
            $entity->$property = $value;
        }, null, $entity)->__invoke($entity, $value);

        return $this;
    }
}
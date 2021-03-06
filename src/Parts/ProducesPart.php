<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Swagger\Parts;

/**
 * @internal
 */
trait ProducesPart
{
    private $produces = [];

    private function mergeProduces(array $data, $overwrite)
    {
        foreach ($data['produces'] ?? [] as $produce) {
            $this->produces[$produce] = true;
        }
    }

    /**
     * Return produces.
     *
     * @return array
     */
    public function getProduces()
    {
        return array_keys($this->produces);
    }
}

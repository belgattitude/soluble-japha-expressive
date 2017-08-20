<?php

declare(strict_types=1);

namespace Soluble\Japha\Expressive;

use Soluble\Japha\Bridge\Adapter as BridgeAdapter;

class ConfigProvider
{
    /**
     * Configuration key.
     *
     * @var string
     */
    public const CONFIG_PREFIX = 'soluble-japha-expressive';

    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                BridgeAdapter::class     => JaphaAdapterFactory::class,
            ]
        ];
    }
}

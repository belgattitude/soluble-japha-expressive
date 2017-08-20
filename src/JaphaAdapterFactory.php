<?php

declare(strict_types=1);

namespace Soluble\Japha\Expressive;

use Psr\Container\ContainerInterface;
use Soluble\Japha\Bridge\Adapter as BridgeAdapter;
use Soluble\Japha\Expressive\Exception\ConfigException;

class JaphaAdapterFactory
{
    const CONFIG_KEY = 'adapter';

    /**
     * @throws ConfigException
     */
    public function __invoke(ContainerInterface $container): BridgeAdapter
    {
        $config = $container->has('config') ? $container->get('config') : [];

        $options = $config[ConfigProvider::CONFIG_PREFIX][self::CONFIG_KEY] ?? null;

        if (!is_array($options)) {
            throw new ConfigException(
                sprintf(
                    "Missing or invalid entry ['%s']['%s'] in container configuration.",
                    ConfigProvider::CONFIG_PREFIX,
                    self::CONFIG_KEY
            )
            );
        }

        $servlet_address = $options['servlet_address'] ?? null;
        if ($servlet_address === null) {
            throw new ConfigException(sprintf(
                "Missing 'servlet_address in config (['%s']['%s']['%s'])",
                ConfigProvider::CONFIG_PREFIX,
                self::CONFIG_KEY,
                'servlet_address'
            ));
        }

        return new BridgeAdapter($options);
    }
}

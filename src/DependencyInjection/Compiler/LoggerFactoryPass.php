<?php

namespace Asmodine\CommonBundle\DependencyInjection\Compiler;

use Asmodine\CommonBundle\Service\LoggerFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class LoggerFactoryPass.
 */
class LoggerFactoryPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(LoggerFactory::class) || !$container->hasDefinition('monolog.logger')) {
            return;
        }

        $definition = $container->findDefinition(LoggerFactory::class);
        foreach ($container->getParameter('monolog.additional_channels') as $channel) {
            $loggerId = sprintf('monolog.logger.%s', $channel);
            $definition->addMethodCall('addChannel', [
                $channel,
                new Reference($loggerId),
            ]);
        }
    }
}

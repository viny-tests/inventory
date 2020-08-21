<?php

namespace App\Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use function dirname;
use function is_file;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private string $resourcePath;

    public function __construct(string $environment, bool $debug)
    {
        $this->resourcePath = dirname(__DIR__, 3);

        parent::__construct($environment, $debug);
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import($this->resourcePath . '/config/{packages}/*.yaml');
        $container->import($this->resourcePath . '/config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file($this->resourcePath . '/config/services.yaml')) {
            $container->import($this->resourcePath . '/config/{services}.yaml');
            $container->import($this->resourcePath . '/config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = $this->resourcePath . '/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import($this->resourcePath . '/config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import($this->resourcePath . '/config/{routes}/*.yaml');

        if (is_file($this->resourcePath . '/config/routes.yaml')) {
            $routes->import($this->resourcePath . '/config/{routes}.yaml');
        } elseif (is_file($path = \dirname(__DIR__).$this->resourcePath . '/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}

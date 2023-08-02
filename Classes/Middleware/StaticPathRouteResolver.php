<?php

declare(strict_types=1);

namespace Jpmschuler\StaticPathRouteResolver\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\LinkHandling\LinkService;
use TYPO3\CMS\Core\Routing\InvalidRouteArgumentsException;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Type\File\FileInfo;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class StaticPathRouteResolver implements MiddlewareInterface
{
    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var LinkService
     */
    protected $linkService;

    public function __construct(
        RequestFactory $requestFactory,
        LinkService $linkService
    ) {
        $this->requestFactory = $requestFactory;
        $this->linkService = $linkService;
    }

    /**
     * Checks if there is a valid site with route configuration.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $site = $request->getAttribute('site', null);
        if ($site instanceof Site) {
            $configuration = $site->getConfiguration()['routes'] ?? null;
            if ($configuration) {
                $path = ltrim($request->getUri()->getPath(), '/');
                $routeConfig = $this->getApplicableStaticRoute($configuration, $site, $path);
                if (is_array($routeConfig)) {
                    try {
                        [$content, $contentType] = $this->resolve($request, $site, $routeConfig);
                    } catch (InvalidRouteArgumentsException $e) {
                        return new Response('Invalid route', 404, ['Content-Type' => 'text/plain']);
                    }

                    return new HtmlResponse($content, 200, ['Content-Type' => $contentType]);
                }
            }
        }
        return $handler->handle($request);
    }

    /**
     * Find the proper configuration for the static route in the static route configuration. Mainly:
     * - needs to have a valid "route" property
     * - needs to have a "path"
     *
     * @param array $staticRouteConfiguration the "routes" part of the site configuration
     * @param Site $site the current site where the configuration is based on
     * @param string $uriPath the path of the current request - used to match the "route" value of a single static route
     * @return array|null the configuration for the static route that matches, or null if no route is given
     */
    protected function getApplicableStaticRoute(array $staticRouteConfiguration, Site $site, string $uriPath): ?array
    {
        $routeNames = array_map(static function (?string $route) use ($site) {
            if ($route === null || $route === '') {
                return null;
            }
            return ltrim(trim($site->getBase()->getPath(), '/') . '/' . ltrim($route, '/'), '/');
        }, array_column($staticRouteConfiguration, 'route'));
        // Remove empty routes which would throw an error (could happen within creating a false route in the GUI)
        $routeNames = array_filter($routeNames);

        if (in_array($uriPath, $routeNames, true)) {
            $key = array_search($uriPath, $routeNames, true);
            // Only allow routes with a type "given"
            if (isset($staticRouteConfiguration[$key]['path'])) {
                return $staticRouteConfiguration[$key];
            }
        }
        return null;
    }

    protected function getFromFile(string $filenameWithExtPrefix): array
    {
        $file = ExtensionManagementUtility::resolvePackagePath($filenameWithExtPrefix);
        $content = file_get_contents($file);
        $fileInfo = new FileInfo($file);
        $contentType = $fileInfo->getMimeType();

        return [$content, $contentType];
    }

    /**
     * @throws InvalidRouteArgumentsException
     */
    protected function resolve(ServerRequestInterface $request, Site $site, array $routeConfig): array
    {
        [$content, $contentType] = $this->getFromFile($routeConfig['path']);
        return [$content, $contentType];
    }
}

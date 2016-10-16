<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SwaggerController.
 */
class SwaggerController
{
    /**
     * @Route("/api-docs")
     */
    public function apiDocsAction()
    {
        $path = __DIR__.'/../../../contract.json';
        $contents = file_get_contents($path);

        return new Response($contents, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/documentation")
     * @Route("/documentation/")
     * @Route("/documentation/index.html")
     * @Template("swagger-ui/index.html.twig")
     */
    public function docsUiAction()
    {
    }

    /**
     * @Route("/documentation/o2c.html")
     * @Template("swagger-ui/o2c.html.twig")
     */
    public function docsUiO2cAction()
    {
    }
}

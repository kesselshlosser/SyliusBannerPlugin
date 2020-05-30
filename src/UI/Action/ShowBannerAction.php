<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Action;

use Black\SyliusBannerPlugin\Repository\BannerRepositoryInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Black\SyliusBannerPlugin\Entity\Banner;

final class ShowBannerAction
{
    private $repository;

    private $context;

    private $environment;

    public function __construct(
        BannerRepositoryInterface $repository,
        ChannelContextInterface $context,
        Environment $environment
    ) {
        $this->repository = $repository;
        $this->context = $context;
        $this->environment = $environment;
    }

    public function __invoke(string $code, Request $request): Response
    {
        $template = $request->query->get('template');
        $banner = $this->repository->findBannerForChannel($code, $this->context->getChannel());

        if (null === $template) {
            $template = '@BlackSyliusBannerPlugin/_banner.html.twig';
        }

        return new Response($this->environment->render($template, [
            'banner' => $banner,
        ]));
    }
}

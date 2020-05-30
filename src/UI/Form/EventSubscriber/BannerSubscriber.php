<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Form\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Black\SyliusBannerPlugin\Entity\BannerInterface;
use Webmozart\Assert\Assert;

final class BannerSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $product = $event->getData();

        Assert::isInstanceOf($product, BannerInterface::class);
    }

    public function preSubmit(FormEvent $event): void
    {
        $data = $event->getData();

        if (empty($data) || !array_key_exists('code', $data)) {
            return;
        }
    }
}

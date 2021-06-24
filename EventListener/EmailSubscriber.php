<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticBarcodeGeneratorBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Mautic\EmailBundle\EmailEvents;
use Mautic\EmailBundle\Event as Events;
use MauticPlugin\MauticBarcodeGeneratorBundle\Token\BarcodeTokenReplacer;
use MauticPlugin\MauticBarcodeGeneratorBundle\Token\QrcodeTokenReplacer;

/**
 * Class EmailSubscriber.
 */
class EmailSubscriber implements EventSubscriberInterface
{

    /**
     * @var BarcodeTokenReplacer
     */
    private $barcodeTokenReplacer;

    /**
     * @var QrcodeTokenReplacer
     */
    private $qrcodeTokenReplacer;

    /**
     * EmailSubscriber constructor.
     *
     * @param BarcodeTokenReplacer $barcodeTokenReplacer
     * @param QrcodeTokenReplacer  $qrcodeTokenReplacer
     */
    public function __construct(BarcodeTokenReplacer $barcodeTokenReplacer, QrcodeTokenReplacer $qrcodeTokenReplacer)
    {
        $this->barcodeTokenReplacer = $barcodeTokenReplacer;
        $this->qrcodeTokenReplacer = $qrcodeTokenReplacer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            EmailEvents::EMAIL_ON_SEND => ['onEmailGenerate', 0],
            EmailEvents::EMAIL_ON_DISPLAY => ['onEmailGenerate', 0],
        ];
    }

    /**
     * Search and replace tokens with content
     *
     * @param EmailSendEvent $event
     */
    public function onEmailGenerate(Events\EmailSendEvent $event)
    {
        $content = $event->getContent();
        $lead = $event->getLead();
        $tokenList = $this->barcodeTokenReplacer->getTokens($content, $lead);
        if (count($tokenList)) {
            $event->addTokens($tokenList);
            unset($tokenList);
        }

        $tokenList = $this->qrcodeTokenReplacer->getTokens($content, $lead);
        if (count($tokenList)) {
            $event->addTokens($tokenList);
            unset($tokenList);
        }
    }
}
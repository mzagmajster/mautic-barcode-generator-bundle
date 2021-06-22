<?php


/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticBarcodeGeneratorBundle\Integration;

use \Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormFeatureSettingsInterface;
use Mautic\PluginBundle\Integration\AbstractIntegration;
use MauticPlugin\MauticBarcodeGeneratorBundle\Form\Type\BarcodeConfigType;

class BarcodeGeneratorIntegration implements ConfigFormFeatureSettingsInterface
{
    public function getFeatureSettingsConfigFormName()
    {
        return BarcodeConfigType::class;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'BarcodeGenerator';
    }

    public function getIcon()
    {
        return 'plugins/MauticBarcodeGeneratorBundle/Assets/img/logo.png';
    }

    /**
     * @return array
     */
    public function getFormSettings()
    {
        return [
            'requires_callback'      => false,
            'requires_authorization' => false,
        ];
    }
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getAuthenticationType()
    {
        return 'none';
    }
}

<?php

/**
 * changelanguage Extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2008-2016, terminal42 gmbh
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/terminal42/contao-changelanguage
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][]       = 'customLanguage';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][]       = 'limitWebsiteRoots';
$GLOBALS['TL_DCA']['tl_module']['palettes']['changelanguage']       = '{title_legend},name,headline,type;{config_legend},hideActiveLanguage,hideNoFallback,customLanguage,limitWebsiteRoots;{template_legend:hide},navigationTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['customLanguage']    = 'customLanguageText';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['limitWebsiteRoots']  = 'websiteRootPageIds,negateWebsiteRootsSelection';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['hideActiveLanguage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['hideActiveLanguage'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['hideNoFallback'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['hideNoFallback'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['customLanguage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['customLanguage'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['customLanguageText'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['customLanguageText'],
    'exclude'                 => true,
    'inputType'               => 'multiColumnWizard',
    'eval'                    => array(
        'columnFields' => [
            'value' => [
                'label'     => &$GLOBALS['TL_LANG']['tl_module']['customLanguageText']['value'],
                'inputType' => 'text',
                'mandatory' => true,
                'class'     => 'tl_text',
                'eval'      => ['mandatory' => true, 'allowHtml' => true, 'style' => 'max-width:150px'],
            ],
            'label' => [
                'label'     => &$GLOBALS['TL_LANG']['tl_module']['customLanguageText']['label'],
                'inputType' => 'text',
                'mandatory' => true,
                'class'     => 'tl_text',
                'eval'      => ['mandatory' => true, 'allowHtml' => true, 'style' => 'max-width:150px'],
            ],
        ],
        'tl_class'     => 'clr',
    ),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['limitWebsiteRoots'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['limitWebsiteRoots'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['websiteRootPageIds'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['websiteRootPageIds'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('Terminal42\ChangeLanguage\EventListener\DataContainer\ModuleFieldsListener', 'onWebsiteRootPageIdsOptions'),
    'eval'                    => ['mandatory' => true, 'multiple' => true, 'chosen' => true, 'csv' => ',', 'tl_class' => 'clr'],
    'sql'                     => "TEXT null"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['negateWebsiteRootsSelection'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['negateWebsiteRootsSelection'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => ['tl_class' => 'clr'],
    'sql'                     => "char(1) NOT NULL default ''"
);

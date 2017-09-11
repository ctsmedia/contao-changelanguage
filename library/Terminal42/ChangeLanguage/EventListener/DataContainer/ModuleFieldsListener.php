<?php

/*
 * changelanguage Extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2008-2017, terminal42 gmbh
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @author     CTS GmbH <info@cts-media.eu>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/terminal42/contao-changelanguage
 */

namespace Terminal42\ChangeLanguage\EventListener\DataContainer;

use Contao\PageModel;

class ModuleFieldsListener
{
    /**
     * Gets list of options for root page limit selection (to only render certain root pages in frontend output).
     *
     * @return array
     */
    public function onWebsiteRootPageIdsOptions()
    {
        /** @var PageModel[] $pages */
        $pages = PageModel::findBy(['tl_page.type=?'], ['root']);

        if (null === $pages) {
            return [];
        }

        $options = [];

        foreach ($pages as $page) {
            $options[$page->id] = sprintf(
                '%s%s [%s]',
                $page->title,
                (strlen($page->dns) ? (' ('.$page->dns.')') : ''),
                $page->language
            );
        }

        return $options;
    }
}

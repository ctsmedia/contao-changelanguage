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

namespace Terminal42\ChangeLanguage\Tests\PageFinder;

use Contao\PageModel;
use Terminal42\ChangeLanguage\PageFinder;
use Terminal42\ChangeLanguage\Tests\ContaoTestCase;

class RootPagesLimitTest extends ContaoTestCase
{
    /**
     * @var PageFinder
     */
    private $pageFinder;

    public function setUp()
    {
        parent::setUp();

        $this->pageFinder = new PageFinder([1, 2]);
    }

    public function testOnlyIncludesConfiguredRootIds()
    {
        $id = $this->createRootPage('foo.com', 'en', true);
        $this->createRootPage('foo.com', 'de', false);
        $this->createRootPage('foo.com', 'fr', false);
        $this->createRootPage('foo.com', 'it', false);

        $regularId = $this->createRegularPage($id);

        $pageModel = new PageModel();
        $pageModel->id = $regularId;
        $pageModel->pid = $id;

        $roots = $this->pageFinder->findRootPagesForPage($pageModel);

        $this->assertPageCount($roots, 2);
    }

    private function createRootPage($dns, $language, $fallback = true, $published = true)
    {
        $fallback = $fallback ? '1' : '';
        $published = $published ? '1' : '';

        return $this->query("
            INSERT INTO tl_page 
            (type, title, dns, language, fallback, published) 
            VALUES 
            ('root', 'foobar', '$dns', '$language', '$fallback', '$published')
        ");
    }

    private function createRegularPage($pid)
    {
        return $this->query("
            INSERT INTO tl_page 
            (pid, type, title, published) 
            VALUES 
            ('$pid', 'regular', 'barbaz', '1')
        ");
    }

    private function assertPageCount($roots, $count)
    {
        $this->assertCount($count, $roots);

        foreach ($roots as $instance) {
            $this->assertInstanceOf('\Contao\PageModel', $instance);
        }
    }
}

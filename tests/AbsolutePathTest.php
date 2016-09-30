<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/30/16
 * Time: 9:03 AM
 */

namespace tests;

use function Kote\Utils\AbsolutePath\absolutePathMaker;
use PHPUnit\Framework\TestCase;

class AbsolutePathTest extends TestCase
{
    /**
     * @var string
     */
    private $absoluteRootPath = '/my/root';

    private $pathMaker;

    public function setUp()
    {
        $this->pathMaker = absolutePathMaker($this->absoluteRootPath);
    }

    /**
     * @expectedException \Exception
     */
    public function testOneException()
    {
        call_user_func($this->pathMaker, '/absolute/path');
    }

    /**
     * @expectedException \Exception
     */
    public function testSecondException()
    {
        absolutePathMaker('not/absolute/path');
    }

    /**
     * @dataProvider dataProvider
     * @param $expected
     * @param $relativePath
     */
    public function testPathMaker($expected, $relativePath)
    {
        $this->assertEquals($expected, call_user_func($this->pathMaker, $relativePath));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            ['/my/root',                    '.'],
            ['/my',                         '..'],
            ['/over-root',                  '../../../../over-root'],
            ['/my/root/some/other/file',    'some/other/file'],
            ['/my/root/some/other',         'some/forward/..///./other']
        ];
    }
}

<?php

namespace Runalyze\View;
use Runalyze\Bundle\CoreBundle\Component\Tool\Anova\QueryValue\Rpe;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2015-01-15 at 11:27:05.
 */
class RpecolorTest extends \PHPUnit_Framework_TestCase {

	public function testSetting() {
		$ViaConstructor = new Rpecolor(17);
		$this->assertEquals(17, $ViaConstructor->value());

		$ViaSet = new Rpecolor();
		$this->assertEquals(19, $ViaSet->setValue(19)->value());
	}


	public function testBackgroundColor()
    {
        $Stress = new Rpecolor();

        $this->assertEquals(null, $Stress->setValue(0)->backgroundColor());
        $this->assertEquals('c000ff', $Stress->setValue(6)->backgroundColor());
        $this->assertEquals('3600b3', $Stress->setValue(9)->backgroundColor());
        $this->assertEquals('00d900', $Stress->setValue(12)->backgroundColor());
        $this->assertEquals('efff00', $Stress->setValue(14)->backgroundColor());
        $this->assertEquals('ff7e00', $Stress->setValue(18)->backgroundColor());
        $this->assertEquals('ff0000', $Stress->setValue(20)->backgroundColor());
    }

    public function testTextColor()
    {
        $Stress = new Rpecolor();

        $this->assertEquals(null, $Stress->setValue(0)->textColor());
        $this->assertEquals('ffffff', $Stress->setValue(6)->textColor());
        $this->assertEquals('ffffff', $Stress->setValue(9)->textColor());
        $this->assertEquals('000000', $Stress->setValue(12)->textColor());
        $this->assertEquals('000000', $Stress->setValue(14)->textColor());
        $this->assertEquals('ffffff', $Stress->setValue(18)->textColor());
        $this->assertEquals('ffffff', $Stress->setValue(20)->textColor());
    }

}

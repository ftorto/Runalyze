<?php

use Runalyze\Configuration;
use Runalyze\Util\LocalTime;

/**
 * @group import
 * @group dependsOnOldFactory
 */
class ImporterFiletypeLOGBOOKTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var ImporterFiletypeXML
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new ImporterFiletypeLOGBOOK;
	}

	/**
	 * Test: empty string
	 * @expectedException \Runalyze\Import\Exception\ParserException
	 */
	public function testEmptyString() {
		$this->object->parseString('');
	}

	/**
	 * Test: incorrect xml-file
	 */
	public function test_incorrectString() {
		$this->object->parseString('<any><xml><file></file></xml></any>');

		$this->assertTrue( $this->object->failed() );
		$this->assertEmpty( $this->object->objects() );
		$this->assertNotEmpty( $this->object->getErrors() );
	}

	/**
	 * Test: Polar file
	 * Filename: "test.logbook"
	 */
	public function test_StandardFile() {
		$this->object->parseFile('../tests/testfiles/sporttracks/test.logbook');

		$this->assertFalse( $this->object->failed() );
		$this->assertTrue( $this->object->hasMultipleTrainings() );
		$this->assertEquals( 5, $this->object->numberOfTrainings() );

		// Activity 1
		$this->assertEquals('2008-09-06 18:01', LocalTime::date('Y-m-d H:i', $this->object->object(0)->getTimestamp()));
		$this->assertEquals(120, $this->object->object(0)->getTimezoneOffset());
		$this->assertEquals( Configuration::General()->runningSport(), $this->object->object(0)->get('sportid') );
		$this->assertEquals( 9382, $this->object->object(0)->getTimeInSeconds() );
		$this->assertEquals( 26.743, $this->object->object(0)->getDistance() );
		$this->assertEquals( 943, $this->object->object(0)->getCalories() );
		$this->assertEquals( "Buxtehuder Abendlauf", $this->object->object(0)->getTitle() );
		$this->assertEquals( "Buxtehude", $this->object->object(0)->getRoute() );
		$this->assertEquals( "20°C\r\n1-2 Bft", $this->object->object(0)->getNotes() );

		// Activity 2
		$this->assertEquals('2009-03-28 15:03', LocalTime::date('Y-m-d H:i', $this->object->object(1)->getTimestamp()));
		$this->assertEquals(60, $this->object->object(1)->getTimezoneOffset());
		$this->assertEquals( Configuration::General()->runningSport(), $this->object->object(1)->get('sportid') );
		$this->assertEquals( 10837, $this->object->object(1)->getTimeInSeconds() );
		$this->assertEquals( 25.864, $this->object->object(1)->getDistance() );
		$this->assertEquals( 365, $this->object->object(1)->getElevation() );
		$this->assertEquals( 156, $this->object->object(1)->getPulseAvg() );
		$this->assertEquals( 167, $this->object->object(1)->getPulseMax() );
		$this->assertEquals( "mit Michael", $this->object->object(1)->getTitle() );
		$this->assertEquals( "Horneburg-Helmste-Harsefeld-Bliedersdorf", $this->object->object(1)->getRoute() );
		$this->assertEquals( "Erster Lauf mit der Forerunner 305  ;o)", $this->object->object(1)->getNotes() );
		$this->assertEquals( true, $this->object->object(1)->Splits()->areEmpty() );

		// Activity 2
		$this->assertEquals('2009-03-31 20:22', LocalTime::date('Y-m-d H:i', $this->object->object(2)->getTimestamp()));
		$this->assertEquals(120, $this->object->object(2)->getTimezoneOffset());
		$this->assertEquals( Configuration::General()->runningSport(), $this->object->object(2)->get('sportid') );
		$this->assertEquals( 2310, $this->object->object(2)->getTimeInSeconds() );
		$this->assertEquals( 6.904, $this->object->object(2)->getDistance() );
		$this->assertEquals( "Horneburg Winterrunde", $this->object->object(2)->getRoute() );
		$this->assertEquals( false, $this->object->object(2)->Splits()->areEmpty() );
		$this->assertEquals(
				'1.000|5:37-1.000|5:38-1.000|5:43-1.000|5:38-1.000|5:37-1.000|5:19-0.904|4:56',
				$this->object->object(2)->Splits()->asString()
		);

		// Nothing interesting in the other activities.
	}

}

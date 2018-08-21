<?php

use Italomoralesf\Tagging\Model\Tagged;

class TaggedTest extends TestCase
{
	public function test_instantiation()
	{
		$tagged = new Tagged();
	
		$this->assertInternalType('object', $tagged);
	}
}
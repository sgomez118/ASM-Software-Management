<?php

class AssertTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testAssert()
	{
/*
		$theTruth = true;
		$this->assertTrue($theTruth);
        
        $theTruth = true;
        $this->assertFalse($theTruth);

        $theString = 'Roux Academy of Art and Science';
        $this->assertSame('Roux Academy of Art and Science', $theString);  
 
        $theString = 'Roux Academy of Art and Science';
        $this->assertContains('Art', $theString);
 */        
        $this->assertArrayHasKey('myKey', array('myKey' => 'myArray'));        
	}

}

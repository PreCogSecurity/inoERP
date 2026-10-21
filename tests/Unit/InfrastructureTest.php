<?php
/**
 * Minimal PHPUnit test to verify the test infrastructure works.
 * 
 * This test demonstrates that the PHPUnit test suite is operational.
 * Individual module tests can be added as the codebase is refactored.
 */

use PHPUnit\Framework\TestCase;

/**
 * Minimal test verifying PHPUnit test infrastructure.
 * 
 * @group infrastructure
 */
class InfrastructureTest extends TestCase
{
    /**
     * Test that PHPUnit is operational.
     */
    public function testPhpUnitIsWorking()
    {
        $this->assertTrue(true);
    }
}
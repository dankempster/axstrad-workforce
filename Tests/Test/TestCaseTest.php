<?php
namespace Axstrad\Component\WorkForce\Tests\Worker;

use Axstrad\Component\WorkForce\Test\TestCase;


class TestCaseTest extends TestCase
{
    /**
     * @covers Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     */
    public function testCreateMockWorkerMethod()
    {
        $fixture = $this->createMockWorker();
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\Worker',
            $fixture
        );
        $this->assertInstanceOf(
            'PHPUnit_Framework_MockObject_MockObject',
            $fixture
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @depends testCreateMockWorkerMethod
     */
    public function testCanSetMockWorkersClassName()
    {
        $fixture = $this->createMockWorker('Test_Mock_Worker_ClassName');
        $this->assertEquals(
            'Test_Mock_Worker_ClassName',
            get_class($fixture)
        );
    }

    /**
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerCanWork
     * @depends testCreateMockWorkerMethod
     */
    public function testWorkIsMockedToReturnTrue()
    {
        $fixture = $this->workerCanWork();
        $this->assertTrue(
            $fixture->canWork('')
        );
    }

    /**
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerCanWork
     * @depends testCreateMockWorkerMethod
     */
    public function testCanMockWorkReturnValue()
    {
        $fixture = $this->workerCanWork('foo');
        $fixture->canWork(''); // required to satisfy method call assetion
        $this->assertEquals(
            'foo',
            $fixture->work('')
        );
    }

    /**
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerCannotWork
     * @depends testCreateMockWorkerMethod
     */
    public function testWorkIsMockedToReturnFalse()
    {
        $fixture = $this->workerCanNotWork();
        $this->assertFalse(
            $fixture->canWork('')
        );
    }

    /**
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerIsNotUsed
     * @depends testCreateMockWorkerMethod
     */
    public function testWorkerIsNotUsedMethodAndMockObject()
    {
        $fixture = $this->workerIsNotUsed();

        // now all should pass if we don't do anything :)
    }
}

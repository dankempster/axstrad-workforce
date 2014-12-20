<?php
namespace Axstrad\Component\WorkForce\Tests\Worker;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Worker\DispatchDynamicEvent;
use Symfony\Component\EventDispatcher\GenericEvent;


class DispatchDynamicEventTest extends TestCase
{
    protected $mockEventDispatcher;
    protected $mockWorker;


    public function setUp()
    {
        $this->mockEventDispatcher = $this->getMockBuilder('Symfony\Component\EventDispatcher\EventDispatcher')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->mockWorker = $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker');
        $this->fixture = new DispatchDynamicEvent(
            $this->mockEventDispatcher,
            $this->mockWorker
        );
    }

    protected function workerCanWork()
    {
        $this->mockWorker->expects($this->any())
            ->mehtod('canWork')
            ->will($this->returnValue(true))
        ;
    }

    protected function workerCanNotWork()
    {
        $this->mockWorker->expects($this->any())
            ->mehtod('canWork')
            ->will($this->returnValue(false))
        ;
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchDynamicEvent::__construct
     */
    public function testEventDispatcherIsSet()
    {
        $this->assertSame(
            $this->mockEventDispatcher,
            $this->fixture->getEventDispatcher()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchDynamicEvent::__construct
     */
    public function testEventTypeResolverIsSet()
    {
        $this->assertSame(
            $this->mockWorker,
            $this->fixture->getEventTypeResolver()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchDynamicEvent::canWork
     */
    public function testCanWorkIsProxiedToWorker()
    {
        $this->mockWorker
            ->expects($this->once())
            ->method('canWork')
            ->with($this->equalTo('some task'))
            ->will($this->returnValue(true))
        ;

        $this->assertTrue(
            $this->fixture->canWork('some task')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchDynamicEvent::work
     */
    public function testWorkerIsUsedToResolveTheEventType()
    {
        $this->mockWorker
            ->expects($this->once())
            ->method('work')
            ->with($this->equalTo('some task'))
            ->will($this->returnValue(false))
        ;

        $this->assertFalse(
            $this->fixture->work('some task')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchDynamicEvent::work
     */
    public function testEventIsDispatched()
    {
        $this->mockWorker
            ->expects($this->once())
            ->method('work')
            ->will($this->returnValue($event = array(
                'object' => new GenericEvent,
                'type' => 'some-event',
            )))
        ;

        $this->mockEventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->equalTo($event['type']),
                $this->identicalTo($event['object'])
            )
        ;

        $this->fixture->work(null);
    }
}

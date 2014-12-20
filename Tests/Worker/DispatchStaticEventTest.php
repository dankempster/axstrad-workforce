<?php
namespace Axstrad\Component\WorkForce\Tests\Worker;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Worker\DispatchStaticEvent;


class DispatchStaticEventTest extends TestCase
{
    const EVENT_TYPE = 'type';
    const EVENT_CLASS = 'Symfony\Component\EventDispatcher\GenericEvent';


    protected $mockEventDispatcher;


    public function setUp()
    {
        $this->mockEventDispatcher = $this->getMockBuilder('Symfony\Component\EventDispatcher\EventDispatcher')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->fixture = new DispatchStaticEvent(
            $this->mockEventDispatcher,
            self::EVENT_TYPE,
            self::EVENT_CLASS
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::__construct
     */
    public function testEventDispatcherIsSet()
    {
        $this->assertSame(
            $this->mockEventDispatcher,
            $this->fixture->getEventDispatcher()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::__construct
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::getEventType
     */
    public function testGetEventType()
    {
        $this->assertEquals(
            self::EVENT_TYPE,
            $this->fixture->getEventType()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::getEventType
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::setEventType
     */
    public function testSetEventType()
    {
        $this->fixture->setEventType('foo');

        $this->assertEquals(
            'foo',
            $this->fixture->getEventType()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::setEventType
     */
    public function testSetEventTypeReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setEventType('foo')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::__construct
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::getEventClass
     */
    public function testGetEventClass()
    {
        $this->assertEquals(
            self::EVENT_CLASS,
            $this->fixture->getEventClass()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::getEventClass
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::setEventClass
     */
    public function testSetEventClass()
    {
        $this->fixture->setEventClass('foo');

        $this->assertEquals(
            'foo',
            $this->fixture->getEventClass()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::setEventClass
     */
    public function testSetEventClassReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setEventClass('foo')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::work
     * @uses Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::getEventClass
     * @uses Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::setEventType
     */
    public function testWorkDispatchesEvent()
    {
        $this->mockEventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->equalTo(self::EVENT_TYPE),
                $this->isInstanceOf(self::EVENT_CLASS)
            )
        ;

        $this->fixture->work(null);
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::work
     * @uses Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::getEventClass
     * @uses Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::setEventType
     */
    public function testEventObjectContainsTask()
    {
        $this->mockEventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->equalTo(self::EVENT_TYPE),
                $this->callback(function($subject) {
                    return $subject->getSubject() == 'some task';
                })
            )
        ;

        $this->fixture->work('some task');
    }

    /**
     * @covers Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::work
     * @uses Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::getEventClass
     * @uses Axstrad\Component\WorkForce\Worker\DispatchStaticEvent::setEventType
     */
    public function testWorkReturnsTrue()
    {
        $this->assertTrue($this->fixture->work(null));
    }
}

<?php

declare(strict_types=1);

namespace Demo\Test\Unit\Domain;

use Demo\Domain\Task;
use Demo\Test\Unit\Traits\Visibility;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    use Visibility;

    public function testConstructor(): void
    {
        $task = new Task(
            $title       = 'Task',
            $description = 'Task Description',
            $priority    = 1,
            $isDone      = true,
            $isDeleted   = true,
            $doneAt      = new \DateTimeImmutable('+1 day'),
            $deletedAt   = new \DateTimeImmutable('+2 day'),
        );

        $this->assertSame($title, $task->getTitle());
        $this->assertSame($description, $task->getDescription());
        $this->assertSame($priority, $task->getPriority());
        $this->assertSame($isDone, $task->isDone());
        $this->assertSame($isDeleted, $task->isDeleted());
        $this->assertSame($doneAt, $task->getDoneAt());
        $this->assertSame($deletedAt, $task->getDeletedAt());
    }

    public function testGetId(): void
    {
        $id   = 1;
        $task = new Task('Task');

        $this->setPrivateProperty($task, 'id', $id);
        $this->assertEquals($id, $task->getId());
    }

    public function testTitle(): void
    {
        $task = new Task('Task');
        $task->setTitle($title = 'New Task');
        $this->assertEquals($title, $task->getTitle());
    }

    public function testDescription(): void
    {
        $task = new Task('Task');
        $task->setDescription($description = 'Description');
        $this->assertEquals($description, $task->getDescription());
    }

    public function testPriority(): void
    {
        $task = new Task('Task');
        $task->setPriority($priority = 10);
        $this->assertEquals($priority, $task->getPriority());
    }

    public function testDone(): void
    {
        $task = (new Task('Task'))->done();
        $this->assertTrue($task->isDone());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getDoneAt());
    }

    public function testUndone(): void
    {
        $task = (new Task('Task'))->undone();
        $this->assertFalse($task->isDone());
        $this->assertNull($task->getDoneAt());
    }

    public function testDelete(): void
    {
        $task = (new Task('Task'))->delete();
        $this->assertTrue($task->isDeleted());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getDeletedAt());
    }

    public function testRestore(): void
    {
        $task = (new Task('Task'))->restore();
        $this->assertFalse($task->isDeleted());
        $this->assertNull($task->getDeletedAt());
    }
}

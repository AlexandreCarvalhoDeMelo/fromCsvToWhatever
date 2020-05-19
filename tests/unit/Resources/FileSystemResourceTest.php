<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Resources;

use CastorCaster\Resources\FileSystem;
use CastorCaster\Tests\TestCase;

class FileSystemResourceTest extends TestCase
{
    public function test_read_file(): void
    {
        $subject = new FileSystem(self::TEST_INPUT_FILE_FIXTURE);
        self::assertInstanceOf(\SplFileInfo::class, $subject);
        self::assertEquals("text/plain", $subject->getMimeType());
    }
}
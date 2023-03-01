<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Otomaties\Downloads\Models\Download;

final class DownloadTest extends TestCase
{
    public function testCanBeCreatedFromString(): void
    {
        $this->assertInstanceOf(
            Download::class,
            new Download(420)
        );
    }

    public function testPostTypeIsCorrect(): void
    {
        $this->assertEquals(
            'download',
            Download::postType()
        );
    }
}

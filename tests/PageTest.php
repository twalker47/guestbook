<?php declare(strict_types=1);
  require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class PageTest extends TestCase
{
    // look for the text that must always appear on the page
    public function testRequiredText(): void
    {
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        $response = $client->get('https://guestbook.briantoone.repl.co/');
        $body = $response->getBody();
        // Implicitly cast the body to a string and echo it
        echo $body;
        // Explicitly cast the body to a string
        $stringBody = (string) $body;
        $this->assertStringContainsString("GuestBook", $stringBody);
        $this->assertStringContainsString("Name", $stringBody);
        $this->assertStringContainsString("Comment", $stringBody);
        $this->assertStringContainsString("View our guestbook below", $stringBody);
        $gbi = strpos($stringBody, "GuestBook");
        $ni = strpos($stringBody, "Name");
        $ci = strpos($stringBody, "Comment");
        $vgbi = strpos($stringBody, "View our guestbook below");
        $this->assertLessThan($ni, $gbi);
        $this->assertLessThan($ci, $ni);
        $this->assertLessThan($vgbi, $ci);
    }

    // look for the text that must always appear on the page
    public function testSubmission(): void
    {
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 
          'https://guestbook.briantoone.repl.co/process.php', [
          'form_params' => [
            'name' => 'Test user',
            'comment' => 'this is a test comment',
          ]
        ]);
    }
}
<?php namespace Tests\Acceptance;

use Illuminate\Http\Request;

class QuoteTest extends \Tests\TestCase
{
    public function test_homepage_has_quote()
    {
        $request = Request::create('/');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("class=\"quote\"", $response->getContent());
    }
}
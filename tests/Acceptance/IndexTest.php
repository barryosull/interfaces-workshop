<?php namespace Tests\Acceptance;

use Illuminate\Http\Request;

class IndexTest extends \Tests\TestCase
{
    public function test_load_homepage()
    {
        $request = Request::create('/');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
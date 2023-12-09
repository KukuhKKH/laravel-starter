<?php

namespace Tests;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Event::listen(function(RouteMatched $event) {
            Log::debug('req >> ' . $event->request->method() . ' ' . $event->request->fullUrl());
        });

        Event::listen(function(RequestHandled $event) {
            Log::debug('resp << ' . $event->response->getStatusCode() . ' ' . (Response::$statusTexts[$event->response->getStatusCode()] ?? ''));
        });
    }
}

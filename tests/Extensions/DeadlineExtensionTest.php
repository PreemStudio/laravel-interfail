<?php

declare(strict_types=1);

use Carbon\Carbon;
use PreemStudio\Interfail\Extensions\DeadlineExtension;
use PreemStudio\Interfail\Interfail;

it('should pass if the deadline is in the future', function (): void {
    expect(
        Interfail::make('id')
            ->withoutStateCache()
            ->addExtension(new DeadlineExtension(Carbon::now()->addMinute()))
            ->run(fn (): string => 'Hello, World!')
    )->toBeOk();
});

it('should fail if the deadline is in the past', function (): void {
    expect(
        Interfail::make('id')
            ->withoutStateCache()
            ->addExtension(new DeadlineExtension(Carbon::now()->subMinute()))
            ->run(fn (): string => 'Hello, World!')
    )->toBeErr();
});

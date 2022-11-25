<?php

use App\Models\Weight;

it('can create a weight', function () {
    Weight::factory()->create();
    expect(Weight::count())->toBeOne();
});

it('can update a weight', function () {
    $weight = Weight::factory()->create();
    $weight->update([
        'weight' => 10.2
    ]);

    expect(Weight::count())->toBeOne();
    expect($weight->weight)->toBe(10.2);
});

it('can delete a weight', function () {
    $weight = Weight::factory()->create();
    $weight->delete();

    expect(Weight::count())->toBe(0);
});

<?php

use App\Models\Weight;

it('can create a weight', function () {
    $this->postJson(route('weight.create'),[
            'weight_date' => '2022-11-25',
            'weight' => 10.25,
            'comment' => 'This is testing',
        ])
        ->assertStatus(200);

    expect(Weight::count())->toBe(1);
});

it('can update a weight', function () {
    $weight = Weight::factory()->create();

    $response = $this->postJson(route('weight.update'), [
            'weight_id' => $weight->id,
            'weight_date' => '2022-11-25',
            'weight' => 10.25,
            'comment' => 'This is testing',
        ])
        ->assertStatus(200);

    expect(Weight::count())->toBe(1);
    expect($response->json('data'))->toBe($weight->id);
});

it('can delete a weight', function () {
    $weight = Weight::factory()->create();
    
    $this->deleteJson(route('weight.delete', $weight->id))
        ->assertStatus(200);

    expect(Weight::count())->toBe(0);
});

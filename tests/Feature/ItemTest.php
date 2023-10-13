<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_all_items(): void
    {
        $items = Item::factory()->count(5)->create();

        $this->assertDatabaseCount('items', $items->count());

        $response = $this->get(route('items.index'));

        $response->assertStatus(200);
        $response->assertViewHas('items');
    }

    public function test_it_displays_an_item(): void
    {
        $item = Item::factory()->create();

        $this->assertDatabaseHas('items', ['name' => $item->name]);

        $response = $this->get(route('items.show', $item));

        $response->assertStatus(200);
        $response->assertViewHas('item');
        $response->assertSeeText($item->name);
    }

    public function test_it_shows_the_create_form():void
    {
        $response = $this->get(route('items.create'));

        $response->assertStatus(200);
    }

    public function test_it_creates_an_item():void
    {
        $this->followingRedirects();

        $response = $this->post(route('items.store'), [
            'name' => 'Test Item',
            'description' => 'A new test item'
        ]);

        $response->assertStatus(200);

        $response->assertSee('Test Item');
    }

    public function test_it_shows_the_update_form():void
    {
        $item = Item::create([
            'name' => 'Test Item',
            'description' => 'A new test item'
        ]);

        $response = $this->get(route('items.edit', $item));

        $response->assertStatus(200);

        $response->assertSee('Test Item');
    }

    public function test_it_updates_items():void
    {
        $this->followingRedirects();

        $item = Item::create([
            'name' => 'Test Item',
            'description' => 'A new test item'
        ]);

        $response = $this->put(route('items.update', $item), [
            'name' => 'An updated item name',
            'description' => 'foobar'
        ]);

        $response->assertStatus(200);
        $response->assertSee('An updated item name');

        $this->assertDatabaseHas('items', ['name' => 'An updated item name']);
        $this->assertDatabaseMissing('items', ['name' => 'Test Item']);
    }
}

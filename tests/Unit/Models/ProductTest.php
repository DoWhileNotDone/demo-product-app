<?php

namespace Tests\Unit\Models;

use Carbon\Carbon;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Test the toSearchableArray fields function.
     *
     * @return void
     */
    public function test_searchable()
    {
        $result = (new Product([
            'name' => 'Jam',
            'barcode' => '123456',
            'brand' => 'Jam Brand',
            'price' => 6.99,
            'image_url' => 'http://example.com',
            'date_added' => Carbon::now(),
        ]))->toSearchableArray();
        
        $this->assertIsArray($result);

        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('brand', $result);
        $this->assertArrayNotHasKey('barcode', $result);
        $this->assertArrayNotHasKey('price', $result);
        $this->assertArrayNotHasKey('image_url', $result);
        $this->assertArrayNotHasKey('date_added', $result);
        
        $this->assertEquals($result['name'], 'Jam');
        $this->assertEquals($result['brand'], 'Jam Brand');
    }
}

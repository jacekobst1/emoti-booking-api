<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Modules\Asset\Domain\Models\Asset;
use App\Modules\Slot\Domain\Models\Slot;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asset1 = Asset::factory()->create();
        Slot::factory()->for($asset1)->create(['date' => '2024-06-01', 'price' => 3000]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-02', 'price' => 3000]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-03', 'price' => 3000]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-04', 'price' => 3000]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-05', 'price' => 3000]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-06', 'price' => 1900]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-07', 'price' => 3000]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-08', 'price' => 3500]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-09', 'price' => 3500]);
        Slot::factory()->for($asset1)->create(['date' => '2024-06-10', 'price' => 3500]);

        $asset2 = Asset::factory()->create();
        Slot::factory()->for($asset2)->create(['date' => '2024-06-01', 'price' => 2000]);
        Slot::factory()->for($asset2)->create(['date' => '2024-06-02', 'price' => 2000]);
        Slot::factory()->for($asset2)->create(['date' => '2024-06-03', 'price' => 2000]);
        Slot::factory()->for($asset2)->create(['date' => '2024-06-08', 'price' => 2000]);
        Slot::factory()->for($asset2)->create(['date' => '2024-06-09', 'price' => 2000]);
        Slot::factory()->for($asset2)->create(['date' => '2024-06-10', 'price' => 2000]);
    }
}

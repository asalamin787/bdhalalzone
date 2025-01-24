<?php
namespace App\Imports;

use App\Models\Prodcat;
use App\Models\Product;
use App\Models\Shop;
use App\Services\ProductImportService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ProductDataImport implements ToCollection, WithHeadingRow
{

    protected $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }


    public function findClosestMatch($input, $array)
    {
        $shortest = -1;
        $closest = null;

        foreach ($array as $key => $data) {
            // Calculate the Levenshtein distance between the input and the current value
            $lev = levenshtein($input, $data['name']);

            // Check for an exact match
            if ($lev == 0) {
                // Exact match found, return immediately
                $closest = $data;
                break;
            }

            // If this distance is less than the next found shortest distance
            // or if a next shortest distance hasn't been found yet
            if ($lev < $shortest || $shortest < 0) {
                // Set the closest match, and shortest distance
                $closest = $data;
                $shortest = $lev;
            }
        }

        return $closest;
    }

    function findMostSimilarSimilarText($string, $array)
    {
        $highestPercent = 0;
        $closest = null;

        foreach ($array as $key => $value) {
            similar_text($string, $value['nameWithoutSubText'], $percent);

            if ($percent > $highestPercent) {
                $highestPercent = $percent;
                $closest = $value;
            }
        }

        return $closest;
    }


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {


        $rows = [];
        $errors = [];
        $iteration = 0;
        foreach ($collection as $data) {

            if (Product::where('sku', 'SKU-' . $this->shop->id . '-' . (int) $data['sl'])->count() > 0) {
                continue;
            }
            Log::info($iteration);
            if ($iteration >= 100 / 2) {
                break;
            } else {

                $iteration++;
            }
            try {
                $new = [
                    "apiKey" => "e964fc2d51064efa97e94db7c64bf3d044279d4ed0ad4bdd9dce89fecc9156f0",
                    "storeId" => 1,
                    "warehouseId" => 8,
                    "pageSize" => 100,
                    "currentPageIndex" => 0,
                    "metropolitanAreaId" => 1,
                    "query" => $this->removeWeightFromTitle($data['product_name']),
                    "productVariantId" => -1,
                    "bundleId" => ["case" => "None"],
                    "canSeeOutOfStock" => "true",
                    "filters" => [],
                    "maxOutOfStockCount" => ["case" => "Some", "fields" => [5]],
                    "shouldShowAlternateProductsForAllOutOfStock" => ["case" => "Some", "fields" => [true]],
                    "customerGuid" => ["case" => "None"]
                ];
                $response =  Http::post('https://catalog.chaldal.com/searchOld', $new);


                $result = $this->findMostSimilarSimilarText($data['product_name'], $response->json()['hits']);
                $images = $this->getImages($result['picturesUrls']);
                $asdas = [
                    'shop_id' => $this->shop->id,
                    'sku' => 'SKU-' . $this->shop->id . '-' . (int) $data['sl'],
                    'name' => $data['product_name'],
                    'slug' => Str::slug($data['product_name'] . ' ' . now()->format('ymd') . ' ' . $this->shop->id),
                    'quantity' => (int) $data['quantity'],
                    'description' => @$result['longDesc'],
                    'short_description' => @$result['shortDesc'],
                    'price' => $data['sell_price'],
                    'sale_price' => null,
                    'status' => 1,
                    'weight' => $data['product_weight'] ?? $this->getWeightFromTitle($data['product_name']),
                    'image' => $images[0],
                    'images' => json_encode($images),


                ];
            } catch (Exception $e) {



                continue;
            }
            try {
                if ($data['product_category']) {

                    $category = Prodcat::firstOrCreate([
                        'name' => $data['product_category'],
                        'slug' => Str::slug($data['product_category']),
                        'logo' => ''
                    ]);
                }else{
                    $category = Prodcat::firstOrCreate([
                        'name' => 'other',
                        'slug' => 'other',
                        'logo' => ''
                    ]);

                }
                $product = Product::create($asdas);

                $product->prodcats()->attach($category);
            } catch (Exception $e) {
        
                continue;
            }
        }

        return;
    }

    protected function getWeightFromTitle($title)
    {
        preg_match('/(\d+\s*(?:gm|ML|kg|litter))/i', $title, $matches);

        if (!empty($matches)) {

            $weight =  str_replace(' ', '', $matches[1]);
            if (preg_match('/(\d+\.?\d*)(\D+)/', $weight, $matches)) {
                if (in_array($matches[2], ['KG', 'kg', 'liter', 'Liter'])) {
                    return $matches[1] * 1000;
                } else {

                    return $matches[1];
                }
            }
            return $weight;
        } else {
            return null;
        }
    }
    protected function removeWeightFromTitle($title)
    {
        $pattern = '/(\d+\s*(?:gm|ML|kg|litter))/i';

        $modifiedTitle = preg_replace($pattern, '', $title);
        $modifiedTitle = trim($modifiedTitle); // To remove any leading or trailing spaces

        return $modifiedTitle;
    }


    private function getImages($images)
    {
        $data = [];

        foreach ($images as $image) {
            $imageContents = file_get_contents($image);
            if ($imageContents === false) {
                return response()->json(['error' => 'Failed to download image'], 500);
            }
            $imageName = Str::random(10) . '.jpg';
            $path = 'products/' . $imageName;
            Storage::put($path, $imageContents);
            // dd($imageName);
            $data[] = $path;
        }
        return $data;
    }
}
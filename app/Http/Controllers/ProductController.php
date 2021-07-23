<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Jobs\ProcessProductList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Upload the products
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function upload(Request $request): Response
    {
        //TODO: Store File, use path
        $path = storage_path('app/legacy_products.csv');
        //$path= $request->file('products')->getPathname();
        ProcessProductList::dispatch($path);

        return response(null, 202);
    }
}

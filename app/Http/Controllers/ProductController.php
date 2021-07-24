<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Jobs\ProcessProductList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Retrieve the product data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return Product::search($request->input('query'))->paginate(15);
    }

    /**
     * Upload the products
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function upload(Request $request): Response
    {
        $path = $request->file('file')->store('products');
        ProcessProductList::dispatch($path);

        return response(null, 202);
    }
}

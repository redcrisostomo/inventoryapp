<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = ['search'];
        $category_id = request('category') ?? 'all';
        if($category_id !='all')
        {
            array_push($filters,'category');
        }
        /* Get items per page. Default 5 */
        $perPage = request('perPage', 5);
        return Inertia::render('ProductList', [
            /* Get records, filter if with search, then paginate and then throw to view page */
            'products' => Product::orderBy('name')
                ->filter(request($filters))
                ->paginate($perPage)
                ->withQueryString(),
            'categories' => Category::pluck('name','id')->all(),
            'category_id' => $category_id,
            'filters' => request()->only(['search', 'perPage']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('ProductCreate', [
            'categories' => Category::pluck('name','id')->all(),
        ]);
    }

    public function firstStep(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
    }
    public function secondStep(Request $request)
    {
        // dd($request);
        if(!$request->hasFile('product_images'))
        {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'product_images' => ['Product Image is required'],
             ]);
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request);
        $attrs = $request->validated(); /**Validated inputs */
        $product = Product::create($attrs); /**Create product */

        if($request->hasFile('product_images')) { /**If product image is not empty */
            $files = $request->file('product_images'); /**get the image */
            $image_ids = [];
            foreach($files as $file)
            {
                $filename = date('YmdHis')."-".$file->getClientOriginalName(); /**get the image filename */
                $file->move(public_path('upload/images'),$filename); /**move the uploaded image to the upload directory */
                $image = Image::create(['file'=>'upload/images/'.$filename]); /**Create new imagerecord */
                array_push($image_ids, $image->id);
            }
            $product->images()->attach($image_ids); /**Sync the product images */
        }
        return redirect()->route('products.index')->withSuccess('Record successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masterfile\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masterfile\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('ProductEdit', [
            'product' => $product,
            'categories' => Category::pluck('name','id')->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        // dd($request);
        $attrs = $request->validated(); /**Validated inputs */
        $product = Product::find($id);
        $product->update($attrs); /**Update product */

        if($request->hasFile('product_images')) { /**If product image is not empty */
            $product->images()->detach(); /**Detach previous images */
            $files = $request->file('product_images'); /**get the image */
            $image_ids = [];
            foreach($files as $file)
            {
                $filename = date('YmdHis')."-".$file->getClientOriginalName(); /**get the image filename */
                $file->move(public_path('upload/images'),$filename); /**move the uploaded image to the upload directory */
                $image = Image::create(['file'=>'upload/images/'.$filename]); /**Create new imagerecord */
                array_push($image_ids, $image->id);
            }
            $product->images()->sync($image_ids); /**Sync the product images */
        }
        return redirect()->route('products.index')->withSuccess('Record successfully saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masterfile\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete(); /**Delete the product */
        /**Redirect to the list */
        return back()->with( 'success', 'Record successfully deleted');
    }
}

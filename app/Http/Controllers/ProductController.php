<?php

namespace App\Http\Controllers;

use App\Category;
use App\Services\ImageEditorInterface;
use App\Services\NameGenerator;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Http\Controllers\Controller;

use App\Product;
use Image;
use File;

class ProductController extends Controller
{

    private $nameGenerator;
    private $imageEditor;

    public function __construct(ImageEditorInterface $imageEditor, NameGenerator $nameGenerator)
    {
        $this->middleware('auth', ['only' => 'store']);

        $this->nameGenerator = $nameGenerator;
        $this->imageEditor = $imageEditor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id');
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        $input = $request->input();
        $input = $this->setImage($request->file('image'), $input);
        Product::create($input);
        return redirect()->action('ProductController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::lists('name', 'id');
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreProductRequest|UpdateProductRequest|\Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $input = $request->input();
        $product = Product::findOrFail($id);
        if($request->hasfile('image')) {
            $input = $this->setImage($request->file('input'), $input);
            $this->deleteImage($product->image, $product->thumbnail);
        }
        $product->update($input);
        return redirect()->action('CategoryController@show', [$input['category_id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->deleteImage($product->image, $product->thumbnail);
        $product->delete();
    }

    /**
     * Handle Image.
     *
     * @param $image
     * @param $input
     * @return mixed
     */
    public function setImage($image, $input)
    {
        $imageName = $this->nameGenerator->getImageName();
        $thumbnailName = $this->nameGenerator->getThumbnailName();

        $image->move('images', $imageName);
        File::copy('images/' . $imageName, 'images/' . $thumbnailName);

        $input['image'] = '/images/' . $imageName;
        $input['thumbnail'] = '/images/' . $thumbnailName;

        $this->imageEditor->setImage('images/' . $thumbnailName);
        $this->imageEditor->createThumbnail();

        return $input;
    }

    /**
     * Delete image and thumbnail.
     *
     * @param $imageName
     * @param $thumbnailName
     */
    public function deleteImage($imageName, $thumbnailName)
    {
        $imageName = substr($imageName, 1);
        $thumbnailName = substr($thumbnailName, 1);
        File::delete($imageName);
        File::delete($thumbnailName);
    }
}

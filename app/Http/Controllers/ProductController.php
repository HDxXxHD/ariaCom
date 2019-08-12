<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function all_product(){
        $products = Product::with('user' , 'category')->latest()->paginate(20)->all();
        return response()->json([
            'products' => $products
        ], 200) ;
    }
    
    public function save_product(Request $request){
        // $product = new Product();
        
        // $product->pro_title = $request->pro_title;
        // $product->pro_desc = $request->pro_desc;
        // $product->category_id = $request->category_id;
        // $product->save();

        $this->validate($request,[
            'pro_title' => 'required|string|max:100',
            'pro_desc' => 'required|min:2|max:191',
        ]);

        $strpos = strpos($request->pro_photo, ';');
        $sub = substr($request->pro_photo, 0,$strpos);
        $ex = explode('/' , $sub)[1];
        $name = time().'.'.$ex;

        $img = Image::make($request->pro_photo);
        $upload_path = public_path()."/img/";
        $img->save($upload_path.$name);

        auth()->user()->products()->create(array_merge($request->all() , ['pro_photo' => $name]));

        
    }

    public function edit_product($id)
    {
      
        $product = Product::find($id);
        return response()->json([
           'product' => $product
        ], 200);
    }

    public function ckUpload(Request $request)
    {
        $this->validate($request, [
            'upload' => ['required', 'image']
        ]);

        try {
            $file = $request->upload;
            $path = str_replace('local/public/', '', public_path('/img'));
            $name = round(microtime(true) * 1000) . '-' . rand(100000, 999999) . '.';
            //Display File Mime Type
            $fileMimeType = $file->getMimeType();
            $name = $name . str_after($fileMimeType, '/');

            $file->move(($path), $name);

            return  response()->json(['fileName'=>$name,'uploaded'=>1,'url'=>'/img/' . $name],200);        } catch (\Exception $exception) {
           return httpStatusCode::status500();
        }
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);

        $this->validate($request,[
            'pro_title' => 'required|string|max:100',
            'pro_desc' => 'required|min:2|max:191',
        ]);

        $inputes = $request->all();
            if($request->pro_photo!=$product->pro_photo){
                $strpos = strpos($request->pro_photo, ';');
                $sub = substr($request->pro_photo, 0,$strpos);
                $ex = explode('/' , $sub)[1];
                $name = time().'.'.$ex;
        
                $img = Image::make($request->pro_photo);
                $upload_path = public_path()."/img/";
                $img->save($upload_path.$name);

                $inputes['pro_photo'] = $name;

            }else{
                $inputes['pro_photo'] = $product->pro_photo;
            }
            $product->update($inputes);
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        $image_path = public_path() . "/img/";
        $image = $image_path . $product->pro_photo;
        if(file_exists($image)){
            @unlink($image);
        }
        $product->delete();
    }
}

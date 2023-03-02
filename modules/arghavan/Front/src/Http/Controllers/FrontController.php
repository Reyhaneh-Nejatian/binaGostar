<?php

namespace arghavan\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use arghavan\Brands\Database\Repositories\BrandRepo;
use arghavan\Category\Repositories\CategoryRepo;
use arghavan\Models\Database\Repositories\ModelRepo;
use arghavan\Payment\Repositories\CartRepo;
use arghavan\Product\Repositories\ProductRepo;
use arghavan\Slider\Database\Repositories\SliderRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class FrontController extends Controller
{
    public $repo;
    public $cartRepo;
    public function __construct(ProductRepo $repo,CartRepo $cartRepo)
    {
        $this->repo = $repo;
        $this->cartRepo = $cartRepo;
    }
    public function index()
    {
        $janebi = $this->repo->product('janebi');
        $proposal = (new ProductRepo())->proposal();
        $productNew = (new ProductRepo())->productNew();
        $brands = (new BrandRepo())->latest();
        $sliders = (new SliderRepo())->all();
        $categories = (new CategoryRepo())->tree();


        return response()->json([$janebi,$brands,$sliders,$categories,$productNew,$proposal]);
    }



    public function singleProduct($id,ProductRepo $productRepo)
    {
        $product = $productRepo->find($id);
        return response()->json([$product]);
    }

    public function product($slug)
    {

        $products = $this->repo
            ->filterBrand(request('brand'))
            ->filterModel(request('model'))
            ->filterPrice(request('price'));

        $products = $products->product($slug);
        $models = (new ModelRepo())->models($slug);
        $brands = (new BrandRepo())->brands($slug);
        return response()->json([$products,$models,$brands]);
    }

    public function addToCart($id)
    {
        $product = $this->repo->findById($id);
        if(auth('api')->check())
        {
            $cart = $this->cartRepo->store($product);
            return response()->json('محصول با موفقیت به سبد خرید اضافه شد!');
        }

    }

    public function addCart(Request $request)
    {
        $this->cartRepo->add($request);
    }

    public function removeCart($id)
    {
        $product = $this->repo->findById($id);
        if(auth('api')->check())
        {
            //کاربر لاگین کرده
            $cart = $this->cartRepo->removeCart($product);
            if($cart == 2)
            {
                return response()->json('محصول موردنظر از سبد خرید کم شد.');
            }
            elseif ($cart == 1)
            {
                return response()->json('محصول موردنظر از سبد خرید حذف شد.');
            }
        }
    }

    public function remove($id)
    {
        $product = $this->repo->findById($id);
        if(auth('api')->check())
        {
            //کاربر لاگین کرده
            $this->cartRepo->remove($product);
            return response()->json('محصول موردنظر از سبد خرید حذف شد.');
        }
    }


    public function cart()
    {
        if(auth('api')->check())
        {
            $cart = $this->cartRepo->all();
            if(count($cart) != 0)
            {
                for($i=0;$i<count($cart);$i++)
                {
                    $sumPrice = $cart[$i]->where('user_id',auth('api')->id())->sum('sumPrice');
                    $sumDiscount = $cart[$i]->where('user_id',auth('api')->id())->sum('sumDiscount');
                }
                return response()->json([$cart,'sumPrice'=>$sumPrice,'sumDiscount'=>$sumDiscount]);
            }
            else
            {
                return response()->json('محصولی در سبد خرید وجود ندارد.');
            }
        }
    }

}

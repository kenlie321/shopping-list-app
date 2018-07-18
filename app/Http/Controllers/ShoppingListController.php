<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function index(){
        $title = "Welcome to The Shopping List App!";
        return view('shoppinglist.index',['title' => $title]);
    }
    
    public function showList(){
        // $items = array();
        // return view('shoppinglist.list',['items' => $items]);
        //fizzbuzz
        for($i = 1;$i <= 100;$i++){
            if($i % 15 == 0){
                echo "<li>FizzBuzz ". $i ."</li>";
            }else if($i % 3 == 0){
                echo "<li>Fizz ". $i ."</li>";
            }else if($i % 5 == 0){
                echo "<li>Buzz ". $i ."</li>";
            }else{
                echo "<li>". $i ."</li>";
            }
        }
    }


    // public function postProducts(Request $request){
    //     $product = $request->input("product");
    //     $price = $request->input("price");
    //     $list = ["products"=>[$product],"price"=>[$price]];
    //     return view('test',['list'=>$list]);
    //     // foreach($list as $key => $val){
    //     //     for($i = 0;$i < count($val); $i++){
    //     //         echo "<li>{$key} {$val[$i]}</li>";
    //     //     }
    //     // }
    // }
}

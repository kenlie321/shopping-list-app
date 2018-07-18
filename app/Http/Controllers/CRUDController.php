<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ShoppingList;
use App\Items;
use App\User;
use DB;

class CRUDController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lists = DB::table('shopping_lists')
        //         ->where('shopping_lists.user_id','=',auth()->user()->id)
        //         ->get();
    
        //$lists = ShoppingList::orderBy('created_at','desc')->paginate(1);
        //return view('shoppinglist.list',['lists' => $lists]);
    
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('shoppinglist.list',['lists'=>$user->lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shoppinglist.addlist');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required | alpha_space',
            'description' => 'required',
            'cover' => 'image|nullable|max:1500'
        ]);

        //Handle File Upload
        if($request->hasFile('cover')){
            //Get Filename w/ Extension
            $fileNameWithExt = $request->file('cover')->getClientOriginalName();
            //Get only Filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get only Extension
            $extension = $request->file('cover')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'_'.$extension;
            //upload
            $path = $request->file('cover')->storeAs('public/cover', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //Add List
        $list = new ShoppingList;
        $list->name = $request->input('name');
        $list->description = $request->input('description');
        $list->user_id = auth()->user()->id;
        $list->cover = $fileNameToStore;
        $list->save();

        return redirect('/lists')->with('success', 'List Added');
    }

    public function storeItem(Request $request, $id){
        //var_dump($id);
        $this -> validate($request,[
            'item' => 'required',
            'price' => 'required | numeric'
        ]);

        //Add Item
        $item = new Items;
        $item->item = $request->input('item');
        $item->price = $request->input('price'); 
        $item->list_id = $id;
        $item->save();

        return redirect('/lists/'.$id)->with('success', 'Item Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user_id = ShoppingList::find($id);
        $user_id = DB::table('shopping_lists')->where('list_id','=',$id)->value('user_id');
        
        //$item = Items::find($id);
        //return view('shoppinglist.listdetail',['list'=> $list, 'item' => $item]);
        //die(var_dump($user_id));
        
        //if(auth()->user()->id !== $user_id->user_id){
        if($user_id === NULL){
            return redirect('/lists')->with('error','Record Does Not Exist');
        }
        if(auth()->user()->id !== $user_id){
            return redirect('/lists')->with('error','Unauthorized!');
        }
        $title = DB::table('shopping_lists')
                ->where('list_id', $id)
                ->value('description');
        $cover = DB::table('shopping_lists')
        ->where('list_id', $id)
        ->value('cover');
        $list = DB::table('shopping_lists')
                ->leftJoin('items','shopping_lists.list_id','=','items.list_id')
                ->select('items.item_id','items.item','items.price')
                ->where('shopping_lists.list_id','=',$id)
                ->get();
        return view('shoppinglist.listdetail')->with(['list' => $list, 'id' => $id, 'title' => $title, 'cover'=>$cover]);
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = ShoppingList::find($id);
        if(auth()->user()->id !== $list->user_id){
            return redirect('/lists')->with('error','Unauthorized!');
        }
        return view('shoppinglist.editlist')->with('list',$list);
    }

    public function editItem($id,$item_id)
    {
        $list = ShoppingList::find($id);
        
        if(auth()->user()->id !== $list->user_id){
            return redirect('/lists')->with('error','Unauthorized!');
        }

        $items = DB::table('shopping_lists')
            ->leftJoin('items','shopping_lists.list_id','=','items.list_id')
            ->select('items.item_id','items.item','items.price')
            ->where([['shopping_lists.list_id','=',$id], ['items.item_id','=',$item_id]])
            ->get();
        //var_dump($item);
        return view('shoppinglist.edititem')->with(['items'=>$items,'id' => $id]);
    }
    
    public function addItem($id)
    {
        $list = ShoppingList::find($id);
        
        if(auth()->user()->id !== $list->user_id){
            return redirect('/lists')->with('error','Unauthorized!');
        }
        
        return view('shoppinglist.additem')->with('id',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|alpha_space',
            'description' => 'required',
            'cover' => 'image|nullable|max:1500'
        ]);
        
        //Handle File Upload
        if($request->hasFile('cover')){
            //Get Filename w/ Extension
            $fileNameWithExt = $request->file('cover')->getClientOriginalName();
            //Get only Filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get only Extension
            $extension = $request->file('cover')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'_'.$extension;
            //upload
            $path = $request->file('cover')->storeAs('public/cover', $fileNameToStore);
        }

        //Edit List
        $list = ShoppingList::find($id);
        $list->name = $request->input('name');
        $list->description = $request->input('description');
        if($request->hasFile('cover')){
            $list->cover = $fileNameToStore;
        }
        $list->save();

        return redirect('/lists')->with('success', 'List Edited');
    }

    public function updateItem(Request $request, $id, $item_id )
    {
        $this -> validate($request,[
            'item' => 'required',
            'price' => 'required | numeric'
        ]);

        //Edit Item
        $item = Items::find($item_id);
        $item->item = $request->input('item');
        $item->price = $request->input('price'); 
        $item->save();

        return redirect('/lists/'.$id)->with('success', 'Item Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = ShoppingList::find($id);

        if(auth()->user()->id !== $list->user_id){
            return redirect('/lists')->with('error','Unauthorized!');
        }
        
        if($list->cover !== 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover/'.$list->cover);
        }

        $listDelete = DB::delete('DELETE s,i FROM shopping_lists s LEFT JOIN items i ON s.list_id = i.list_id WHERE s.list_id = '.$id);

        return redirect('/lists')->with('success','List Deleted');
    }

    public function destroyItem($id,$item_id)
    {
        $list = ShoppingList::find($id);

        if(auth()->user()->id !== $list->user_id){
            return redirect('/lists')->with('error','Unauthorized!');
        }
        $item = DB::table('items')
                ->where('item_id','=',$item_id)
                ->delete();

        return redirect('/lists/'.$id)->with('success','Item Deleted');
    }
}

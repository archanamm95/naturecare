<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\DocumentUpload;
use App\News;
use App\EventVideos;


use Auth;
use File;
use DB;
use Input;
use Redirect;
use Session;
use Storage;
use App\PurchaseHistory;
use App\AppSettings;
use App\Product;
use App\ProductHistory;
use App\Helpers\Thumbnail;


use App\Http\Controllers\user\UserAdminController;
use Response;

class DocumentController extends UserAdminController
{

    public function download()
    {

        $title = trans('download.document_download');
        $sub_title =  trans('download.document_download');
        $method  =  trans('download.document_download');
        $downloads = DocumentUpload::orderBy('created_at', 'DESC')->paginate(6);
        return view('app.user.documents.documentsupload', compact('title', 'downloads', 'sub_title', 'method'));
    }
    public function getDownload(Request $request)
    {

        $name    = $request->name;
        $file    = storage_path() . "/uploads/documents/" . $request->name;
        $headers = array(
            'Content-Type: application/pdf',
        );


        return Response::download($file, $request->name, $headers);
    }        
    public function getDownloadImage(Request $request)
    {
        

        $name    = $request->name;
        $file    = public_path() . "/uploads/documents/" . $request->name;
        $headers = array(
            'Content-Type: application/pdf',
        );


        return Response::download($file, $request->name, $headers);
    }    
    public function getDownloadInvoice(Request $request)
    {


        $name    = $request->name;
        $file    = storage_path() . "/pdf/" . $request->name;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $request->name, $headers);
    }
    
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewnews($id)
    {
        $title     =  trans('users.view_news');
        $sub_title =  trans('users.view_news');
        $base      =  trans('users.view_news');
        $method    =  trans('users.view_news');
        $post=News::find($id);
        return view('app.user.users.viewnews', compact('title', 'sub_title', 'base', 'method', 'post'));
    }
    public function allnews()
    {
        $title     =  trans('users.view_news');
        $sub_title =  trans('users.view_news');
        $base      =  trans('users.view_news');
        $method    =  trans('users.view_news');
        $news=News::orderBy('created_at', 'DESC')->paginate(6);
        return view('app.user.users.allnews', compact('title', 'sub_title', 'base', 'method', 'news'));
    }

    public function allvideos()
    {
        $title     =  trans('users.videos');
        $sub_title =  trans('users.videos');
        $base      =  trans('users.videos');
        $method    =  trans('users.videos');
        $videos=EventVideos::all();
        $result=array();
        foreach ($videos as $key => $video) {
            $video_html=EventVideos::getVideoHtmlAttribute($video->url);
            $result[$video->id]['id']=$video->id;
            $result[$video->id]['title']=$video->title;
            $result[$video->id]['url']=$video_html;
            $result[$video->id]['created']=$video->created_at;
          # code...
        }
        // dd($result);
        // dd($result);
        return view('app.user.users.videos', compact('title', 'sub_title', 'base', 'method', 'result'));
    }
    public function Getdocument($document){
      
        $path = storage_path() . '/pdf/'.($document);
        if (!file_exists($path)) {

            return redirect('user/shop-history');

        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        return $response->header("Content-Type", $type);
      
       // return $response;
      
    }
    public function viewdoc($name)
    {
        $title     =  trans('users.view_document');
        $sub_title =  trans('users.view_document');
        $base      =  trans('users.view_document');
        $method    =  trans('users.view_document');
        $post=DocumentUpload::where('name',$name)->get();
        $post=$post[0];
         // $file    = public_path() . "/uploads/documents/" . $name;
         // return response()->file($file);

        return view('app.user.documents.viewdoc', compact('title', 'sub_title', 'base', 'method', 'post'));
    }

      public function viewinvoice($id)
    {
        

        $title     =  'Invoice';
        $sub_title =  'Invoice';
        $base      =  'Invoice';
        $method    =  'Invoice';
          
        $invoice = PurchaseHistory::where('purchase_history.id','=',$id)
                                ->join('billing_addresses','billing_addresses.id','=','purchase_history.billing_address_id')
                                ->join('packages','packages.id','=','purchase_history.package_id')
                                ->join('users','purchase_history.user_id','=','users.id')
                                ->select('purchase_history.*','billing_addresses.*','packages.package','packages.amount','users.*')->first();
                               
      $products =ProductHistory::where('product_history.purchase_history_id','=',$id)
                               ->join('product','product.id','=','product_history.product_id')
                               ->select('product.name','product.price','product_history.quantity','product_history.total_price')
                               ->get();
 
       $Grand_total   = 0;
       foreach ($products as $value) {
                      
        $Grand_total  = $Grand_total + $value->total_price;
                    
       }                     


       $company_address = AppSettings::first();

   

        return view('app.user.online_store.invoice', compact('title', 'sub_title', 'base', 'method','invoice','company_address','products','Grand_total'));
    }

                
     public function viewproducts(Request $request,$id)
    {


        $title     =  'Product History';
        $sub_title =  'Product History';
        $base      =  'Product History';
        $method    =  'Product History';
          
        $products =ProductHistory::where('product_history.purchase_history_id','=',$id)
                               ->join('product','product.id','=','product_history.product_id')
                               ->select('product.name','product.price','product_history.quantity','product_history.total_price')
                               ->get();


         return $products;
    }



      public function DownloadInvoice($id)
      {
        $title     =  'Invoice';
        $sub_title =  'Invoice';
        $base      =  'Invoice';
        $method    =  'Invoice';
          
        $invoice = PurchaseHistory::where('purchase_history.id','=',$id)
                                ->join('billing_addresses','billing_addresses.id','=','purchase_history.billing_address_id')
                                ->join('packages','packages.id','=','purchase_history.package_id')
                                ->join('users','purchase_history.user_id','=','users.id')
                                ->select('purchase_history.*','billing_addresses.*','packages.package','packages.amount','users.*')->first();

                               
       $products =ProductHistory::where('product_history.purchase_history_id','=',$id)
                               ->join('product','product.id','=','product_history.product_id')
                               ->select('product.name','product.price','product_history.quantity','product_history.total_price')
                               ->get();
 
        $Grand_total   = 0;
        foreach ($products as $value) {
                      
        $Grand_total  = $Grand_total + $value->total_price;
                    
        }                     

        $company_address = AppSettings::first();

        $pdf = \App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('app.user.online_store.Pdf_invoice',compact('title', 'sub_title', 'base', 'method','invoice','company_address','products','Grand_total'));
      
        $invoice_id= $invoice->invoice_id;

        $file_name="NaturecareInvoice".' '.$invoice_id;
        $pdf->save(storage_path('pdf/'.$file_name.'.pdf'));
        $file    = storage_path() . "/pdf/" . $file_name.'.pdf';
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, "NaturecareInvoice", $headers)->deleteFileAfterSend(true);
        
    }









       




}

<?php

namespace App\Http\Controllers\Admin;

use App\DocumentUpload;
use App\Settings;
use App\User;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Input;
use Redirect;
use Response;
use Session;
use App\ProductHistory;

class DocumentController extends AdminController
{

    public function upload()
    {

        $title     = trans('ticket_config.file_upload');
        $sub_title = trans('ticket_config.file_upload');
        $base      = trans('ticket_config.file_upload');
        $method    = trans('ticket_config.file_upload');

        $uploads = DocumentUpload::paginate(10);

        return view('app.admin.documents.documentsupload', compact('title', 'sub_title', 'base', 'method', 'uploads'));
    }

    public function uploadfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file'   => 'required|mimes:doc,pdf,docx,png,jpg,jpeg',
            'thump'   => 'required|mimes:doc,pdf,docx,png,jpg,jpeg',
            'shorttext'=> 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => trans('ticket_config.uploaded_failed')));
            return Redirect::back();
        } else {
            if (Input::hasFile('file')) {
                $fileName1 = 'no';
                $destinationPath = storage_path() . '/uploads/documents';
                $extension       = Input::file('file')->getClientOriginalExtension();
                $fileName        = rand(000011111, 99999999999) . '.' . $extension;
                Input::file('file')->move($destinationPath, $fileName);                
                if (Input::hasFile('thump')) {
                    $destinationPath1 = public_path() . '/uploads/documents';
                    $extension1       = Input::file('thump')->getClientOriginalExtension();
                    $fileName1        = rand(000011111, 99999999999) . '.' . $extension1;
                    Input::file('thump')->move($destinationPath1, $fileName1);
                }


                DocumentUpload::create([
                'file_title' => $request->title,
                'name'       => $fileName,
                'thumnail'       => $fileName1,
                'content'        => $request->summernoteInput,
                'sub_text'        => $request->shorttext,
                ]);

                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.uploaded_success')));
                return Redirect::back();
            }
        }


        
        Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('ticket_config.no_file')));
        return Redirect::action('Admin\DocumentController@upload');
    }
    public function deletedocument(Request $request)
    {

        $requestid = $request->requestid;
        $res       = DocumentUpload::where('id', $requestid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.document_details')));
        return Redirect::action('Admin\DocumentController@upload');
    }    
    public function deletedownload($id)
    {

        $requestid = $id;
        $res       = DocumentUpload::where('id', $requestid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Document Deleted'));
        return Redirect()->back();
    }

    public function updatedocument(Request $request)
    {




        if (Input::hasFile('file')) {
            $requestid = $request->requestid;

            $destinationPath = public_path() . '/assets/uploads';
            $extension       = Input::file('file')->getClientOriginalExtension();
            $fileName        = rand(000011111, 99999999999) . '.' . $extension;


      
      
                $mimetype = File::mimeType($file);
                $filesize = File::size($file);



                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);
                $filename = $this->sanitize($originalNameWithoutExt);
                $allowed_filename = $this->createUniqueFilename($filename, $extension);
                
            if (substr($file->getMimeType(), 0, 5) == 'image') {
                $uploadSuccess1 = $this->original($file, $allowed_filename, $type);
                if (!$uploadSuccess1) {
                    return Response::json([
                        'error' => true,
                        'message' => 'Server error while uploading',
                        'code' => 500
                    ], 500);
                }
            } else {
                $uploadSuccess = $this->originalNoImage($file, $allowed_filename, $type);
                if (!$uploadSuccess) {
                    return Response::json([
                        'error' => true,
                        'message' => 'Server error while uploading',
                        'code' => 500
                    ], 500);
                }
            }


            Input::file('file')->move($destinationPath, $fileName);

            DocumentUpload::where('id', $requestid)->update(array('file_title' => $request->file_title, 'name' => $fileName));
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.document_updated')));
            return Redirect::action('Admin\DocumentController@upload');
        } else {
            $requestid = $request->requestid;
            DocumentUpload::where('id', $requestid)->update(array('file_title' => $request->file_title));
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.document_updated')));
            return Redirect::action('Admin\DocumentController@upload');
        }
    }

    public function getDownload(Request $request)
    {
        $name    = $request->name;
        $file    = storage_path() . "/uploads/documents/" . $request->name;
        $headers = array(
            'Content-Type: application/pdf',
        );


        return Response::download($file, $request->name, $headers);
        //dd($name);
    }   
    public function getDownloadId(Request $request)
    {
        $name    = $request->name;
        $file    = public_path() . "/uploads/documents/" . $request->name;
        $headers = array(
            'Content-Type: application/pdf',
        );


        return Response::download($file, $request->name, $headers);
        //dd($name);
    }

    public function uploadusers()
    {
        $title     = trans('ticket_config.upload_users');
        $sub_title = trans('ticket_config.upload_users');
        $base      = trans('ticket_config.upload_users');
        $method    = trans('ticket_config.upload_users');
        $doc=Settings::find(1)->uploadusers;
         return view('app.admin.documents.userupload', compact('title', 'sub_title', 'base', 'method', 'doc'));
    }

    public function postuploadusers(Request $request)
    {


            ini_set('memory_limit', '12800M');
            ini_set('max_execution_time', 1000);

        $validator = Validator::make($request->all(), [
            'file'   => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => trans('ticket_config.uploaded_failed')));
            return Redirect::back();
        }

        if (Input::hasFile('file')) {
            $destinationPath = storage_path() . '/uploads/documents';
            $extension       = Input::file('file')->getClientOriginalExtension();
            $fileName        = rand(000011111, 99999999999) . '.' . $extension;
            Input::file('file')->move($destinationPath, $fileName);

            $array =Excel::toArray(new UsersImport, storage_path(). '/uploads/documents/'.$fileName);

            if (count($array[0]) > 1) {
                Settings::where('id', 1)->update(['uploadusers' => $fileName]);

                    
                User::uploadusers($array[0]);
                Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.uploaded_success')));
                return Redirect::back();
            } else {
                Session::flash('flash_notification', array('level' => 'error', 'message' => trans('ticket_config.please_check_the_file')));
                return Redirect::back();
            }
        }
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













}

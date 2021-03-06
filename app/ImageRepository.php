<?php

namespace App;

use App\Image;
use App\Models\ControlPanel\Options;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Storage;
use App\Packages;

class ImageRepository
{
    public function upload($form_data)
    {
    
        $validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {
            return Response::json([
                'error'   => true,
                'message' => $validator->messages()->first(),
                'code'    => 400,
            ], 400);
        }

        // if(Auth::user()->id == 1){
        //      return Response::json([
        //             'error'   => true,
        //             'message' => 'Sorry, You dont have permission',
        //             'code'    => 500,
        //         ], 500);

        // }



        // echo "QQQQQQQQQQQQQ";die();

        $file = $form_data['file'];
        

        if (Auth::id() == 1) {
            if (isset($form_data['user_id'])) {
                if (User::where('id', '=', $form_data['user_id'])->exists()) {
                    $user_id = $form_data['user_id'];
                } else {
                    return;
                }
            } else {
                $user_id = Auth::id();
            }
        } else {
            $user_id = Auth::id();
        }

        /**
         * define type as input hidden in form so we can add to DB, and access for future
         * @var [type] / profile, cover
         */
        if (isset($form_data['type']) && $form_data['type'] != 1) {
            $type = $form_data['type'];
        } else {
            $type = null;
        }

        if (isset($form_data['in_album']) && $form_data['in_album'] != 1) {
            $in_album = $form_data['in_album'];
        } else {
            $in_album = false;
        }
        if (isset($form_data['album_id']) && $form_data['album_id'] != 1) {
            $album_id = $form_data['album_id'];
        } else {
            $album_id = null;
        }

        $mimetype = File::mimeType($file);
        $filesize = File::size($file);

        $originalName           = $file->getClientOriginalName();
        $extension              = $file->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);
        $filename               = $this->sanitize($originalNameWithoutExt);
        $allowed_filename       = $this->createUniqueFilename($filename, $extension);

        if (substr($file->getMimeType(), 0, 5) == 'image') {
            $uploadSuccess1 = $this->original($file, $allowed_filename, $type);
            if (!$uploadSuccess1) {
                return Response::json([
                    'error'   => true,
                    'message' => 'Server error while uploading',
                    'code'    => 500,
                ], 500);
            }
        } else {
            $uploadSuccess = $this->originalNoImage($file, $allowed_filename, $type);
            if (!$uploadSuccess) {
                return Response::json([
                    'error'   => true,
                    'message' => 'Server error while uploading',
                    'code'    => 500,
                ], 500);
            }
        }
        // dd($form_data);

        $attachment                    = new Image;
        $attachment->filename          = $allowed_filename;
        $attachment->original_filename = $originalName;
        $attachment->mimetype          = $mimetype;
        $attachment->filesize          = $filesize;
        $attachment->author            = Auth::id();
        $attachment->thumbnailable     = true;
        $attachment->type              = $type;
        $attachment->in_album          = $in_album;
        $attachment->album_id          = $album_id;

        $attachment->save();

        if ($type === 'profile') {
            self::destroyProfilePic($user_id);
            self::updateProfilePic($allowed_filename, $user_id);
        } elseif ($type === 'cover') {
            self::destroyCoverPic($user_id);
            self::updateCoverPic($allowed_filename, $user_id);
        }
        if ($type === 'package_image') {
            $package_id = $form_data['pack_id'];

            self::updatepackagePic($allowed_filename, $package_id);
        }
        if ($type === 'package_image') {
            $package_id = $form_data['pack_id'];

            self::updatepackagePic($allowed_filename, $package_id);
        }
        if ($type === 'product_image') {
            $package_id = $form_data['pack_id'];
             $destinationPath =public_path() . '/products';
                
                $filename = $allowed_filename;
                $upload_success = $file->move($destinationPath, $filename);

            self::updateproductPic($allowed_filename, $package_id);
        }

        if ($type === 'logo') {
            $logo_id = $form_data['logo_id'];

            self::updatelogoPic($allowed_filename, $logo_id);
        }
        if ($type === 'logoicon') {
            $logoicon_id = $form_data['logoicon_id'];

            self::updatelogoiconPic($allowed_filename, $logoicon_id);
        }



        if ($type === 'logo_light' || $type == 'logo_dark' || $type == 'logo_icon_light' || $type == 'logo_icon_dark') {
            self::updateLogo($allowed_filename, $type);
        }

        return Response::json([
            'uploaded' => $allowed_filename,
            // 'error' => false,
            'message'  => 'Uploaded successfully',
            'code'     => 200,
            'filename' => $allowed_filename,
        ], 200);
    }

    public function updateLogo($allowed_filename, $type)
    {
        Options::updateOptionByKey('app.'.$type, $allowed_filename);
        // $logo_type_option        = Options::where('key', 'app.' . $type)->first();
        // $logo_type_option->value = $allowed_filename;
        // $logo_type_option->save();
    }

    public function updateProductPic($allowed_filename, $product)
    {
        $userprofile = Product::where('id', $product)->update(['image' => $allowed_filename]);
    }
    public function updateProfilePic($allowed_filename, $user_id = "")
    {
        $userprofile = ProfileInfo::where('user_id', $user_id)->update(['profile' => $allowed_filename]);
    }
    public function updatepackagePic($allowed_filename, $package_id)
    {
        $userprofile = packages::where('id', $package_id)->update(['image' => $allowed_filename]);
    }

    public function updatelogoPic($allowed_filename, $logo_id)
    {
        $userprofile = AppSettings::where('id', $logo_id)->update(['logo' => $allowed_filename]);
    }

    public function updatelogoiconPic($allowed_filename, $logoicon_id)
    {
        $userprofile = AppSettings::where('id', $logoicon_id)->update(['logo_ico' => $allowed_filename]);
    }


    public function updateCoverPic($allowed_filename, $user_id)
    {
// dd($user_id);

        $userprofile = ProfileInfo::where('user_id', $user_id)->update(['cover' => $allowed_filename]);
    }

    public function destroyProfilePic($user_id)
    {
        $currentProfilePic = ProfileInfo::where('user_id', $user_id)->value('profile');
        if ($currentProfilePic === 'avatar-big.png') {
            return;
        } else {
            Image::where('filename', $currentProfilePic)->delete();
            $exists = Storage::disk('images')->exists($currentProfilePic);
            if ($exists) {
                Storage::disk('images')->delete($currentProfilePic);
            }
        }
    }

    public function destroyCoverPic($user_id)
    {
        $currentCoverPic = ProfileInfo::where('user_id', $user_id)->value('cover');
        if ($currentCoverPic === 'cover.jpg') {
            return;
        } else {
            Image::where('filename', $currentCoverPic)->delete();
            $exists = Storage::disk('images')->exists($currentCoverPic);
            if ($exists) {
                Storage::disk('images')->delete($currentCoverPic);
            }
        }
    }

    public function createUniqueFilename($filename, $extension)
    {

        $exists = Storage::disk('images')->exists($filename . '.' . $extension);

        if ($exists) {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }

    /**
     * Optimize Original Image
     */
    public function original($file, $filename, $type)
    {
        if ($type == 'logo' || $type == 'logoicon') {
            $file = Storage::disk('logo')->put($filename, file_get_contents($file));
        } else {
            $file = Storage::disk('images')->put($filename, file_get_contents($file));
        }

        return $file;
    }
    /**
     * Create Icon From Original
     */
    public function icon($file, $filename)
    {
        // $manager = new ImageManager();
        // $file = $manager->make( $file )->resize(200, null, function ($constraint) {
        //     $constraint->aspectRatio();
        //     });
        // $file = $manager->make( $file );
        // $file =  Storage::disk('images')->put($filename, $file);
        //     // ->save( Config::get('images.icon_size')  . $filename );
        // return $file;
        return true;
    }

    /**
     * Save file that is not an image
     */
    public function originalNoImage($file, $filename)
    {

        $file = Storage::disk('images')->put($filename, file_get_contents($file));
        //GET FILE AS $file = Storage::disk('images')->get($filename);
        return $file;
    }
    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete($originalFilename)
    {

        $sessionImage = Image::where('original_filename', 'like', $originalFilename)->first();

        if (empty($sessionImage)) {
            return Response::json([
                'error' => true,
                'code'  => 400,
            ], 400);
        }

        $full_path1 = $full_size_dir . $sessionImage->filename;
        $full_path2 = $icon_size_dir . $sessionImage->filename;

        if (File::exists($full_path1)) {
            File::delete($full_path1);
        }

        if (File::exists($full_path2)) {
            File::delete($full_path2);
        }

        if (!empty($sessionImage)) {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200,
        ], 200);
    }

    public function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "????????", "????????", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
        mb_strtolower($clean, 'UTF-8') :
        strtolower($clean) :
        $clean;
    }
}

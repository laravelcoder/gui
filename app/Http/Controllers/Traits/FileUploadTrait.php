<?php
namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;
use FFMpeg;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\Log;
use App\Helpers\Normalize;
use App\Helpers\FFMPEG_helpers;
use App\Clip;
use App\Video;
use Illuminate\Http\UploadedFile;


trait FileUploadTrait
{

    /**
     * File upload trait used in controllers to upload files
     * FileUploadTrait::processClip();
     */
    public function saveFiles(Request $request, $video = '')
    {

        if (! file_exists(public_path().'/uploads')) { File::makeDirectory(public_path().'/uploads',0777, true);}
        if (! file_exists(public_path().'/uploads/cai')) { File::makeDirectory(public_path().'/uploads/cai',0777, true); }
        if (! file_exists(public_path().'/uploads/clips')) { File::makeDirectory(public_path().'/uploads/clips',0777, true); }
        if (! file_exists(public_path().'/uploads/images')) { File::makeDirectory(public_path().'/uploads/images',0777, true); }
        if (! file_exists(public_path().'/uploads/thumbs')) { File::makeDirectory(public_path().'/uploads/thumbs',0777, true); }

        // $clipPath = config('gui.upload_path');
        $uploadPath = env('UPLOAD_PATH', 'uploads');
        $clipPath = env('CLIP_PATH', 'uploads/clips');
        $imagePath = env('IMAGE_PATH','uploads/images');
        $thumbPath = env('THUMB_PATH','uploads/thumbs');
        $caiPath = env('CAI_PATH','uploads/cai');

        $getcai = env('CAI_SERVER');
        $transcoder = "/TOCAI.php?";

        $finalRequest = $request;

        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {

                if ($request->has($key . '_max_width') && $request->has($key . '_max_height')) {
                    
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $file     = $request->file($key);
                    $image    = Image::make($file);

                    if (! file_exists($thumbPath)) {
                        mkdir($thumbPath, 0775, true);
                    }
                    Image::make($file)->resize(50, 50)->save($thumbPath . '/' . $filename);
                    $width  = $image->width();
                    $height = $image->height();
                    if ($width > $request->{$key . '_max_width'} && $height > $request->{$key . '_max_height'}) {
                        $image->resize($request->{$key . '_max_width'}, $request->{$key . '_max_height'});
                    } elseif ($width > $request->{$key . '_max_width'}) {
                        $image->resize($request->{$key . '_max_width'}, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } elseif ($height > $request->{$key . '_max_height'}) {
                        $image->resize(null, $request->{$key . '_max_height'}, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    $image->save($imagePath . '/' . $filename);
                    $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));
                } else {
                    Log::info("UPLOAD FUNCTION STARTED SUCCESSFULLY");
                    $filename = $request->file($key)->getClientOriginalName();
                    $extension = $request->file($key)->getClientOriginalExtension();
                    if(preg_match('/^.*\.(mp4|mov|mpg|mpeg|wmv|mkv)$/i', $filename)){
                       
                        $filename = $request->file($key)->getClientOriginalName();
                        $basename = substr($filename, 0, strrpos($filename, "."));
                        $basename = Normalize::titleCase($basename);
                        $ad_duration = FFMPEG_helpers::getDuration($request->file($key));
 
                        $filename = str_slug($basename) . '.' . $extension;
                        $request->file($key)->move($clipPath, $filename);
                        $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename, 'video' => $request->video, 'extention' => $extension, 'name'=> $basename, 'ad_duration'=>$ad_duration]));

                        $file_w_path = $clipPath . "/" . $filename;

                        // try {
                        //     $ffmpeg = FFMpeg::create();

                        //     $media = FFMpeg::fromFilesystem($clipPath)->open($filename);

                        //     FFMpeg::fromDisk($clipPath)
                        //             ->open($filename)
                        //             ->getFrameFromSeconds(10)
                        //             ->export()
                        //             ->toDisk($thumbPath)
                        //             ->save('FrameAt10sec.png');

                        //     $durationInSeconds = $media->getDurationInSeconds(); // returns an int
                        //     $durationInMiliseconds = $media->getDurationInMiliseconds(); // returns a float
                        // }catch (Exception $e) {
                        //     //exception handling code goes here
                        // }

                        try {
                            Log::info("INIT CURL TOCAI");
                            $ch = curl_init();
                            // curl_setopt($ch,CURLOPT_URL,"". $getcai . $transcoder .  $file_w_path ."");
                            curl_setopt($ch,CURLOPT_URL,"http://d-gp2-tocai-1.imovetv.com/TOCAI.php?http://d-gp2-caipyascs0-1.imovetv.com/ftp/downloads/coca-cola.mp4");
                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                            $output = curl_exec($ch);
                            file_put_contents($caiPath . "/" . str_slug($basename) . '.cai', $output);
                            Log::info("SAVED CAI FILE");
                            curl_close($ch);
                        }
                        catch (Exception $e) {
                            //exception handling code goes here
                        }

                    }else{
                        $filename = $request->file($key)->getClientOriginalName();
                        $filename = preg_replace('/([^.a-z0-9]+)/i', '-', $filename);
                        $filename = str_replace(' ', '_', strtolower($filename));
                        $request->file($key)->move($uploadPath, $filename);
                        $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));
                    }
                }
            }
        }

        return $finalRequest;
    }

    public static function processClip($data = '')
    {
        $clipPath = public_path(env('CLIP_PATH'));
        $uploadPath = public_path(env('UPLOAD_PATH'));
        $imagePath = public_path(env('UPLOAD_PATH').'/images');
        $thumbPath = public_path(env('UPLOAD_PATH').'/thumb');
        $caiPath = public_path(env('UPLOAD_PATH').'/cai');

        if (! file_exists($uploadPath)) {
            mkdir($clipPath, 0775);
            mkdir($uploadPath, 0775);
            mkdir($thumbPath, 0775);
            mkdir($imagePath, 0775);
            mkdir($caiPath, 0775);
        }

        if (! file_exists($caiPath)) {
            mkdir($caiPath, 0775);
        }

        $getcai = env('CAI_SERVER');  // http://d-gp2-tocai-1.imovetv.com/TOCAI.php?
        $transcoder = "/TOCAI.php?";

        $finalRequest = $request;

        $filename = $request->file($key)->getClientOriginalName();
        $extension = $request->file($key)->getClientOriginalExtension();
        if(preg_match('/^.*\.(mp4|mov|mpg|mpeg|wmv|mkv)$/i', $filename)){
            //Log::info('passed valication: '.$filename);
            $filename = $request->file($key)->getClientOriginalName();
 

            $basename = substr($filename, 0, strrpos($filename, "."));   
                             
            $filename = str_slug($basename) . '.' . $extension;
            $request->file($key)->move($clipPath, $filename);
            $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));

            $file_w_path = $clipPath . "/" . $filename;
            try {
                $ch = curl_init();  
                curl_setopt($ch,CURLOPT_URL,"". $getcai . $transcoder .  $file_w_path ."");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $output = curl_exec($ch);
                if(!curl_exec($ch)){
                    //die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                }

                file_put_contents($caiPath . "/" . str_slug($basename) . '.cai',$output);
                curl_close($ch);

            }
            catch (Exception $e) {
                //exception handling code goes here
                echo $file_w_path."\n";
                echo $getcai . $transcoder .  $clipPath . "/" . $filename."\n";
            }
        }

        return $finalRequest;
    }
}



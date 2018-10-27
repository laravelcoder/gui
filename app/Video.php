<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


/**
 * Class Video
 *
 * @package App
 * @property string $clip
 * @property string $name
 * @property string $video
 * @property string $extention
 * @property string $ad_duration
*/
class Video extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes;

    protected $fillable = ['name', 'video', 'extention', 'ad_duration', 'clip_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClipIdAttribute($input)
    {
        $this->attributes['clip_id'] = $input ? $input : null;
    }
    
    public function clip()
    {
        return $this->belongsTo(Clip::class, 'clip_id')->withTrashed();
    }
    
}

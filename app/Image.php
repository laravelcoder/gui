<?php
namespace App;
 
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Image
 *
 * @package App
 * @property string $image
*/
class Image extends Model  implements HasMedia
{
    use HasMediaTrait;
  
    protected $fillable = ['image', 'clip_id'];
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

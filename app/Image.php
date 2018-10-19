<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @package App
 * @property string $image
*/
class Image extends Model
{
    protected $fillable = ['image'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
}

<?php

namespace Modules\Konten\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Episode extends Model
{
    use Sluggable, SoftDeletes;

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'episode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'anime_id',
        'title',
        'video',
        'embeds'
    ];

    protected $casts = [ 'embeds' => 'array' ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be appends for arrays.
     *
     * @var array
     */
    /**
     * Get the model's url ktp pemohon file.
     *
     * @param  string  $value
     * @return string
     */

    protected $appends = [
        'link_video',
    ];

    public function getLinkVideoAttribute()
    {
        return (!empty($this->attributes['video'])) ? Storage::disk('public')->url('anime/video/'.$this->attributes['video']) : null;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


   


    /**
     * Get the relationship for the model.
     */
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}

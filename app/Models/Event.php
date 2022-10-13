<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Events\EventCreated;
use App\Traits\IdAsUuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use IdAsUuidTrait, HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'startAt', 'endAt'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $dispatchesEvents = [
        'created' => EventCreated::class
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($event) {

            $event->slug = $event->createSlug($event->name);

            $event->save();
        });
    }

    private function createSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {

            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');

            if (isset($max[-1]) && is_numeric($max[-1])) {

                return preg_replace_callback('/(\d+)$/', function ($mathces) {

                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}

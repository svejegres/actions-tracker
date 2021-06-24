<?php

namespace App\Models;

use App\Services\ActionsService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'time', // such column does not exist, we use this attribute for setTimeAttribute mutator
    ];

    /**
     * Set minutes spent.
     *
     * @param  string  $value
     * @return void
     */
    public function setTimeAttribute(string $value)
    {
        $this->attributes['minutes_spent'] = (new ActionsService())->getTimeInMinutes($value);
    }

    /**
     * Get time.
     *
     * @param  string  $value
     * @return string
     */
    public function getMinutesSpentAttribute(string $value): string
    {
        return (new ActionsService())->getMinutesInTime($value);
    }

    /**
     * @return array
     */
    public static function getTodaysActions(): array
    {
        return Action::select('id', 'title', 'description', 'minutes_spent')
                        ->whereDay('created_at', date('d'))
                        ->orderBy('id', 'desc')
                        ->get()
                        ->groupBy('title')
                        ->toArray();
    }
}

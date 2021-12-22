<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AnimalUser extends Pivot
{
    /** HUNGER update frequency in minutes */
    public const HUNGER_FREQUENCY = 10;
    /** SLEEP update frequency in minutes */
    public const SLEEP_FREQUENCY = 20;
    /** CARE update frequency in minutes */
    public const CARE_FREQUENCY = 15;
    /** Care divider - depending of sleep value **/
    public const CARE_DIVIDER = 3;
    /** INCREMENT update frequency in minutes */
    public const INCREMENT_FREQUENCY = 5;
    /** MAX property value **/
    public const MAX_VALUE = 100;
    /** MIN property value **/
    public const MIN_VALUE = 0;
    /** Sleep property critical value **/
    public const SLEEP_CRITICAL_SP = 5;

    protected $fillable = ['*'];

    public $timestamps = false;

    /** Possible to increment property */
    public function canIncrement(string $property_title): bool
    {
        return $this->{$property_title} < self::MAX_VALUE
            && $this->alive == 1
            && Carbon::parse($this->{$property_title . '_increment_at'})->diffInMinutes() > self::INCREMENT_FREQUENCY;
    }

    /** Possible to decrement property */
    public function canDecrement(string $property_title): bool
    {
        if ($property_title === 'care' && $this->sleep < self::SLEEP_CRITICAL_SP) {
            $frequency = self::CARE_FREQUENCY / self::CARE_DIVIDER;
        } else {
            $frequency = constant('self::' . strtoupper($property_title) . '_FREQUENCY');
        }
        return $this->{$property_title} > self::MIN_VALUE
            && Carbon::parse($this->{$property_title . '_decrement_at'})->diffInMinutes() > $frequency;
    }

    /** Possible to reset alive property */
    public function canDie(): bool
    {
        return $this->sleep < 1 || $this->care < 1 || $this->hunger < 1;
    }
}

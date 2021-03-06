<?php

namespace MoinFood\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [
        'id',
    ];

    public function restaurantType() {
        return $this->belongsTo(RestaurantType::class, 'restaurant_type_id');
    }

    public function place() {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function openingTimes() {
        return $this->hasMany(OpeningTime::class, 'restaurant_id');
    }

    public function images() {
        return $this->hasMany(Image::class, 'restaurant_id');
    }

    public function properties() {
        return $this->belongsToMany(Property::class, 'restaurants_properties');
    }

    public function kitchens() {
        return $this->belongsToMany(Kitchen::class, 'restaurants_kitchens');
    }

    public function events() {
        return $this->belongsToMany(Event::class, 'restaurants_events');
    }

    public function hasKitchen($kitchen) {
        return(in_array($kitchen->id, $this->kitchens()->pluck('id')->all()));
    }

    public function hasEvent($event) {
        return(in_array($event->id, $this->events()->pluck('id')->all()));
    }

    public function hasProperty($property) {
        return(in_array($property->id, $this->properties()->pluck('id')->all()));
    }

    public function hasImage() {
        return $this->images()->count() > 0;
    }

    public function getImage() {
        return $this->images()->first();
    }

    public function getRatingInWords($rating) {
        switch($rating) {
            case 3:
                return 'Perfekt';
                break;
            case 2:
                return 'Sehr Gut';
                break;
            case 1:
                return 'Gut';
                break;
            default:
                return 'Unbekannt';
                break;
        }
    }
}

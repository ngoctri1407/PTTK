<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed email
 * @property mixed time
 * @property mixed property_id
 * @property mixed fcm_token
 * @property string status
 * @property mixed phone
 */
class Booking extends Model
{
  protected $table = 'booking';
}

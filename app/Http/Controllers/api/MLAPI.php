<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Support\Str;
use MailerLite\MailerLite;

class MLAPI extends Controller
{

  private $apiKey;

  public function __construct()
  {
    $database = Config::select('value')->where('type', 'apiKey')->first();
    $this->apiKey = $database->value;
  }

  /**
   * Create a new subscriber
   *
   * @param string $email
   * @param string $name
   * @param string $country
   */
  public static function NewSubscriber($email, $name, $country)
  {
    $self = new static;

    $mailerLite = new MailerLite(['api_key' => $self->apiKey]);

    $data = [
      'email' => $email,
      'fields' => [
        'name' => $name,
        'country' => $country
      ],
    ];

    return $mailerLite->subscribers->create($data);
  }

  /**
   * Get all subscribers
   *
   */
  public static function GetSubscribers()
  {
    $self = new static;

    $mailerLite = new MailerLite(['api_key' => $self->apiKey]);

    return $mailerLite->subscribers->get();
  }

  /**
   * Get a specific subscriber
   *
   * @param int $subscriberID
   */
  public static function ViewSubscriber($subscriberID)
  {
    $self = new static;

    $mailerLite = new MailerLite(['api_key' => $self->apiKey]);

    return $mailerLite->subscribers->find($subscriberID);
  }

  /**
   * Update an existing subscriber
   *
   * @param int $subscriberID
   * @param string $name
   * @param string $country
   */
  public static function UpdateSubscriber($subscriberID, $name, $country)
  {
    $self = new static;

    $mailerLite = new MailerLite(['api_key' => $self->apiKey]);

    $data = [
      'fields' => [
        'name' => $name,
        'country' => $country
      ],
    ];

    return $mailerLite->subscribers->update($subscriberID, $data);
  }

  /**
   * Delete a subscriber
   *
   * @param int $subscriberID
   */
  public static function DeleteSubscriber($subscriberID)
  {
    $self = new static;

    $mailerLite = new MailerLite(['api_key' => $self->apiKey]);

    return $mailerLite->subscribers->delete($subscriberID);
  }

}

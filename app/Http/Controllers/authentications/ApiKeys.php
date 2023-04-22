<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MailerLite\MailerLite;
use App\Models\Config;

class ApiKeys extends Controller
{
  /**
   * Check if API Key is valid
   * Store key if it is valid
   *
   * @param   \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(Request $request)
  {
    $mailerLite = new MailerLite(['api_key' => $request->apiKey]);

    try{
      // Check if the key works in an API call
      $mailerLite->subscribers->get();

      // Store key in database
      Config::updateOrCreate(
        ['id' => 4],
        ['value' => $request->apiKey]
      );

      return response()->json("valid key");
    } catch(\Exception $e) {
      return response()->json(['message' => "incorrect key"], 422);
    }

  }
}

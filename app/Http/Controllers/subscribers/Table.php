<?php

namespace App\Http\Controllers\subscribers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Config;
use App\Http\Controllers\api\MLAPI;

class Table extends Controller
{
  /**
   * Show the table view
   *
   */
  public function showTable()
  {
    $apiKey = Config::select('value')->where('type', 'apiKey')->first();

    if (!is_null($apiKey->value)){
      return view('content.subscribers.table');
    }else{
      $pageConfigs = ['myLayout' => 'blank'];
      return view('content.authentications.api-key-authentication', ['pageConfigs' => $pageConfigs]);
    }

  }

  /**
   * Get data for table.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $response = MLAPI::GetSubscribers();

    $data = [];

    if (empty($request->input('search.value'))) {

      $limit = $request->input('length');
      $start = $request->input('start');

      $counter = count($response['body']['data']);
      foreach ($response['body']['data'] as $info){
        $nestedData['id'] = $info['id'];
        $nestedData['subscribed_at'] = date('d/m/Y H:i:s', strtotime($info['subscribed_at']));
        $nestedData['name'] = $info['fields']['name'];
        $nestedData['email'] = $info['email'];
        $nestedData['email_verified_at'] = $info['fields']['country'];

        $data[] = $nestedData;
      }

      $data = array_slice($data, $start);

    } else {
      $limit = $request->input('length');
      $start = $request->input('start');

      $search = $request->input('search.value');

      $counter = 0;
      foreach ($response['body']['data'] as $info){
        if (str_contains($info['email'], $search)) {
          $nestedData['id'] = $info['id'];
          $nestedData['subscribed_at'] = date('d/m/Y H:i:s', strtotime($info['subscribed_at']));
          $nestedData['name'] = $info['fields']['name'];
          $nestedData['email'] = $info['email'];
          $nestedData['email_verified_at'] = $info['fields']['country'];

          $data[] = $nestedData;

          $counter ++;
        }
      }

      $data = array_slice($data, $start);
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => count($response['body']['data']),
        'recordsFiltered' => $counter,
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }

  /**
   * Create or Update a Subscriber
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $subscriberID = $request->id;

    if ($subscriberID) {
      // Attempt to update subscriber
      $response = MLAPI::UpdateSubscriber($subscriberID, $request->name, $request->country);

      // Check if subscriber updated successfully
      if ($response['status_code'] == 200){
        return response()->json("Updated");
      }elseif($response['status_code'] == 422){
        return response()->json(['message' => "invalid data"], 422);
      }
    } else {
      // Attempt to create new subscriber
      $response = MLAPI::NewSubscriber($request->email, $request->name, $request->country);

      // Check if subscriber was created successfully
      if ($response['status_code'] == 200){
        return response()->json(['message' => "already exits"], 422);
      }elseif($response['status_code'] == 422){
        return response()->json(['message' => "invalid data"], 422);
      }else{
        return response()->json("Created");
      }
    }
  }


  /**
   * Get Subscriber data for editing
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $response = MLAPI::ViewSubscriber($id);

    return response()->json($response);
  }

  /**
   * Delete Subscriber
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // Attempt to delete subscriber
    $response = MLAPI::DeleteSubscriber($id);

    // Check if subscriber was deleted successfully
    if ($response['status_code'] == 204){
      return response()->json("Deleted");
    }elseif($response['status_code'] == 404){
      return response()->json(['message' => "error"], 422);
    }

  }
}

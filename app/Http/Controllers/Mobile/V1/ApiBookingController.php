<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Booking;
use App\Account;
use App\DetailRealEstate;
use App\RealEstateCode;
use App\Http\Controllers\Controller;
use http\Exception;
use Illuminate\Http\Request;

class ApiBookingController extends Controller
{
  private $statusList = array('all', 'new', 'accepted','canceled','error');
  public function createBooking(Request $request)
  {
    try {
      $booking = new Booking();
      if (!empty($request->name)) {
        $booking->name = $request->name;
      }
      if (!empty($request->phone)) {
        $booking->phone = $request->phone;
      }
      if (!empty($request->email)) {
        $booking->email = $request->email;
      }
      if (!empty($request->time)) {
        $booking->time = $request->time;
      }
      if (!empty($request->property_id)) {
        $booking->property_id = $request->property_id;
      }
      if (!empty($request->fcm_token)) {
        $booking->fcm_token = $request->fcm_token;
      }
      $booking->status = 'new';
      
      $booking->save();
      
      // send notification to admin
      $admin_fcm_token = "";
      $admins = Account::where('role', '=', '1')->get();
      foreach ($admins as $admin) {
        $admin_fcm_token .= $admin->fcm_token;
      }
      $real_state_code = RealEstateCode::select('code')->where('id_detail_realstate', '=', $booking->property_id)->first();
      $code = $real_state_code ? $real_state_code->code : '';
      $notification = $this->sendGCM("Code: " . $code . " - Name:" . $booking->name, $admin_fcm_token);
    
      return response()->json([
        'status' => 'success',
        'error' => null,
        'data' => array('booking' => $booking, 'notification' => $notification)
      ], 200);
    } catch (Exception $e) {
      return response()->json(array(
        'status' => 'fail',
        'error' => array('message' => $e->getMessage()),
        'data' => null
      ), 200);
    }
  }

  public function loginBooking(Request $request) {
    try {
      $this->validate($request, [
        'username' => 'required',
        'password' => 'required',
        'fcm_token' => 'required'
      ]);
    
      $account = Account::where('username','=',$request->username)->where('password','=',MD5($request->password))->first();
      if ($account == null) {
        return response()->json(array(
          'status' => 'fail',
          'error' => array('message' => 'wrong username or password'),
          'data' => null
        ), 200);
      }
      
      $fcm_token_list = explode(",", $account->fcm_token);
      for ($i = 0; $i < sizeof($fcm_token_list); $i++) {
        if ($fcm_token_list[$i] == $request->fcm_token) {
          return response()->json([
            'status' => 'success',
            'error' => null,
            'data' => $account->id
          ], 200);
        }
      }
      
      array_push($fcm_token_list,$request->fcm_token);
      $fcm_token_comma = implode(",", $fcm_token_list);
      $account->fcm_token = $fcm_token_comma;
      $account->save();
    
      return response()->json([
        'status' => 'success',
        'error' => null,
        'data' => $account->id
      ], 200);
    } catch (Exception $e) {
      return response()->json(array(
        'status' => 'fail',
        'error' => array('message' => $e->getMessage()),
        'data' => null
      ), 200);
    }
  }
  
  public function logoutBooking(Request $request) {
    try {
      $this->validate($request, [
        'username' => 'required',
        'fcm_token' => 'required'
      ]);
    
      $account = Account::where('username','=',$request->username)->first();
      if ($account == null) {
        return response()->json(array(
          'status' => 'fail',
          'error' => array('message' => 'user not found'),
          'data' => null
        ), 200);
      }
    
      $fcm_token_list = explode(",", $account->fcm_token);
      for ($i = 0; $i < sizeof($fcm_token_list); $i++) {
        if ($fcm_token_list[$i] == $request->fcm_token) {
          array_splice($fcm_token_list, $i, 1);
        }
      }
    
      $fcm_token_comma = implode(",", $fcm_token_list);
      $account->fcm_token = $fcm_token_comma;
      $account->save();
    
      return response()->json([
        'status' => 'success',
        'error' => null,
        'data' => $account->id
      ], 200);
    } catch (Exception $e) {
      return response()->json(array(
        'status' => 'fail',
        'error' => array('message' => $e->getMessage()),
        'data' => null
      ), 200);
    }
  }
  
  public function confirmBooking(Request $request) {
    $this->validate($request, [
      'id' => 'required',
      'status' => 'required'
    ]);
  
    $reservation = Booking::where('id', '=', $request->id)->first();
    if ($reservation == null) {
      return response()->json(array(
        'status' => 'fail',
        'error' => array('message' => 'reservation not found'),
        'data' => null
      ), 200);
    }
  
    if (!in_array($request->status, $this->statusList)) {
      return response()->json(array(
        'status' => 'fail',
        'error' => array('message' => 'status is invalid'),
        'data' => null
      ), 200);
    }
    
    $reservation->status = $request->status;
    
    $reservation->save();
  
    $notification = $this->sendGCM($request->status . ": Your reservation has been " . $request->status, $reservation->fcm_token);
  
    return response()->json([
      'status' => 'success',
      'error' => null,
      'data' => array('notification' => $notification)
    ], 200);
  }
  
  public function getListBooking(Request $request) {
    $this->validate($request, [
      'status' => 'required'
    ]);
  
    if (!in_array($request->status, $this->statusList)) {
      return response()->json(array(
        'status' => 'fail',
        'error' => array('message' => 'status is invalid'),
        'data' => null
      ), 200);
    }
    
    $query = Booking::query();
    
    if ($request->status == 'all') {
      $reservationList = $query->select('*')->from('booking')->paginate(12);
    } else {
      $reservationList = $query->select('*')->from('booking')->where('status', '=', $request->status)->paginate(12);
    }
  
    $size = count($reservationList);
    for ($i = 0; $i < $size; $i++) {
      $real_state = DetailRealEstate::select('title_en', 'title_vi')->where('id' , '=', $reservationList[$i]->property_id)->first();
      $reservationList[$i]->title_en = $real_state ? $real_state->title_en : '';
      $reservationList[$i]->title_vi = $real_state ? $real_state->title_vi : '';
  
      $real_state_code = RealEstateCode::select('code')->where('id_detail_realstate', '=', $reservationList[$i]->property_id)->first();
      $reservationList[$i]->code = $real_state_code ? $real_state_code->code : '';
    }
  
    return response()->json([
      'reservationList' => $reservationList
    ], 200);
  }

  private function sendGCM($message, $id) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    
    $fields = array (
      'registration_ids' => explode(",", $id),
      'notification' => array (
        "title" => 'SGHome: Booking!',
        "body" => $message,
        "badge" => 0,
        "sound" => 1,
        "color" => "#ffffff",
        'vibrate'    => 1
      ),
      'priority' => 7
    );
    $fields = json_encode ( $fields );
    
    $headers = array (
      'Authorization: key=' . 'AAAA8SH-WlY:APA91bGvFa2CP6cRBn8PfpsdLFQIxy7hj8NZoT2nXDQ_-hOfwPcVDKRVaOOoDo9p0Ds7hsd0Yi7WK58hJe0nYgDM0gZcJa02C6lb4-bacFsLEGOF5XqYUIKO0nzDkEBbYLXqBnMItoIg',
      'Content-Type: application/json'
    );
    
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields );
    
    $result = curl_exec ( $ch );
    curl_close ( $ch );
    return json_decode( $result );
  }
}

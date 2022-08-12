<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Room;

class ApiRoomRatesController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rooms = new Room;
    }

    public function index($id)
    {
        // return $this->respond(, 200);
        $check_in   = $this->request->getGet('check_in');
        $check_out  = $this->request->getGet('check_out');
        if($check_in && $check_out) {
            $rooms = $this->rooms
                                ->select('id, name, rate as rate_per_night, no_promo as has_promo')
                                ->where('property_id', $id)
                                ->where('date >=', $check_in)
                                ->where('date <=', $check_out)
                                ->join('room_rates', 'room_rates.room_id = rooms.id', 'left')
                                ->get()
                                ->getResultArray();
        } else {
            $rooms = $this->rooms
                                ->select('id, name, rate as rate_per_night, no_promo as has_promo')
                                ->where('property_id', $id)
                                ->join('room_rates', 'room_rates.room_id = rooms.id', 'left')
                                ->get()
                                ->getResultArray();
        }
        
        foreach($rooms as &$room) {
            if($room['has_promo'] == 0) {
                $room['has_promo'] = false;
            } else {
                $room['has_promo'] = true;
            }
        }

        $response = [
            'result' => $rooms
        ];
        return $this->respond($response, 200);
    }
}

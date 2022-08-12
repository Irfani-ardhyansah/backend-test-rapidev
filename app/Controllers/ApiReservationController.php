<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Room;

class ApiReservationController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->rooms = new Room;
    }

    public function index($id)
    {
        $check_in   = $this->request->getGet('check_in');
        $check_out  = $this->request->getGet('check_out');
        $amount     = $this->request->getGet('amount');
        $room = $this->rooms
                        ->select('rate as original_total, no_promo as discount_total')
                        ->join('room_rates', 'room_rates.room_id = rooms.id', 'left')
                        ->find($id);

        if($check_in && $check_out && $amount) {
            $hasil  = strtotime($check_out) - strtotime($check_in);
            $day    = round($hasil/ (60 * 60 * 24));
            $number = $day * $amount;
            $total  = $room['original_total'];
            (int) $original_total = $total * $number;
            $room['original_total'] = $original_total;
            $room['discount_total'] = (int) $room['discount_total'];
        } else {
            $room['original_total'] = (int) $room['original_total'];
            $room['discount_total'] = (int) $discount_total;
        }

        $response = [
            'result' => $room
        ];
        return $this->respond($response, 200);
    }
}

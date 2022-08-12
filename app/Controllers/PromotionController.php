<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Promotion;
use App\Models\Property;
use App\Models\Room;
use App\Models\PropertyPromotion;
use App\Models\RoomPromotion;

class PromotionController extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->promotions           = new Promotion;
        $this->properties           = new Property;
        $this->rooms                = new Room;
        $this->propertyPromotion    = new PropertyPromotion;
        $this->roomPromotion        = new RoomPromotion;
    }

    public function index()
    {
        $data['promotions'] = $this->promotions->findAll();
        return view('promotions', $data);
    }

    public function create()
    { 
        $data['properties'] = $this->properties->findAll();
        $data['rooms']      = $this->rooms->findAll();
        return view('promotion-create', $data);
    }

    public function store()
    {
        $is_all_properties  = $this->request->getPost('is_all_properties');
        $user_id            = $this->session->get('id');

        $promo = $this->promotions->insert([
                                            'author_id'         => $user_id,
                                            'name'              => $this->request->getPost('name'),
                                            'type'              => $this->request->getPost('type'),
                                            'amount'            => $this->request->getPost('amount'),
                                            'max_amount'        => $this->request->getPost('max_amount'),
                                            'publish_start'     => $this->request->getPost('publish_start'),
                                            'publish_end'       => $this->request->getPost('publish_end'),
                                            'booking_start'     => $this->request->getPost('booking_start'),
                                            'booking_end'       => $this->request->getPost('booking_end'),
                                            'stay_start'        => $this->request->getPost('stay_start'),
                                            'stay_end'          => $this->request->getPost('stay_end'),
                                            'is_all_properties' => $is_all_properties
                                        ]);

        if($is_all_properties == 0) {
            $is_all_rooms   = $this->request->getPost('is_all_room');
            
            $propertyPromo = $this->propertyPromotion->insert([
                                'promo_id'      => $promo,
                                'property_id'   => $this->request->getPost('properties'),
                                'is_all_rooms'  => $is_all_rooms
                            ]);

            if($is_all_rooms == 0) {
                $this->roomPromotion->insert([
                    'property_promo_id' => $propertyPromo,
                    'room_id'           => $this->request->getPost('room')
                ]);
            }
        }
		return redirect('promotions');	
    }

    public function edit($id)
    {
        $arrayPromotion     = $this->promotions
                                        ->where('promotions.id', $id)
                                        ->join('property_promotion', 'property_promotion.promo_id = promotions.id', 'left')
                                        ->join('room_promotion', 'room_promotion.property_promo_id = property_promotion.id', 'left')
                                        ->get()
                                        ->getResultArray();
        $data['promotion']  = $arrayPromotion[0];
        $data['properties'] = $this->properties->findAll();
        $data['rooms']      = $this->rooms->findAll();
        return view('promotion-edit', $data);
    }

    public function update($id)
    {
        $is_all_properties  = $this->request->getPost('is_all_properties');
        $user_id            = $this->session->get('id');
        $this->promotions->update($id,
                                                [
                                                    'author_id'         => $user_id,    
                                                    'name'              => $this->request->getPost('name'),
                                                    'type'              => $this->request->getPost('type'),
                                                    'amount'            => $this->request->getPost('amount'),
                                                    'max_amount'        => $this->request->getPost('max_amount'),
                                                    'publish_start'     => $this->request->getPost('publish_start'),
                                                    'publish_end'       => $this->request->getPost('publish_end'),
                                                    'booking_start'     => $this->request->getPost('booking_start'),
                                                    'booking_end'       => $this->request->getPost('booking_end'),
                                                    'stay_start'        => $this->request->getPost('stay_start'),
                                                    'stay_end'          => $this->request->getPost('stay_end'),
                                                    'is_all_properties' => $is_all_properties
                                                ]);

        $arrayPromotion     = $this->promotions
                                        ->select('promotions.id as promotion_id, author_id, name, type, amount, max_amount, publish_start, publish_end, booking_start, booking_end, stay_start, stay_end, is_all_properties, property_promotion.id as property_promotion_id, promo_id, property_id, is_all_rooms, room_promotion.id as room_promotion_id, room_id')
                                        ->where('promotions.id', $id)
                                        ->join('property_promotion', 'property_promotion.promo_id = promotions.id', 'left')
                                        ->join('room_promotion', 'room_promotion.property_promo_id = property_promotion.id', 'left')
                                        ->get()
                                        ->getResultArray();
        $promo  = $arrayPromotion[0];

        if($is_all_properties == 0) {
            $is_all_rooms   = $this->request->getPost('is_all_room');
            
            if($promo['property_promotion_id']) {
                $propertyPromo = $this->propertyPromotion->update($promo['property_promotion_id'], [
                                    'promo_id'      => $promo['promotion_id'],
                                    'property_id'   => $this->request->getPost('properties'),
                                    'is_all_rooms'  => $is_all_rooms
                                ]);
            } else {
                $propertyPromo = $this->propertyPromotion->insert([
                                    'promo_id'      => $promo['promotion_id'],
                                    'property_id'   => $this->request->getPost('properties'),
                                    'is_all_rooms'  => $is_all_rooms
                                ]);
            }

            if($is_all_rooms == 0) {
                if($promo['room_promotion_id']) {
                    $this->roomPromotion->update($promo['room_promotion_id'], [
                        'property_promo_id' => $promo['property_promotion_id'],
                        'room_id'           => $this->request->getPost('room')
                    ]);
                } else {
                    $this->roomPromotion->insert([
                        'property_promo_id' => $promo['property_promotion_id'],
                        'room_id'           => $this->request->getPost('room')
                    ]);
                }
            }
        }
        
		return redirect('promotions');	
    }

    public function delete($id)
    {
        $arrayPromotion     = $this->promotions
                                    ->select('promotions.id as promotion_id, author_id, name, type, amount, max_amount, publish_start, publish_end, booking_start, booking_end, stay_start, stay_end, is_all_properties, property_promotion.id as property_promotion_id, promo_id, property_id, is_all_rooms, room_promotion.id as room_promotion_id, room_id')
                                    ->where('promotions.id', $id)
                                    ->join('property_promotion', 'property_promotion.promo_id = promotions.id', 'left')
                                    ->join('room_promotion', 'room_promotion.property_promo_id = property_promotion.id', 'left')
                                    ->get()
                                    ->getResultArray();
        $promo  = $arrayPromotion[0];

        if($promo['room_promotion_id']) {
            $this->roomPromotion->delete($promo['room_promotion_id']);
        }

        if($promo['property_promotion_id']) {
            $this->propertyPromotion->delete($promo['property_promotion_id']);
        }

        $this->promotions->delete($id);

		return redirect('promotions');	
    }
}

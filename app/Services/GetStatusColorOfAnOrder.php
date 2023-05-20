<?php

namespace App\Services;

use App\Models\Order;

class GetStatusColorOfAnOrder
{
    public function get(string $status): string
    {
        // set status color default to gray
        $status_color = 'gray';

        switch ($status) {
            case Order::ORDER_STATUS['WAITING_FOR_PAYMENT']:
                $status_color = 'yellow';
                break;
            case Order::ORDER_STATUS['WAITING_FOR_CONFIRMATION']:
            case Order::ORDER_STATUS['WAITING_FOR_REMAINING_PAYMENT']:
                $status_color = 'blue';
                break;
            case Order::ORDER_STATUS['HAS_BEEN_COMPLETED']:
            case Order::ORDER_STATUS['HAS_BEEN_PAID']:
                $status_color = 'green';
                break;
            case Order::ORDER_STATUS['CANCELLED']:
                $status_color = 'red';
                break;
        }

        return $status_color;
    }
}

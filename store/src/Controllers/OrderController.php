<?php

namespace store\Controllers;

use store\Entities\Order;

class OrderController {

    /**
     * @param $ref
     * @return mixed
     */
    public function show($renderer, $ref){

        $order = new Order($ref);

        $data = $order->getOrder();
        $customer = $order->getCustomer();

        return $renderer->render('orders.show', ['data' => $data, 'ref' => $ref, 'customer' => $customer] ); // Will render foo/bar.blade.php

    }
}
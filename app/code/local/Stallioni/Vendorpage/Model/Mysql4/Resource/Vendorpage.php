<?php


public function ByCustomerId(Stallioni_Vendorpage_Model_Vendorpage $Object, $customerId)
    {
        $adapter = $this->_getReadAdapter();
        $bind    = array('customer_id'  => $customerId);
        $select  = $adapter->select()
            ->from('vendorpage' array('vendorpage_id'))
            ->where('vendor_id = :customer_id');


        $customerId = $adapter->fetchOne($select, $bind);
        if ($customerId) {
            $this->load($Object, $customerId);
        } else {
            $customer->setData(array());
        }

        return $this;
    }

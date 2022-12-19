<?php

if (! function_exists('shipper_rates')) {
    /**
     * Get the shipper rates.
     *
     * @return array
     */
    function shipper_rates()
    {
        return [
            ['label' => 'Instant', 'value' => 'instant'],
            ['label' => 'Regular', 'value' => 'regular'],
            ['label' => 'Express', 'value' => 'express'],
            ['label' => 'Trucking', 'value' => 'trucking'],
            ['label' => 'Same Day', 'value' => 'same-day'],
        ];
    }
}

if (! function_exists('shipper_categories')) {
    /**
     * Get the shipper categories.
     *
     * @return array
     */
    function shipper_categories()
    {
        return [
            ['id' => 1, 'label' => 'Cairan'],
            ['id' => 2, 'label' => 'Dokumen'],
            ['id' => 3, 'label' => 'Elektronik'],
            ['id' => 4, 'label' => 'Furnitur'],
            ['id' => 5, 'label' => 'Kosmetik'],
            ['id' => 6, 'label' => 'Makanan'],
            ['id' => 7, 'label' => 'Minuman'],
            ['id' => 8, 'label' => 'Pakaian'],
            ['id' => 9, 'label' => 'Sepatu'],
            ['id' => 10, 'label' => 'Spare Parts'],
            ['id' => 11, 'label' => 'Aksesoris'],
            ['id' => 12, 'label' => 'Dekorasi Rumah'],
            ['id' => 12, 'label' => 'Mainan'],
            ['id' => 13, 'label' => 'Obat dan Herbal'],
            ['id' => 14, 'label' => 'Garmen dan Tekstil'],
            ['id' => 16, 'label' => 'Buku'],
            ['id' => 17, 'label' => 'Lainnya'],
        ];
    }
}

if (! function_exists('shipper_phone_format')) {
    function shipper_phone_format($phone)
    {
        return preg_replace('/^0|\+/', '', $phone);
    }
}

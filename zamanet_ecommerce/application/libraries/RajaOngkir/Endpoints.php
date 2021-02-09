<?php

/**
 * RajaOngkir Endpoints
 * 
 * @author Damar Riyadi <damar@tahutek.net>
 */
require_once 'Restclient.php';

class Endpoints {

    private $api_key;
    private $account_type;

    public function __construct($api_key, $account_type) {
        $this->api_key = $api_key;
        $this->account_type = $account_type;
    }

    /**
     * Fungsi untuk mendapatkan data propinsi di Indonesia
     * @param integer $province_id ID propinsi, jika NULL tampilkan semua propinsi
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function province($province_id = NULL) {
        $params = (is_null($province_id)) ? array() : array('id' => $province_id);
        $rest_client = new RESTClient($this->api_key, 'province', $this->account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan data kota di Indonesia
     * @param integer $province_id ID propinsi
     * @param integer $city_id ID kota, jika ID propinsi dan kota NULL maka tampilkan semua kota
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function city($province_id = NULL, $city_id = NULL) {
        $params = (is_null($province_id)) ? array() : array('province' => $province_id);
        if (!is_null($city_id)) {
            $params['id'] = $city_id;
        }
        $rest_client = new RESTClient($this->api_key, 'city', $this->account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan data ongkos kirim
     * @param integer $origin ID kota asal
     * @param integer $destination ID kota tujuan
     * @param integer $weight Berat kiriman dalam gram
     * @param string $courier Kode kurir
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function cost($origin, $destination, $weight, $courier) {
        $params = array(
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        );
        $rest_client = new RESTClient($this->api_key, 'cost', $this->account_type);
        return $rest_client->post($params);
    }

    /**
     * Fungsi untuk mendapatkan daftar/nama kota yang mendukung pengiriman Internasional
     * 
     * @param integer $province_id ID propinsi
     * @param integer $city_id ID kota, jika ID propinsi dan ID kota NULL maka tampilkan semua kota
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function internationalOrigin($province_id = NULL, $city_id = NULL) {
        $params = (is_null($province_id)) ? array() : array('province' => $province_id);
        if (!is_null($city_id)) {
            $params['id'] = $city_id;
        }
        $rest_client = new RESTClient($this->api_key, 'internationalOrigin', $this->account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan daftar/nama negara tujuan pengiriman internasional
     * 
     * @param integer ID negara, jika kosong maka akan menampilkan semua negara
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function internationalDestination($country_id = NULL) {
        $params = (is_null($country_id)) ? array() : array('id' => $country_id);
        $rest_client = new RESTClient($this->api_key, 'internationalDestination', $this->account_type);
        return $rest_client->get($params);
    }

    /**
     * Fungsi untuk mendapatkan ongkir internasional (EMS)
     * 
     * @param integer ID kota asal
     * @param ineteger ID negara tujuan
     * @param integer Berat kiriman dalam gram
     * @param string Kode kurir
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function internationalCost($origin, $destination, $weight, $courier) {
        $params = array(
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        );
        $rest_client = new RESTClient($this->api_key, 'internationalCost', $this->account_type);
        return $rest_client->post($params);
    }

    /**
     * Fungsi untuk mendapatkan nilai kurs rupiah terhadap USD
     * 
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function currency() {
        $rest_client = new RESTClient($this->api_key, 'currency', $this->account_type);
        return $rest_client->get(array());
    }

    /**
     * Fungsi untuk melacak paket/nomor resi
     * 
     * @param string Nomor resi
     * @param string Kode kurir
     * @return string Response dari cURL, berupa string JSON balasan dari RajaOngkir
     */
    function waybill($waybill_number, $courier) {
        $params = array(
            'waybill' => $waybill_number,
            'courier' => $courier
        );
        $rest_client = new RESTClient($this->api_key, 'waybill', $this->account_type);
        return $rest_client->post($params);
    }

}

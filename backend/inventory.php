<?php
/*
 * Connect to the Shopify API and count all available inventory of all products
 * in your dev store.
 *
 * For full details, and to get your Shopify API Key & Password, consult the
 * GitHub repo's README.md file.
 */
class shopify {
	private $API_KEY = '29cf5e6c7765d45e2fbda1f63e0d2291';
	private $STORE_URL = 'shoppad-candidate.myshopify.com';
	private $PASSWORD = '9cd5b2b4faa1f32a09c1156829714579';
	
	function getProducts() {
		$url = 'https://' . $this->API_KEY . ':' . $this->PASSWORD . '@' . $this->STORE_URL . '/admin/products.json';
		$session = curl_init();
		
		curl_setopt($session, CURLOPT_URL, $url);
		curl_setopt($session, CURLOPT_HTTPGET, 1);
		curl_setopt($session, CURLOPT_VERBOSE, true);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		
		$response = curl_exec($session);
		curl_close($session);
		$result = json_decode($response,true);
		return $result;
	}
}

$shopify = new shopify();
$result = $shopify->getProducts();
if (!isset($result['products'])) {
	echo 'Error happened when pulling data from Shopify API.';
	exit;
}

$totalInv = 0;
foreach ($result['products'] as $prod) {
	foreach ($prod['variants'] as $variant) {
		$totalInv += $variant['inventory_quantity'];
	}
}

echo "Total inventory number is " . $totalInv;

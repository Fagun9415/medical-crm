<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Stripe API Configuration
| -------------------------------------------------------------------
|
| You will get the API keys from Developers panel of the Stripe account
| Login to Stripe account (https://dashboard.stripe.com/)
| and navigate to the Developers » API keys page
|
|  stripe_api_key        	string   Your Stripe API Secret key.
|  stripe_publishable_key	string   Your Stripe API Publishable key.
|  stripe_currency   		string   Currency code.
*/
$config['stripe_api_key']         = 'sk_test_51Gxs8kGxtw0Oktq8HAEs5juXaUpBm4qq5HknBD5heyyJyPIW8E7jPTtdnSFuyHlAxm8N0AqFPQzChXqg5iOEPSrg00d3iwn1ss'; 
$config['stripe_publishable_key'] = 'pk_test_51Gxs8kGxtw0Oktq8nNBUbGXuUSv5ATeP1zuPPiJwxC2XvCLI7Tscv66flf3EPRy3ktqVe9FuHK1zkIxSle7oBrbO00dN3uH5uo'; 
$config['stripe_currency']        = 'usd';
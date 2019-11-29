<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon;
use PagSeguro;
use App\Models\Subscription;
use App\Notifications\Payments\Admin\NewAccountPayment;
use DB;
use App\User;
use Helper;
use SEOMeta;
use SEO;
use Protocol;
use Theme;

/**
 * PagSeguroController
 */

class PagSeguroController extends Controller
{
    public $theme = '';
	
	function __construct()
	{
		$this->middleware('auth');
        $this->theme = Theme::get();
	}

	/**
	 * Pay with PagSeguro
	 */
	public function get()
	{
		// Check if gateway is enabled
		if (!Helper::settings_payments()->is_pagseguro) {
			
			// Not enabled
			return redirect('upgrade')->with('error', __('update.lang_gateway_not_enabled'));

		}

		// Get Tilte && Description
        $title      = Helper::settings_general()->title;
        $long_desc  = Helper::settings_seo()->description;
        $keywords   = Helper::settings_seo()->keywords;

        // Manage SEO
        SEO::setTitle('Pagseguro | '.$title);
        SEO::setDescription($long_desc);
        SEO::opengraph()->setUrl(Protocol::home());
        SEOMeta::addKeyword([$keywords]);

		return view($this->theme.'.checkout.pagseguro');
	}

	/**
	 * Checkout
	 */	
	public function post(Request $request)
	{
		// Make Rules
		$rules = array(
			'days'                      => 'required|numeric', 
			'senderHash'                => 'required',
			'senderName'                => 'required',
			'senderPhone'               => 'required',
			'shippingAddressStreet'     => 'required',
			'shippingAddressNumber'     => 'required',
			'shippingAddressDistrict'   => 'required',
			'shippingAddressPostalCode' => 'required'
		);

		// Make Validation
		$validator = Validator::make($request->all(), $rules);

		if ($validator->passes()) {

			// Get inputs values
			$days        = $request->get('days');

			// Days must be between 10 and 5000 days
			if ($days < 7) {
				// Error
				return redirect('checkout/pagseguro')->with('error', 'Oops! Days must be greater than 7 days');
			}
			
			// Set Total price
			$total_price = $days * config('pagseguro.account_price');
			
			// Set Currency
			$currency    = config('pagseguro.currency');

			/**
			 * Get CNPJ value and address
			 */
			$faker = \Faker\Factory::create();
			$faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
			$faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));
			$faker->addProvider(new \Faker\Provider\Uuid($faker));
			$faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));

			/**
			 * Get Sender Info
			 */
			$senderName                = $request->get('senderName');
			$senderPhone               = $request->get('senderPhone');
			$shippingAddressStreet     = $request->get('shippingAddressStreet');
			$shippingAddressNumber     = $request->get('shippingAddressNumber');
			$shippingAddressDistrict   = $request->get('shippingAddressDistrict');
			$shippingAddressPostalCode = $request->get('shippingAddressPostalCode');
			$senderHash                = $request->get('senderHash');
			$senderEmail               = Auth::user()->email;
			$senderCNPJ                = $faker->cnpj;

			// Progress payment
			try {

			    $pagseguro = PagSeguro::setReference($faker->uuid)
			    ->setSenderInfo([
					'senderName'                => $senderName,
					'senderPhone'               => $senderPhone,
					'senderEmail'               => $senderEmail,
					'senderHash'                => $senderHash,
					'senderCNPJ'                => $senderCNPJ
			    ])
			    ->setShippingAddress([
					'shippingAddressStreet'     => $shippingAddressStreet,
					'shippingAddressNumber'     => $shippingAddressNumber,
					'shippingAddressDistrict'   => $shippingAddressDistrict,
					'shippingAddressPostalCode' => $shippingAddressPostalCode,
					'shippingAddressCity'       => $faker->city,
					'shippingAddressState'      => $faker->stateAbbr
			     ])
			     ->setItems([
			      [
					'itemId'                    => strtoupper(str_random(15)),
					'itemDescription'           => __('upgrade.lang_upgrade_your_account'),
					'itemAmount'                => $total_price,
					'itemQuantity'              => 1,
			      ]
			    ])
			    ->send([
			      'paymentMethod'               => 'boleto'
			    ]);

			    return redirect($pagseguro->paymentLink);

			}catch(\Artistas\PagSeguro\PagSeguroException $e) {

				// Error
				return redirect('checkout/pagseguro')->with('error', $e->getMessage());

			}

		}else{

			// Error
			return redirect('checkout/pagseguro')->withErrors($validator)->withInput();

		}
		
	}

	/**
	 * Progress Payment
	 * @param  Request  $request [description]
	 * @return status          [description]
	 */
	public function callback(Request $request)
	{
		
	}

}
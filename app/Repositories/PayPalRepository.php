<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 24.10.2016
 * Time: 19:39
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Log;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalRepository
{
    const
        CLIENT_ID = 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS',
        CLIENT_SECRET = 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL';

    public static function create($params)
    {
        $apiContext = self::getApiContext(self::CLIENT_ID, self::CLIENT_SECRET);

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName($params['payment_description'])
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($params['payment_sum']);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($params['payment_sum']);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($params['payment_sum'])
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($params['payment_description'])
            ->setInvoiceNumber(uniqid());

        $baseUrl = self::getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/my/billing/pay/status?success=true")
            ->setCancelUrl("$baseUrl/my/billing/pay/status?success=false");

        $payment = new Payment();
        $payment->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage() . "\nFile: " . $ex->getFile() . "\nLine: " . $ex->getLine());
            return false;
        }

        return ['uri' => $payment->getApprovalLink(), 'payment' => $payment->toArray()];
    }



    private static function getApiContext($clientId, $clientSecret)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => false,
                'log.FileName' => storage_path('logs/PayPal.log'),
                'log.LogLevel' => 'DEBUG',
                //'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            )
        );

        return $apiContext;
    }

    private static function getBaseUrl()
    {
        if (PHP_SAPI == 'cli') {
            $trace=debug_backtrace();
            $relativePath = substr(dirname($trace[0]['file']), strlen(dirname(dirname(__FILE__))));
            echo "Warning: This sample may require a server to handle return URL. Cannot execute in command line. Defaulting URL to http://localhost$relativePath \n";
            return "http://localhost" . $relativePath;
        }
        $protocol = 'http';
        if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
            $protocol .= 's';
        }
        $host = $_SERVER['HTTP_HOST'];
        $request = $_SERVER['PHP_SELF'];
        return dirname($protocol . '://' . $host . $request);
    }
}
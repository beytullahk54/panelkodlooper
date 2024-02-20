<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_kategori;
use App\Models\tbl_bakiye;
use App\Models\tbl_firma;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Request\RetrieveCheckoutFormRequest;
use Iyzipay\Model\CheckoutForm;
use Config;
use Iyzipay\Options;
use Carbon\Carbon;
use Auth;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;


class KrediKartiController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Kategori";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $tbl_bakiye = tbl_bakiye::where('id','=',$id)->first();
        //return $tbl_bakiye->db_odeme_miktari;
        $geriDonusURL = url('kredi-karti-odeme-sonuc');

        $benzersiz = uniqid('siparis_' . Auth::User()->id . '_');

        $tbl_bakiye->db_iyzico_id = $benzersiz;
        $tbl_bakiye->save();

        $options = new Options();
        $options->setApiKey('irHAZdrivZWBkIGON8SvEclUpdx789KL');
        $options->setSecretKey('EkyFFZ0fOvE9mYlANZYZI8N4q0buZIXA');
        //$options->setBaseUrl('https://sandbox-api.iyzipay.com');
        $options->setBaseUrl('https://api.iyzipay.com/');
        
        $request = new CreateCheckoutFormInitializeRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($benzersiz);
        $request->setPrice($tbl_bakiye->db_odeme_miktari);
        $request->setPaidPrice($tbl_bakiye->db_odeme_miktari);
        $request->setCurrency(Currency::TL);
        $request->setBasketId($benzersiz);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);
        $request->setCallbackUrl($geriDonusURL);
        $request->setEnabledInstallments(array(2, 3, 6, 9));
        $buyer = new Buyer();
        $buyer->setId("BY789");
        $buyer->setName(Auth::User()->name);
        $buyer->setSurname(Auth::User()->surname);
        $buyer->setGsmNumber(Auth::User()->firma->db_cep_no);
        $buyer->setEmail(Auth::User()->email);
        $buyer->setIdentityNumber(Auth::User()->firma->db_tc_pasaport);
        $buyer->setLastLoginDate("2015-10-05 12:43:35");
        $buyer->setRegistrationDate("2013-04-21 15:12:09");
        $buyer->setRegistrationAddress(Auth::User()->firma->db_sirket_adresi);
        $buyer->setIp("85.34.78.112");
        $buyer->setCity("Istanbul");
        $buyer->setCountry("Turkey");
        $buyer->setZipCode("34732");
        $request->setBuyer($buyer);

        $shippingAddress = new Address();
        $shippingAddress->setContactName(Auth::User()->name." ".Auth::User()->surname);
        $shippingAddress->setCity("Istanbul");
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress(Auth::User()->firma->db_sirket_adresi);
        $shippingAddress->setZipCode("34742");
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new Address();
        $billingAddress->setContactName(Auth::User()->name." ".Auth::User()->surname);
        $billingAddress->setCity("Istanbul");
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress(Auth::User()->firma->db_sirket_adresi);
        $billingAddress->setZipCode("34742");
        $request->setBillingAddress($billingAddress);

        $basketItems = array();
        $firstBasketItem = new BasketItem();
        $firstBasketItem->setId("BI0101");
        $firstBasketItem->setName("Kampüs Lms Bakiye");
        $firstBasketItem->setCategory1("Collectibles");
        $firstBasketItem->setCategory2("Accessories");
        $firstBasketItem->setItemType(BasketItemType::PHYSICAL);
        $firstBasketItem->setPrice($tbl_bakiye->db_odeme_miktari);
        $basketItems[0] = $firstBasketItem;

        $request->setBasketItems($basketItems);

        $checkoutFormInitialize = CheckoutFormInitialize::create($request, $options);
        $paymentinput = $checkoutFormInitialize->getCheckoutFormContent();

        return view('pages.pricing.show',compact('paymentinput'));
    }
    public function odemeSonuc(Request $request)
    {
        $options = new Options();
        $options->setApiKey('irHAZdrivZWBkIGON8SvEclUpdx789KL');
        $options->setSecretKey('EkyFFZ0fOvE9mYlANZYZI8N4q0buZIXA');
        //$options->setBaseUrl('https://sandbox-api.iyzipay.com');
        $options->setBaseUrl('https://api.iyzipay.com/');

        $token = $request->token;   
        $request = new RetrieveCheckoutFormRequest();
        $request->setLocale(Locale::TR);
        //$request->setConversationId("123456789");
        $request->setToken($token);
        # make request
        $checkoutForm = CheckoutForm::retrieve($request, $options);
        # print result

        if ($checkoutForm->getPaymentStatus() == "SUCCESS") {
            
            $tbl_bakiye = tbl_bakiye::where('db_iyzico_id',"=",$checkoutForm->getBasketId())->first();
            $tbl_bakiye->db_odeme_durumu = "kredi_karti_onaylandi";
            $tbl_bakiye->save();

            Auth::User()->firma->bakiye = Auth::User()->firma->bakiye + $tbl_bakiye->db_odeme_miktari;
            Auth::User()->firma->save();
            
            return redirect()->to('bayi/bakiye-islemleri/');
            //return 'true';
        } else {
            //dd($checkoutForm);
            return "başarısız";
            return redirect()->back();
            //return 'bsd';
        }
    }

    public function paytrOnHazirlik(Request $request)
    {


        $benzersiz = rand(1,10000000000000);


        $bakiye = new tbl_bakiye();
        $bakiye->db_firma_id=Auth::User()->firma_id;
        $bakiye->db_odeme_miktari=$request->bakiye;
        $bakiye->db_odeme_turu="kredi_karti";
        $bakiye->db_iyzico_id = $benzersiz;
        $bakiye->db_odeme_durumu="onay_bekliyor";
        $bakiye->save();

          ## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
        $merchant_id    = '407775';
        $merchant_key   = '7AAsPzzr84w88MP6';
        $merchant_salt  = 'MYULQMnGSDBQ75Jt';
        #
        ## Müşterinizin sitenizde kayıtlı veya form vasıtasıyla aldığınız eposta adresi
        $email = Auth::User()->email;
        #
        ## Tahsil edilecek tutar.
        $payment_amount = $request->bakiye."00"; //9.99 için 9.99 * 100 = 999 gönderilmelidir.
        #
        ## Sipariş numarası: Her işlemde benzersiz olmalıdır!! Bu bilgi bildirim sayfanıza yapılacak bildirimde geri gönderilir.
        $merchant_oid = $benzersiz;
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız ad ve soyad bilgisi
        $user_name = Auth::User()->name." ".Auth::User()->surname;
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız adres bilgisi
        $user_address = Auth::User()->firma->db_sirket_adresi;
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız telefon bilgisi
        $user_phone = Auth::User()->firma->db_cep_no;
        #
        ## Başarılı ödeme sonrası müşterinizin yönlendirileceği sayfa
        ## !!! Bu sayfa siparişi onaylayacağınız sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
        ## !!! Siparişi onaylayacağız sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
        $merchant_ok_url = "https://panel.kampuslms.com/bayi/bakiye-islemleri";
        #
        ## Ödeme sürecinde beklenmedik bir hata oluşması durumunda müşterinizin yönlendirileceği sayfa
        ## !!! Bu sayfa siparişi iptal edeceğiniz sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
        ## !!! Siparişi iptal edeceğiniz sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
        $merchant_fail_url = "https://panel.kampuslms.com/bayi/bakiye-islemleri";
        #
        ## Müşterinin sepet/sipariş içeriği
        //$user_basket = "";
        #
        // ÖRNEK $user_basket oluşturma - Ürün adedine göre array'leri çoğaltabilirsiniz
        $user_basket = base64_encode(json_encode(array(
            array("Kampüs Lms Bakiye",$request->bakiye.".00", 1) // 1. ürün (Ürün Ad - Birim Fiyat - Adet ) )
        )));
        
        ############################################################################################

        ## Kullanıcının IP adresi
        if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        ## !!! Eğer bu örnek kodu sunucuda değil local makinanızda çalıştırıyorsanız
        ## buraya dış ip adresinizi (https://www.whatismyip.com/) yazmalısınız. Aksi halde geçersiz paytr_token hatası alırsınız.
        $user_ip=$ip;
        ##

        ## İşlem zaman aşımı süresi - dakika cinsinden
        $timeout_limit = "30";

        ## Hata mesajlarının ekrana basılması için entegrasyon ve test sürecinde 1 olarak bırakın. Daha sonra 0 yapabilirsiniz.
        $debug_on = 1;

        ## Mağaza canlı modda iken test işlem yapmak için 1 olarak gönderilebilir.
        $test_mode = 0;

        $no_installment = 0; // Taksit yapılmasını istemiyorsanız, sadece tek çekim sunacaksanız 1 yapın

        ## Sayfada görüntülenecek taksit adedini sınırlamak istiyorsanız uygun şekilde değiştirin.
        ## Sıfır (0) gönderilmesi durumunda yürürlükteki en fazla izin verilen taksit geçerli olur.
        $max_installment = 0;

        $currency = "TL";

        ####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
        $hash_str = $merchant_id .$user_ip .$merchant_oid .$email .$payment_amount .$user_basket.$no_installment.$max_installment.$currency.$test_mode;
        $paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
        $post_vals=array(
            'merchant_id'=>$merchant_id,
            'user_ip'=>$user_ip,
            'merchant_oid'=>$merchant_oid,
            'email'=>$email,
            'payment_amount'=>$payment_amount,
            'paytr_token'=>$paytr_token,
            'user_basket'=>$user_basket,
            'debug_on'=>$debug_on,
            'no_installment'=>$no_installment,
            'max_installment'=>$max_installment,
            'user_name'=>$user_name,
            'user_address'=>$user_address,
            'user_phone'=>$user_phone,
            'merchant_ok_url'=>$merchant_ok_url,
            'merchant_fail_url'=>$merchant_fail_url,
            'timeout_limit'=>$timeout_limit,
            'currency'=>$currency,
            'test_mode'=>$test_mode
        );

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        // XXX: DİKKAT: lokal makinanızda "SSL certificate problem: unable to get local issuer certificate" uyarısı alırsanız eğer
        // aşağıdaki kodu açıp deneyebilirsiniz. ANCAK, güvenlik nedeniyle sunucunuzda (gerçek ortamınızda) bu kodun kapalı kalması çok önemlidir!
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = @curl_exec($ch);

        if(curl_errno($ch))
            die("PAYTR IFRAME connection error. err:".curl_error($ch));

        curl_close($ch);

        $result=json_decode($result,1);

        if($result['status']=='success')
            $token=$result['token'];
        else
            die("PAYTR IFRAME failed. reason:".$result['reason']);
        #########################################################################

        return ["result"=>$token];
    }

    public function paytrSonucBasarili()
    {
        return "";

    }

    public function paytrSonuc(Request $request)
    {

        ####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
        #
        ## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
        $merchant_key   = '7AAsPzzr84w88MP6';
        $merchant_salt  = 'MYULQMnGSDBQ75Jt';
        ###########################################################################

        ####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
        #
        ## POST değerleri ile hash oluştur.
        $hash = base64_encode( hash_hmac('sha256', $request['merchant_oid'].$merchant_salt.$request['status'].$request['total_amount'], $merchant_key, true) );
        #
        ## Oluşturulan hash'i, paytr'dan gelen post içindeki hash ile karşılaştır (isteğin paytr'dan geldiğine ve değişmediğine emin olmak için)
        ## Bu işlemi yapmazsanız maddi zarara uğramanız olasıdır.
        if( $hash != $request['hash'] )
            die('PAYTR notification failed: bad hash');
        ###########################################################################

        ## BURADA YAPILMASI GEREKENLER
        ## 1) Siparişin durumunu $post['merchant_oid'] değerini kullanarak veri tabanınızdan sorgulayın.
        ## 2) Eğer sipariş zaten daha önceden onaylandıysa veya iptal edildiyse  echo "OK"; exit; yaparak sonlandırın.

        /* Sipariş durum sorgulama örnek
        $durum = SQL
        if($durum == "onay" || $durum == "iptal"){
                echo "OK";
                exit;
            }
        */

        if( $request['status'] == 'success' ) { ## Ödeme Onaylandı
            
            $tbl_bakiye = tbl_bakiye::where('db_iyzico_id',"=",$request['merchant_oid'])->first();
            $tbl_bakiye->db_odeme_durumu = "kredi_karti_onaylandi";
            $tbl_bakiye->save();
    
            $firma = tbl_firma::where('id','=',$tbl_bakiye->db_firma_id)->first();
            $firma->bakiye = $firma->bakiye + $tbl_bakiye->db_odeme_miktari;
            $firma->save();

            smsGonder("Sayın ". $firma->firma_yetkili ."; Kampüs LMS bayi üzerinden ".Carbon::now()->format("d.m.y")." tarihinde kredi kartı ödemeniz başarılı olmuştur. Yüklemiş olduğunuz ".$tbl_bakiye->db_odeme_miktari." TL, bakiye hesabınıza tanımlanmıştır. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$firma->db_cep_no);
            mailGonder($firma->db_yetkili_email,"Sayın ". $firma->firma_yetkili ."; Kampüs LMS bayi üzerinden ".Carbon::now()->format("d.m.y")." tarihinde kredi kartı ödemeniz başarılı olmuştur. Yüklemiş olduğunuz ".$tbl_bakiye->db_odeme_miktari." TL, bakiye hesabınıza tanımlanmıştır. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS Bayi Paneli");

            /*Auth::User()->firma->bakiye = Auth::User()->firma->bakiye + $tbl_bakiye->db_odeme_miktari;
            Auth::User()->firma->save();*/
            ## BURADA YAPILMASI GEREKENLER
            ## 1) Siparişi onaylayın.
            ## 2) Eğer müşterinize mesaj / SMS / e-posta gibi bilgilendirme yapacaksanız bu aşamada yapmalısınız.
            ## 3) 1. ADIM'da gönderilen payment_amount sipariş tutarı taksitli alışveriş yapılması durumunda
            ## değişebilir. Güncel tutarı $post['total_amount'] değerinden alarak muhasebe işlemlerinizde kullanabilirsiniz.

        } else { ## Ödemeye Onay Verilmedi

            $tbl_bakiye = tbl_bakiye::where('db_iyzico_id',"=",$request['merchant_oid'])->first();
            $tbl_bakiye->db_odeme_durumu = "kredi_karti_reddedildi";
            $tbl_bakiye->save();
            ## BURADA YAPILMASI GEREKENLER
            ## 1) Siparişi iptal edin.
            ## 2) Eğer ödemenin onaylanmama sebebini kayıt edecekseniz aşağıdaki değerleri kullanabilirsiniz.
            ## $post['failed_reason_code'] - başarısız hata kodu
            ## $post['failed_reason_msg'] - başarısız hata mesajı

        }

        return "OK";
       
        
        return redirect()->to('bayi/bakiye-islemleri/');
    }

    
}

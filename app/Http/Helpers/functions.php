<?php

    use App\bildirim_mobil;
    use App\Models\User;
    use App\Models\tbl_ayarlar;
    use Carbon\Carbon;
    use Spatie\GoogleCalendar\Event;
    use App\site_setting;
    use App\Models\tbl_debug;
    use App\developer;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\Reminder;
    use App\Mail\SifreSifirlaReminder;
    use App\Mail\StandartReminder;

    if (! function_exists('getSetting')) {
        function getSetting($setting_name)
        {
            $setting = tbl_ayarlar::where('db_key','=',$setting_name)->first();
            if($setting)
            {
                return $setting->db_value;
            }else{
                return null;
            }
        }
    }
    if (! function_exists('XMLPOST')) {
        function XMLPOST($PostAddress,$xmlData)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$PostAddress);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
            $result = curl_exec($ch);
            return $result;
        }
    }
    if (! function_exists('smsGonder')) {
        function smsGonder($mesaj = null, $telefon = null)
        {
            $xml='<?xml version="1.0" encoding="UTF-8"?>
            <mainbody>
            <header>
            <company dil="TR">Netgsm</company>        
            <usercode>8503092634</usercode>
            <password>U5-1U5H4</password>
            <type>1:n</type>
            <msgheader>8503092634</msgheader>
            </header>
            <body>
            <msg>
            '.$mesaj.'
            </msg>
            <no>'.$telefon.'</no>
            </body>
            </mainbody>';

            $gelen=XMLPOST('https://api.netgsm.com.tr/sms/send/xml',$xml);
            return $gelen;
        }
    }
    if (! function_exists('developerSave')) {
        function developerSave($key,$value)
        {
            $developer = new developer;
            $developer->key = $key;
            $developer->value = $value;
            $developer->save();

        }
    }
    if (! function_exists('mailGonder')) {
        function mailGonder($mail, $message, $baslik)
        {
            Config::set('mail.host', 'smtp.yandex.com.tr');
            Config::set('mail.port', '465');

            Config::set('mail.from.name', "Kampüs LMS");
            Config::set('mail.from.address', "info@kodlooper.com");
            Config::set('mail.username', "info@kodlooper.com");
            Config::set('mail.password', "kodlooper@19");
            Config::set('mail.encryption', 'ssl');

            Mail::to($mail)->send(new Reminder($mail, $message, $baslik));
        }
    }
    if (! function_exists('sifreSifirla')) {
        function sifreSifirla($mail, $message, $baslik)
        {
            Config::set('mail.host', 'kampuslms.com');
            Config::set('mail.port', '465');

            Config::set('mail.from.name', "Kampüs LMS");
            Config::set('mail.from.address', "info@kodlooper.com");
            Config::set('mail.username', "info@kodlooper.com");
            Config::set('mail.password', "kodlooper@19");
            Config::set('mail.encryption', 'ssl');

            Mail::to($mail)->send(new SifreSifirlaReminder($mail, $message, $baslik));
        }
    }
    if (! function_exists('debugSave')) {
        function debugSave($debug)
        {
            $katilimci_debug = new tbl_debug();
            $katilimci_debug->debug=$debug;
            $katilimci_debug->save();
        }
    }



    if (! function_exists('soapTcDogrula')) {
        function soapTcDogrula($tc = null, $adi = null, $soyadi = null, $dogumYili = null)
        {
            $client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
            try {
                $result = $client->TCKimlikNoDogrula([
                    'TCKimlikNo' => $tc,
                    'Ad' => $adi,
                    'Soyad' => $soyadi,
                    'DogumYili' => $dogumYili
                ]);
                if ($result->TCKimlikNoDogrulaResult) {
                    return 'true';
                } else {
                    return 'false';
                }
            } catch (Exception $e) {
                echo $e->faultstring;
            }
        }
    }


    if (! function_exists('dosya')) {
        function dosya($file,$fileDirectory,$uploadParameterArr = [])
        {
            
            $baseFolderName = array_key_exists("baseFolderName", $uploadParameterArr) ? $uploadParameterArr['baseFolderName']:'uploads';

            //$destinationPath = $baseFolderName.$fileDirectory.'';
            $destinationPath = $baseFolderName.$fileDirectory;
            $fileName=str_replace(" ", "_", $file->getClientOriginalName());
            $yeniurl = array_key_exists('fileName',$uploadParameterArr) ? $uploadParameterArr['fileName'] : date_format(Carbon::now(),"YmdHis")."_".$fileName;
            $file->move($destinationPath, $yeniurl);
        
            return array("status"=>true,"message"=>"Dosyanız başarıyla yüklenmiştir..","url"=>$destinationPath.$yeniurl,"fileType"=>$file->getClientOriginalExtension(),'fileName' => $yeniurl);
        
        }
    }

    if (! function_exists('dosyaKaliteDusurucu')) {
        function dosyaKaliteDusurucu($file,$fileDirectory,$uploadParameterArr = []){

            $kalite = array_key_exists("kalite", $uploadParameterArr) ? $uploadParameterArr['kalite']:1024;
            $baseFolderName = array_key_exists("baseFolderName", $uploadParameterArr) ? $uploadParameterArr['baseFolderName']:'uploads';
            $destinationPath = $baseFolderName.$fileDirectory;
            $fileName=str_replace(" ", "_", $file->getClientOriginalName());
            $yeniurl = date_format(Carbon::now(),"YmdHis")."_".$fileName ;

            //$file->move($destinationPath, $yeniurl);

            $image = Image::make($file)->widen($kalite);
            $image->save($destinationPath . $yeniurl );

            //$image->save("/uploads/materyal/".$yeniurl);

            return array("status"=>true,"message"=>"Dosyanız başarıyla yüklenmiştir..","url"=>$destinationPath.$yeniurl,"fileType"=>$file->getClientOriginalExtension(),"fileName" => $yeniurl);
        
        }
    }

?>

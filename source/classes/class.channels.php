<?php
    class channels extends hoteliga{

        //API üzerinden yönetilebilen kanalları edinin.
        public function getChannelNames(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/ChannelManager/ChannelNames");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ".$this->token,
                "Content-Type: application/json"
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            if ($response === false) {
                die('Curl error: ' . curl_error($ch));
            }
            
            return json_decode($response);
        }

        //Bağlı kanallar hakkında bilgi alın.
        public function getChannels(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/ChannelManager/Channels");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ".$this->token,
                "Content-Type: application/json"
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            if ($response === false) {
                die('Curl error: ' . curl_error($ch));
            }
            
            return json_decode($response);
        }

        //Seçilen oda tipi ve tarih aralığı için bağlı kanalların fiyatlarını güncelleyin.
        public function updateChannelPrices() {

            $dateFrom = $_REQUEST["dateFrom"];
            $dateTo = $_REQUEST["dateTo"];
            $roomTypeId = $_REQUEST["roomTypeId"];
            $roomRateType = $_REQUEST["roomRateType"];
            $price = $_REQUEST["price"];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Prices';

            $data = array(
                'pricesForDateRanges' => array(
                    array(
                        'dateFrom' => $dateFrom,
                        'dateTo' => $dateTo,
                        'roomTypeId' => $roomTypeId,
                        'roomRateType' => $roomRateType,
                        'price' => $price
                    )
                )
            );

            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->token
            );

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response);
        }
             
    }
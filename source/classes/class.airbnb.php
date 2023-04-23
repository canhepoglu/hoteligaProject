<?php
    class airbnb extends hoteliga{

        //Tüm yetkili hesaplar için bilgi alın.
        public function get_airbnb_accounts() {
            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Accounts';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($result, true);
        }

        //Yetkili bir hesap için bilgi alın.
        public function get_airbnb_account() {

            $account_id = $_REQUEST['id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Account/' . $account_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, true);
        }

        //Bir hesabın yetkisini kaldırın.
        public function delete_airbnb_account() {

            $account_id = $_REQUEST['id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Account/' . $account_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, true);
        }

        //Tüm hesapların listeleri için bilgi alın.
        public function get_airbnb_listings() {
            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Listings';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }

        //Bir hesabın tüm listeleri için bilgi alın.
        public function get_airbnb_account_listings() {

            $account_id = $_REQUEST['id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Listings/' . $account_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }

        //Listeleme bilgilerini alın.
        public function get_airbnb_listing_info($account_id, $listing_id) {

            $account_id = $_REQUEST['account_id'];
            $listing_id = $_REQUEST['listing_id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Listing/' . $account_id . '/' . $listing_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }

        //Listeleme özelliklerini güncelleyin.
        public function update_airbnb_listing() {
            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Listing';

            $data = array(
                'accountId' => $_REQUEST['account_id'],
                'listingId' => $_REQUEST['listing_id'],
                'action' => $_REQUEST['action'],
                'totalInventoryCount' => $_REQUEST['total_inventory_count'] ?? null,
                'propertyExternalId' => $_REQUEST['property_external_id'] ?? null,
                'hasAvailability' => $_REQUEST['has_availability'] ?? null
            );
            $data_string = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $this->token,
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }

        //Bir listelemenin müsaitlik kurallarını öğrenin.
        public function getAirbnbAvailabilityRules() {

            $accountId = $_REQUEST['account_id'];
            $listingId = $_REQUEST['listing_id'];

            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/AvailabilityRules/".$accountId."/".$listingId;
            
            $headers = array(
              "Authorization: Bearer " . $this->token,
              "Content-Type: application/json"
            );
            $options = array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HTTPHEADER => $headers
            );
          
            $curl = curl_init();
            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
          
            if($errno = curl_errno($curl)) {
              $error_message = curl_strerror($errno);
              echo "cURL error ({$errno}): {$error_message}";
            } else {
              curl_close($curl);
              return json_decode($response);
            }
        }
          
        //Seçilen kullanılabilirlik kurallarını güncelleyin.
        public function updateAvailabilityRules() {
            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/AvailabilityRules";
            
            $data = array(
                "accountId" => $_REQUEST['account_id'],
                "listingId" => $_REQUEST['listing_id'],
                "defaultMinNights" => $_REQUEST['default_min_nights'] ?? null,
                "defaultMaxNights" => $_REQUEST['default_max_nights'] ?? null,
                "minHoursAhead" => $_REQUEST['min_hours_ahead'] ?? null,
                "allowRequestToBook" => $_REQUEST['allow_request_to_book'] ?? null,
                "maxDaysNotice" => $_REQUEST['max_days_notice'] ?? null,
                "preparationTime" => $_REQUEST['preparation_time'] ?? null,
                "checkInDays" => $_REQUEST['check_in_days'] ?? null,
                "checkOutDays" => $_REQUEST['check_out_days'] ?? null,
                "minNightsForCheckIn" => $_REQUEST['min_nights_for_check_in'] ?? null,
            );
        
            $data_json = json_encode($data);
        
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $this->token,
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_json))
            );
        
            $result = curl_exec($ch);
        
            if(curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }
        
            curl_close($ch);
        
            return $result;
        }
        
        //Bir tarih aralığı için bir listelemenin envanterini, fiyatlarını ve kısıtlamalarını öğrenin.
        public function getAirbnbInventory() {

            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/Inventory";
        
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token
            );
        
            $data = array(
                'accountId' => $_REQUEST['account_id'],
                'listingId' => $_REQUEST['listing_id'],
                'dateFrom' => $_REQUEST['date_from'],
                'dateTo' => $_REQUEST['date_to']
            );
        
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            curl_close($curl);
        
            return json_decode($response, true);
        }
        
        //Bir listelemenin envanterini ve/veya fiyatlarını ve/veya kısıtlamalarını güncelleyin.
        public function updateInventory(){
            var_dump($_REQUEST);
            exit;
            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/Inventory";
            
            $data = array(
                "accountId" => $_REQUEST['account_id'],
                "listingId" => $_REQUEST['listing_id'],
                "operations" => $_REQUEST['operations']
            );
            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->token
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($http_status == 200) {
                return true;
            } else {
                return false;
            }
        }

        //Bir listelemenin fiyatlandırma ayarlarını alın.
        public function getAirbnbPricingSettings() {

            $account_id = $_REQUEST['account_id'];
            $listing_id = $_REQUEST['listing_id'];

            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/PricingSettings/".$account_id."/".$listing_id;
        
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $this->token,
            ));
        
            $response = curl_exec($ch);
        
            if ($response === false) {
                $error = curl_error($ch);
                curl_close($ch);
                return "cURL Error: $error";
            }
        
            $data = json_decode($response, true);
        
            if (isset($data["error"])) {
                return $data["error"];
            }
        
            return $data;
        }

        //Seçili fiyatlandırma ayarlarını güncelleyin.
        public function updatePricingSettings() {

            $account_id = $_REQUEST['account_id'];
            $listing_id = $_REQUEST['listing_id'];
            $pricing_setting = $_REQUEST['pricing_setting'];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.hoteliga.com/v1/ChannelManager/Airbnb/PricingSettings");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
                "accountId" => $account_id,
                "listingId" => $listing_id,
                "pricingSetting" => $pricing_setting
            ]));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
        
            return json_decode($response, true);
        }
        
        //Bir hesabın kural kümelerini alın.
        public function getAirbnbRuleSets() {

            $account_id = $_REQUEST['account_id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/RuleSets/'.$account_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($result, true);
        }

        //Bir hesap için bir kural kümesi oluşturun.
        public function createRuleSet() {

            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/RuleSet";
        
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token
            );
        
            $data = array(
                'accountId' => $_REQUEST['account_id'],
                'ruleSet' => $_REQUEST['rule_set']
            );
        
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            curl_close($curl);
        
            return json_decode($response, true);
        }

        //Bir hesabın kural kümesini güncelleyin.
        public function updateRuleSet() {

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.hoteliga.com/v1/ChannelManager/Airbnb/RuleSet");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
                'accountId' => $_REQUEST['account_id'],
                'ruleSet' => $_REQUEST['rule_set']
            ]));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
        
            return json_decode($response, true);
        }

        //Bir kural kümesini silin.
        public function deleteRuleSet() {

            $account_id = $_REQUEST['account_id'];
            $rule_set_id = $_REQUEST['rule_set_id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/RuleSet/'.$account_id.'/'.$rule_set_id;
        
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token
            );
        
            $ch = curl_init($url);
        
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $response = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
            curl_close($ch);
        
            if ($http_status === 200) {
                return $response;
            } else {
                throw new Exception('Error: ' . $http_status . ', ' . $response);
            }
        }
        
        //Uygulanan kural kümelerini bir listeye alın.
        public function getAppliedRuleSets() {

            $account_id = $_REQUEST['account_id'];
            $listing_id = $_REQUEST['listing_id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/RuleSetTimeline/'.$account_id.'/'.$listing_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($result, true);
        }

        //Listelemeye bir kural kümesi uygulayın.
        public function applyRuleSetToListing() {
            
            $account_id = $_REQUEST['account_id'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/RuleSetTimeline/'.$account_id;
        
            $headers = array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            );
        
            $body = array(
                'accountId' => $_REQUEST['account_id'],
                'listingId' => $_REQUEST['listing_id'],
                'timelineItem' => array(
                    'startDate' => $_REQUEST['start_date'],
                    'endDate' => $_REQUEST['end_date'],
                    'ruleSetId' => $_REQUEST['rule_set_id']
                )
            );
        
            $json_body = json_encode($body);
        
            $ch = curl_init($url);
        
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_body);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $response = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
            curl_close($ch);
        
            if ($http_status === 200) {
                return $response;
            } else {
                throw new Exception('Error: ' . $http_status . ', ' . $response);
            }
        }

        //Bir tarih aralığı için bir girişe uygulanan kural kümelerini kaldırın.
        public function removeAppliedRules(){

            $account_id = $_REQUEST['account_id'];
            $listing_id = $_REQUEST['listing_id'];
            $start_date = $_REQUEST['start_date'];
            $end_date = $_REQUEST['end_date'];

            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/RuleSetTimeline/".$account_id;
        
            $data = array(
                'accountId' => $account_id,
                'listingId' => $listing_id,
                'startDate' => $start_date,
                'endDate' => $end_date
            );
        
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_HEADER => true,
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE => true,
                CURLOPT_POSTFIELDS => json_encode($data),
            ));
            $result = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_len);
            $body = substr($result, $header_len);
        
            return $responseCode;
        }
        
        //Rezervasyon bilgilerini alın.
        public function getAirbnbReservation() {

            $account_id = $_REQUEST['account_id'];
            $confirmationCode = $_REQUEST['confirmationCode'];

            $url = 'https://api.hoteliga.com/v1/ChannelManager/Airbnb/Reservation/'.$account_id.'/'.$confirmationCode;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->token,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($result, true);
        }
        
        //Bir kaydın gelecekteki rezervasyonlarını alın.
        public function getFutureReservations(){

            $account_id = $_REQUEST['account_id'];
            $listing_id = $_REQUEST['listing_id'];

            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/ChannelManager/Airbnb/Reservations/".$account_id."/".$listing_id;
        
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE => false,
            ));
            $result = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
            return json_decode($result);
        }
        
    }
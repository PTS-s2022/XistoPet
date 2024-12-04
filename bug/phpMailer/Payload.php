<?php


    class Payload{
         /**
         * IDs do Payload do Pix
         * @var string
         */
        const ID_PAYLOAD_FORMAT_INDICATOR = '00';
        const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
        const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
        const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
        const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
        const ID_MERCHANT_CATEGORY_CODE = '52';
        const ID_TRANSACTION_CURRENCY = '53';
        const ID_TRANSACTION_AMOUNT = '54';
        const ID_COUNTRY_CODE = '58';
        const ID_MERCHANT_NAME = '59';
        const ID_MERCHANT_CITY = '60';
        const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
        const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
        const ID_CRC16 = '63';

        /**
         * chave Pix
         * @var string
         */
        private $PixKey;
    
    
        /**
         * descricao do pagamento
         * @var string
         */
        private $description;

         /**
         * nome do dono da conta
         * @var string
         */
        private $MerchantName;

         /**
         * Cidade do dono da conta
         * @var string
         */
        private $MerchantCity;

         /**
         * ID da transacao
         * @var string
         */
        private $txid;

          /**
         * valor do pix
         * @var string
         */
        private $amount;

        /** metodo responsavel por definir o valor de $PixKey
         * @param string [type] $PixKey
         */

        public function setPixKey($PixKey){
            $this->PixKey = $PixKey;
            return $this;
        }

          /** metodo responsavel por definir o valor de $description
         * @param string [type] $description
         */

         public function setdescription($description){
            $this->description = $description;
            return $this;
        }

         /** metodo responsavel por definir o valor de $MerchantName
         * @param string [type] $MerchantName
         */

         public function setMerchantName($MerchantName){
            $this->MerchantName = $MerchantName;
            return $this;
        }

         /** metodo responsavel por definir o valor de $MerchantCity
         * @param string [type] $MerchantCity
         */

         public function setMerchantCity($MerchantCity){
            $this->MerchantCity = $MerchantCity;
            return $this;
        }

         /** metodo responsavel por definir o valor de $txid
         * @param string [type] $txid
         */

         public function settxid($txid){
            $this->txid = $txid;
            return $this;
        }

         /** metodo responsavel por definir o valor de $amount
         * @param float [type] $amount
         */

         public function setamount($amount){
            $this->amount = (string)number_format($amount,2,'.','');
            return $this;
        }

        
        /** 
         * metodo responsavel por retornar o valor completo do obj do payload
        * @param string $id
        * @param string $value
        * @return string $id.$size.$value
        */

        private function getValue($id,$value){
            $size = str_pad(strlen($value),2,'0',STR_PAD_LEFT);
            return $id.$size.$value;
        }


        /** 
        * metodo responsavel por retornar os valores completos da informacao da conta
        * @return string 
        */
        private function getMerchantAccountInformation(){
            // dominio do banco
            $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI,'br.gov.bcb.pix');

            // chave pix
            $key = $this -> getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY,$this->PixKey);

            // descricao pagamento
            $description = strlen($this->description) ? $this -> getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION,$this->description) : '';

            // Retorna o valor completo da conta
            return $this -> getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION,$gui.$key.$description);
        }


    	/** 
        * metodo responsavel por retornar os valores completos do campo adicional do pix (txid)
        * @return string 
        */
        private function getAdditionalDataFieldTamplate(){
            // TXID
            $txid = $this -> getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID,$this->txid);

            // retorna o valor completo
            return $this -> getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE,$txid);
        }


         /** 
          * metodo responsavel por gerar o codigo completo do pix
         * @return string
         */

         public function getPayload(){
            $payload = $this-> getValue(self::ID_PAYLOAD_FORMAT_INDICATOR,'01').
                       $this -> getMerchantAccountInformation().
                       $this -> getValue(self::ID_MERCHANT_CATEGORY_CODE,'0000').
                       $this -> getValue(self::ID_TRANSACTION_CURRENCY,'986').
                       $this -> getValue(self::ID_TRANSACTION_AMOUNT,$this->amount).
                       $this -> getValue(self::ID_COUNTRY_CODE,'BR').
                       $this -> getValue(self::ID_MERCHANT_NAME,$this->MerchantName).
                       $this -> getValue(self::ID_MERCHANT_CITY,$this->MerchantCity).
                       $this -> getAdditionalDataFieldTamplate();

            // retorna o payload e o crc16
            return $payload.$this->getCRC16($payload);
        }


          /**
   * Método responsável por calcular o valor da hash de validação do código pix
   * @return string
   */
    private function getCRC16($payload) {
        //ADICIONA DADOS GERAIS NO PAYLOAD
        $payload .= self::ID_CRC16.'04';

        //DADOS DEFINIDOS PELO BACEN
        $polinomio = 0x1021;
        $resultado = 0xFFFF;

        //CHECKSUM
        if (($length = strlen($payload)) > 0) {
            for ($offset = 0; $offset < $length; $offset++) {
                $resultado ^= (ord($payload[$offset]) << 8);
                for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                    if (($resultado <<= 1) & 0x10000) $resultado ^= $polinomio;
                    $resultado &= 0xFFFF;
                }
            }
        }

        //RETORNA CÓDIGO CRC16 DE 4 CARACTERES
        return self::ID_CRC16.'04'.strtoupper(dechex($resultado));
    }


    }
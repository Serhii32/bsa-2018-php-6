<?php

namespace App\Services;

class CurrencyRepository implements CurrencyRepositoryInterface {

	private $currencies;

    public function __construct(array $currencies) {

        $this->currencies = $currencies; 

    }

    public function findAll(): array {

    	return $this->currencies;

    }

    public function findActive(): array {

    	$activeCurrencies = [];

    	foreach ($this->currencies as $activeCurrency) {

    		if($activeCurrency->isActive()) {

    			$activeCurrencies[] = $activeCurrency;

    		}
  
    	}

    	return $activeCurrencies;

    }

    public function findById(int $id): ?Currency {

    	$findedCurrency = null;

    	foreach ($this->currencies as $currencyById) {

    		if ($currencyById->getId() == $id) {

    			$findedCurrency = $currencyById;
    			
    		}
  
    	}

    	return $findedCurrency;

    }

    public function save(Currency $currency): void {

    	$this->currencies[] = $currency;

    }

    public function delete(Currency $currency): void {

    	foreach ($this->currencies as $key => $oneCurrency) {

            if ($oneCurrency->getId() === $currency->getId()) {

                array_splice($this->currencies, $key, 1);

            }

        }
        
    }

}
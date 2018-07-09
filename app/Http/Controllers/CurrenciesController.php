<?php

namespace App\Http\Controllers;

use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyRepository;
use App\Services\CurrencyPresenter;

class CurrenciesController extends Controller
{
    protected $currencyRepository;
    
    public function __construct(CurrencyRepositoryInterface $currencyRepository) {

        $this->currencyRepository = $currencyRepository;

    }

    public function getActiveCurrencies() {

        $jsonActiveCurrencies = [];

        foreach ($this->currencyRepository->findActive() as $activeCurrency) {

            $jsonActiveCurrencies[] = CurrencyPresenter::present($activeCurrency);

        }

        return response()->json($jsonActiveCurrencies);

    }

    public function getCurrenciesById($id) {

        $currencyFindedById = $this->currencyRepository->findById($id);

        if ($currencyFindedById != null) {
            
            $jsonCurrencyFindedById = CurrencyPresenter::present($currencyFindedById);
            return response()->json($jsonCurrencyFindedById);

        } else {

            return response()->json([], 404);

        }
        
    }

    public function showCurrenciesView() {

        $currencies = $this->currencyRepository->findAll();
        
        $jsonCurrencies = [];

        foreach ($currencies as $currency) {

            $jsonCurrencies[] = CurrencyPresenter::present($currency);

        }
        
        return view('currencies', compact("jsonCurrencies"));

    }

}

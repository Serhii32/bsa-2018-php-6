<?php

namespace App\Services;

use App\Services\Currency;

class CurrencyGenerator
{
    public static function generate(): array
    {
        
        return [
        	new Currency(1, "Bitcoin", "BTC", 6658.28, new \DateTime(), true), 
        	new Currency(2, "Ethereum", "ETH", 473.71, new \DateTime(), false),
        	new Currency(3, "XRP", "XRP", 0.473783, new \DateTime(), true),
        	new Currency(4, "Bitcoin Cash", "BCH", 728.74, new \DateTime(), false),
        	new Currency(5, "EOS", "EOS", 8.66, new \DateTime(), true),
        	new Currency(6, "Litecoin", "LTC", 83.13, new \DateTime(), false),
        	new Currency(7, "Stellar", "XLM", 0.207120, new \DateTime(), true),
        	new Currency(8, "Cardano", "ADA", 0.143530, new \DateTime(), false),
        	new Currency(9, "IOTA", "MIOTA", 1.08, new \DateTime(), true),
        	new Currency(10, "Tether", "USDT", 1.00, new \DateTime(), false)
        ];

    }
}
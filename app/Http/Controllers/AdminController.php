<?php

namespace App\Http\Controllers;

use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyRepository;
use App\Services\CurrencyPresenter;
use App\Services\Currency;

use Illuminate\Http\Request;

class AdminController extends CurrenciesController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $jsonAllCurrencies = [];

        foreach ($this->currencyRepository->findAll() as $currency) {

            $jsonAllCurrencies[] = CurrencyPresenter::present($currency);

        }

        return response()->json($jsonAllCurrencies);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $maxId = 0;

        foreach ($this->currencyRepository->findAll() as $currency) {

            $maxId = $currency->getId() > $maxId ? $currency->getId() : $maxId;

        }

        $newCurrency = new Currency(
            $maxId + 1,
            $request->input('name'),
            $request->input('short_name'),
            $request->input('actual_course'),
            \DateTime::createFromFormat('Y-m-d H-i-s', $request->input('actual_course_date')),
            $request->input('actual_course_date'),
            $request->input('active')
        );

        $this->currencyRepository->save($newCurrency);
        $jsonCurrency = CurrencyPresenter::present($newCurrency);
        return response()->json($jsonCurrency);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return parent::getCurrenciesById($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $updatedCurrency = $this->currencyRepository->findById($id);

        if ($updatedCurrency != null) {

            $this->currencyRepository->delete($updatedCurrency);

            $id = null !== $request->input('id') ? $request->input('id') : $updatedCurrency->getId();
            $name = null !== $request->input('name') ? $request->input('name') : $updatedCurrency->getName();
            $short_name = null !== $request->input('short_name') ? $request->input('short_name') : $updatedCurrency->getShortName();
            $actual_course = null !== $request->input('actual_course') ? $request->input('actual_course') : $updatedCurrency->getActualCourse();
            $actual_course_date = null !== $request->input('actual_course_date') ? \DateTime::createFromFormat('Y-m-d H-i-s', $request->input('actual_course_date')) : $updatedCurrency->getActualCourseDate();
            $active = null !== $request->input('active') ? $request->input('active') : $updatedCurrency->isActive();

            $this->currencyRepository->save(new Currency($id, $name, $short_name, $actual_course, $actual_course_date, $active));

            $updatedCurrency = $this->currencyRepository->findById($id);
            $jsonUpdatedCurrency = CurrencyPresenter::present($updatedCurrency);
            return response()->json($jsonUpdatedCurrency);

        } else {

            return response()->json([], 404);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $destroyedCurrency = $this->currencyRepository->findById($id);

        if ($destroyedCurrency != null) {

            $this->currencyRepository->delete($destroyedCurrency);
            return response()->json([], 200);

        } else {

            return response()->json([], 404);

        }

    }
}

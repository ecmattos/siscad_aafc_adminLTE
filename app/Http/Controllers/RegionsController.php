<?php

namespace SisCad\Http\Controllers;

use Illuminate\Http\Request;

use SisCad\Http\Requests;
use SisCad\Http\Controllers\Controller;
use SisCad\Repositories\RegionRepository;
use SisCad\Repositories\CityRepository;

use Session;

class RegionsController extends Controller
{
    private $regionRepository;
    private $cityRepository;

    public function __construct(RegionRepository $regionRepository, CityRepository $cityRepository)
    {
        $this->regionRepository = $regionRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('regions-index');

        $regions = $this->regionRepository->allRegions();
        #dd($regions);
        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('regions-create');

        return view('regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\RegionRequest $request)
    {
        $data = $request->all();

        $data['code'] = strtoupper($data['code']);
        $data['description'] = strtoupper($data['description']);

        $this->regionRepository->store($data);

        Session::flash('flash_message_success', 'Registro incluido com sucesso !');

        return redirect('regions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \SisCad\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('regions-show');

        $region = $this->regionRepository->findRegionById($id);
        $cities = $this->cityRepository->findCitiesByRegionId($id);
        $logs = $region->revisionHistory;
        
        return view('regions.show', compact('region', 'cities', 'logs'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SisCad\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('regions-edit');

        $region = $this->regionRepository->findRegionById($id);
      
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SisCad\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\RegionRequest $request, $id)
    {
        $data = $request->all();

        $data['code'] = strtoupper($data['code']);
        $data['description'] = strtoupper($data['description']);

        $region = $this->regionRepository->findRegionById($id);
        $region->update($data);

        return redirect('regions')->with('flash_message_success', 'Registro alterado com sucesso !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SisCad\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $this->authorize('regions-destroy');

        return $this->regionRepository->delete($region);
    }
}

<?php namespace App\Http\Controllers;

use App\House;
use App\HouseImages;
use App\Feature;
use App\Http\Requests;
use App\Services\DeleteFile;
use App\Http\Requests\HouseRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;


class HouseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $pageTitle = "Houses Available";
        $message = 'We can develop any of these houses at a low cost!';
        $row = '<article class="row">';
        $rowClose = '</article>';
        $location = 'HouseController@create';
        $button = 'Add a House';

        if (isset($_GET['order'])) {
            $i = urlencode($_GET['order']);
        } else {
            $i = 1;
        }



        //collect data needed and sort it

        switch ($i) {
            case 1:
                $houses = House::orderBy('name', 'asc')->get();
                break;
            case 2:
                $houses = House::orderBy('name', 'desc')->get();
                break;
            case 3:
                $houses = House::orderBy('created_at', 'desc')->get();
                break;
            case 4:
                $houses = House::orderBy('created_at', 'asc')->get();
                break;
            default:
                $houses = House::orderBy('name', 'asc')->get();
        }



        return view ('houses.index')->with([
            'pageTitle' => $pageTitle,
            'message' => $message,
            'houses' => $houses,
            'row' => $row,
            'rowClose' => $rowClose,
            'location' => $location,
            'button' => $button
        ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $pageTitle = "Create a House";
        $message = "Create a new house by filling out the information below!";
        $row = '<div class="row">';
        $rowClose = '</div>';
        $check = [];
        $features = Feature::all();

        return view ('houses.create')->with([
            'pageTitle' => $pageTitle,
            'features' => $features,
            'message' => $message,
            'row' => $row,
            'rowClose' =>$rowClose,
            'check' => $check
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // input the values into the house table
        $input = Request::all();
        $house = new House;
        $house->name = $input['name'];
        $house->description = $input['description'];
        $house->save();

        // get the id and save into a function
        $id = $house->id;
        Session::put('id', $id);

        // get the values
        $features = $input['check'];

        // go through each feature and add it to the house_feature
        foreach ($features as $feature) {
            $house->features()->attach($feature);
        }

        return redirect('house/image/create');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $house = House::findOrFail($id);
        $features = $house->features;
        $pageTitle = "Details";
        $message = $house->name . " is just one of the house types at Home Development";
        $row = '<article class="row">';
        $rowClose = '</article>';

        // Create a link for the image
        $image = $house->HouseImages->where('house_id', $house->id)->first()->image;
        $path = $house->HouseImages->where('house_id', $house->id)->first()->imagePath;
        $link = $path . $image;
        $i= 0;

        return view ('houses.show')->with([
            'pageTitle' => $pageTitle,
            'house' => $house,
            'message' => $message,
            'link' => $link,
            'features' => $features,
            'i' => $i,
            'row' => $row,
            'rowClose' => $rowClose
        ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $house = House::findOrFail($id);
        $pageTitle = "Edit " . $house->name;
        $message = "Make changes to the house by filling in the boxes below!";
        $row = '<div class="row">';
        $rowClose = '</div>';
        $check = [];
        $edit = true;
        $checked = 'checked';
        $feature_ids = $house->features->lists('id');
        $features = Feature::all();


        return view('houses.edit')->with([
            'pageTitle' => $pageTitle,
            'house' => $house,
            'message' => $message,
            'row' => $row,
            'rowClose' => $rowClose,
            'check' => $check,
            'edit' => $edit,
            'features' => $features,
            'feature_ids' => $feature_ids,
            'checked' =>$checked
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, HouseRequest $request)
	{
        // Update house
        $house= House::findOrFail($id);
        $house->update($request->all());
        // update features

        $house->features()->detach();
        $features = $request['check'];
        // go through each feature and add it to the house_feature
        foreach ($features as $feature) {
            $house->features()->attach($feature);
        }

        return redirect('houses');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $house= House::findOrFail($id);
        $name = $house->houseImages->first()->image;
        $path = public_path('images/house/');
        $destination = $path . $name;


        //Delete the image and thumbnail

        try {
            $delete = new DeleteFile($destination);
            $delete->deleteThumbnail();
            $delete->deleteFile();
            $results = $delete->getMessages();
        } catch (Exception $e) {
            $results = $e ->getMessage();
        }


        //Delete the path from the datebase

        $house->delete();
        return redirect('houses');
	}

}

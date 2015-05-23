<?php namespace App\Http\Controllers;

use App\Feature;
use App\FeatureImages;
use App\House;
use App\HouseImages;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\DeleteFile;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\FeatureRequest;


class FeatureController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'edit']]);
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $pageTitle = "Features Available";
        $message = 'Read about all of our features on this page!';
        $row = '<article class="row">';
        $rowClose = '</article>';
        $location = 'FeatureController@create';
        $button = 'Add a Feature';
        //collect data needed

        //$features = new Feature;
        $features = Feature::all();

		return view ('features.index')->with([
            'pageTitle' => $pageTitle,
            'message' => $message,
            'features' => $features,
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
        // check login details

        $pageTitle = "Create a Feature";
        $message = "Create a new feature by filling out the information below!";
        return view ('features.create')->with([
            'pageTitle' => $pageTitle,
            'message' => $message
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(FeatureRequest $request)
	{
        $input = Request::all();

        // save each Individually
        $feature = new Feature;

        $feature->name = $input['name'];
        $feature->description = $input['description'];
        $feature->save();

        // Session for feature ID to collect at image creation
        $id = $feature->id;
        Session::put('id', $id);


        return redirect('feature/image/create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $feature = Feature::findOrFail($id);
        $pageTitle = "Details";
        $message = $feature->name . " is just one of the features at Home Development";


        // Create a link for the image

        $image = $feature->FeatureImages->where('feature_id', $feature->id)->first()->image;
        $path = $feature->FeatureImages->where('feature_id', $feature->id)->first()->imagePath;
        $link = $path . $image;

        return view ('features.show')->with([
            'pageTitle' => $pageTitle,
            'feature' => $feature,
            'message' => $message,
            'link' => $link
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
		//
        $feature = Feature::findOrFail($id);
        $pageTitle = "Edit " . $feature->name;
        $message = "Make changes to the feature by filling in the boxes below!";


        return view('features.edit')->with([
            'pageTitle' => $pageTitle,
            'feature' => $feature,
            'message' => $message
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, FeatureRequest $request)
	{

        // Update features
		$features = Feature::findOrFail($id);
        $features->update($request->all());

        return redirect('features');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function destroy($id)
	{
        $feature = Feature::findOrFail($id);
        $name = $feature->FeatureImages->first()->image;
        $path = public_path('images/feature/');
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

        // Delete the path from the datebase

        $feature->delete();
        return redirect('features');

	}


}

<?php namespace App\Http\Controllers;

use App\Feature;
use App\FeatureImages;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\UploadImage;
use App\Services\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class FeatureImagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        // logic for image form
        $pageTitle = "Add an Image";

        // Get the id to display in title
        $id = Session::get('id');
        $feature = Feature::findOrFail($id);
        $name = $feature->name;



        return view ('featureImages.create')->with([
            'pageTitle' => $pageTitle,
            'name' => $name
        ]);
	}

	/**
	 * Store a newly created resource in storage.
     *
     * Store is responsible for uploading the image of the feature.
	 *
	 * @return Response
	 */
	public function store()
	{
        // variables needed
        $pageTitle = 'Features';
        $max = 500 * 1024;
        $results = [];
        $destination =  public_path('images/feature/');
        $imageURL = '/images/feature/';
        $imagetoURL = '/RealEstate/RealEstate/public/images/feature/';
        // end variables


        // Prepare the uploaded file
            try {
                $upload = new UploadImage($destination);
                $upload->setMaxSize($max);
                $upload->upload();
                $results = $upload->getMessages();
            } catch (Exception $e) {
                $results = $e ->getMessage();
            }
        // end upload

        // Collecting the data to save into the table
        $fileName = $upload->getName(current($_FILES));
        $file = $imageURL . '/' . $fileName;
        $fileURL = $destination . '/' . $fileName;
        $featureImg = new FeatureImages;

        //check if the upload was successful
        if (file_exists($fileURL))
        {
            $id = Session::get('id');
            // Saving the data
            $featureImg->feature_id= $id;
            $featureImg->image = $fileName;
            $featureImg->ImagePath = $imagetoURL;
            $featureImg->save();
        }
        // Data is saved

        // Image is resized and a thumbnail has been created
        $resize = new ResizeImage($file, 400, 400);
        $resize->createResizeImage();
        $resize->createThumbNail(200, 200);
        //end resizing

        // Collecting data for a flash cookie for the next page
        $features = Feature::all();
        // End collecting data

        return redirect ('features')->with([
            'results' => $results,
            'features' => $features,
            'pageTitle' => $pageTitle
        ]);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

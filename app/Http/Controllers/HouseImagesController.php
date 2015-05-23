<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\House;
use App\HouseImages;
use App\Http\Controllers\Controller;

use App\Services\UploadImage;
use App\Services\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class HouseImagesController extends Controller {

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
        $house = House::findOrFail($id);
        $name = $house->name;

        return view ('houseImages.create')->with([
            'pageTitle' => $pageTitle,
            'name' => $name
        ]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // variables needed
        $pageTitle = 'Houses';
        $max = 500 * 1024;
        $results = [];
        $destination =  public_path('images/house/');
        $imageURL = '/images/house/';
        $imagetoURL = '/RealEstate/RealEstate/public/images/house/';
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
        $houseImg = new HouseImages;

        //check if the upload was successful
        if (file_exists($fileURL))
        {
            $id = Session::get('id');
            // Saving the data
            $houseImg->house_id= $id;
            $houseImg->image = $fileName;
            $houseImg->ImagePath = $imagetoURL;
            $houseImg->save();
        }
        // Data is saved

        // Image is resized and a thumbnail has been created
        $resize = new ResizeImage($file, 400, 400);
        $resize->createResizeImage();
        $resize->createThumbNail(200, 200);
        //end resizing

        // Collecting data for a flash cookie for the next page
        $houses = House::all();
        // End collecting data

        return redirect ('houses')->with([
            'results' => $results,
            'houses' => $houses,
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

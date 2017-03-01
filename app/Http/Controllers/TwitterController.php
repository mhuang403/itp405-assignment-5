<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tweet;

use Validator;

class TwitterController extends Controller
{
    public function index()
    {

        $tweets = Tweet::orderBy('id', 'desc')->get();

        return view('index', [
            'tweet' => $tweets
        ]);
    }

    public function destroy($tweetID)
    {

        $tweets = Tweet::find($tweetID);
        $tweets->delete();

        return redirect('/')
            ->with('successStatus', 'Tweet successfully deleted!');
    }

    public function id($tweetID)
    {

        $viewTweet = Tweet::where('id', '=', $tweetID)->get();


        return view('tweets.id', [
            'tweets' => $viewTweet
        ]);

    }

    public function edit($tweetID)
    {
        $editTweet = Tweet::where('id', '=', $tweetID)->get();


        return view('tweets.edit', [
            'tweets' => $editTweet
        ]);
    }

    public function update(Request $request, $tweetID)
    {

        $validation = Validator::make($request->all(),
            [
            'tweet' => 'required|max:140'
            ]);
        if ($validation->passes()) {
            $updateTweet = Tweet::find($tweetID);
            $updateTweet->tweet = request('tweet');
           $updateTweet->save();

            return redirect("/tweets/$tweetID")
               ->with('successStatus', 'Tweet was successfully updated');

        } else {
            return redirect("/tweets/$tweetID/edit")
                ->withErrors($validation);

        }
    }

public function store(Request $request)
{
    $validation = Validator::make($request->all(), [
    'tweet' => 'required|max:140'
]);
    if ($validation->passes()) {
        Tweet::insert([
            'tweet' => request('tweet')
        ]);

        return redirect('/')
            ->with('successStatus', 'Tweet successfully created!');

    } else {
    return redirect('/')
    ->withInput()
    ->withErrors($validation);
    }
}
}

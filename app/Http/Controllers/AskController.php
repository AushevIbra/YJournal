<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Ask;
use App\Http\Resources\Ask as AskResource;
use Illuminate\Http\Request;

class AskController extends Controller {
    /**
     * @var Ask
     */
    private $ask;

    /**
     * AskController constructor.
     * @param Ask $ask
     */
    public function __construct(Ask $ask){

        $this->ask = $ask;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Answer $answer){
        return view("asks.index", ['answers' => $answer::with(['ask', 'user'])->orderBy("id", 'desc')->limit(9)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('asks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ], [
            'title.required' => 'Заполните тему вопроса',
            'body.required'  => 'Заполните описание',
        ]);


        $ask = $this->ask->create([
           'title' => $request->post('title'),
           'body' => $request->post('body'),
           'user_id' => auth()->user()->id,

        ]);

        return redirect()->route('asks.show', $ask->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        return view("asks.show", ['ask' => $this->ask->with('user')->withCount('countAnswers')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }


    public function getAsk($type) {
        $data = $this->ask::getData($type);

        return new AskResource($data);

    }
}

<?php

namespace App\Http\Controllers;

use Validator;
use App\Book;
use Illuminate\Http\Request;
use Mail;

class BookController extends Controller
{
    /*

    Author -: Mohd Umar(umar17605, Master-Tech786, Master-Tech271, Master-Tech)
    All the code is originally written by Mohd Umar according to Laravel official Documentation.

    */

    /*
    NOTE -: We cannot put this file into APIController Folder(best practice) because this is only demo project not production
    */
    
    //All the data insert, create, delete or update according to user login.
    
    public function index(Request $request)
    {
        //show all the data but only user login
        return response()->json(auth()->user()->Books()->get(), 200);
    }
   
    //show all book data with soft delete
    public function showWithSoftDelete()
    {
        $book = auth()->user()->Books()->withTrashed()->get();
        return response()->json($book, 200);
    }

    //show only soft delete data
    public function onlySoftDeleted()
    {
        $book = auth()->user()->Books()->onlyTrashed()->get();
        return response()->json($book, 200);
    }

    //recover soft delete book data
    public function restore($id)
    {
        $book = auth()->user()->Books()->onlyTrashed()->find($id);

        if (!is_null($book)) {
            $book->restore();
            return response()->json(['message' => 'Successfully restored'], 200);
        } 
        else {
            return response()->json(['message' => 'Not Restored'], 400);
        }
    }

    //create book data
    public function store(Request $request)
    {
        $rules = [
            'bookName' => 'required|min:3|unique:books',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $book = auth()->user()->books()->create($request->all());

        $contentMessage = 'Hi, You insert the book with name '.$book->bookName;
        
        //simple mail for dummy project
        try{
            Mail::raw($contentMessage,  function($message){
                $message->to(auth()->user()->email, 'To '.auth()->user()->name)->subject('Demo Email');
            });
        } catch(Exception $e) {    }

        return response()->json($book, 201);
    }

    //show data except not soft and hard deleted data
    public function show(Book $book)
    {
        if(auth()->id() == $book->user_id) {
        return response()->json($book, 200);
        }
        return response()->json(['message' => 'Record Not Found'], 400);
    }

    //update data
    public function update(Request $request, Book $book)
    {
        if(auth()->id() == $book->user_id) {
            $rules = [
                'bookName' => 'required|min:3|unique:books',
            ];
            
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $contentMessage = 'Hi, You update the book name from '.$book->bookName.' to ';

            $book->update(['bookName'=> $request->bookName]);

            //simple mail for dummy project
            $contentMessage .= $book->bookName;
            try{
                Mail::raw($contentMessage,  function($message){
                    $message->to(auth()->user()->email, 'To '.auth()->user()->name)->subject('Demo Email');
                });
            } catch(Exception $e) {    }

            return response()->json($book, 200);
        }
        return response()->json(['message' => 'Record Not Found'], 400);
    }

    public function destroy(Book $book)
    {
        if(auth()->id() == $book->user_id) {

            $book->forceDelete();
        
            //simple mail for dummy project
            $contentMessage = 'Hi, You permanent delete the book with name '.$book->bookName;
            try{
                Mail::raw($contentMessage,  function($message){
                    $message->to(auth()->user()->email, 'To '.auth()->user()->name)->subject('Demo Email');
                });
            } catch(Exception $e) {    }

            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Record Not Found'], 400);

    }

    //for soft delete
    public function softDelete(Book $book)
    {
        if(auth()->id() == $book->user_id) {

        $book->delete();

        //simple mail for dummy project
        $contentMessage = 'Hi, You temporary delete the book with name '.$book->bookName;
        try{
            Mail::raw($contentMessage,  function($message){
                $message->to(auth()->user()->email, 'To '.auth()->user()->name)->subject('Demo Email');
            });
        } catch(Exception $e) {    }

        return response()->json(null, 204);
        }
        
        return response()->json(['message' => 'Record Not Found'], 400);
    }
}

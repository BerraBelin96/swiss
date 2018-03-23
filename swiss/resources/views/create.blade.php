@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <form method="POST" action="/posts" >

                {{ csrf_field() }}
                <div class="form-group">
                    <label for="players">Add players to your tournamnet:</label>
                </div>
                <div class="input-group col-md-10 mx-auto">
                    <input type="text" class="form-control" name="text"
                    placeholder="Name"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">Add</button>
                    </span>
                </div>
            </form>
            <hr>           
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="text-center">There are currently no players!</p>
            {{-- @foreach($players as $player)   
                @endforeach --}}  
                <table class="col-md-10 mx-auto">
                    <tbody>
                        <tr>
                            <td class="col-md-2">Dino Felarca</td>
                            <td class="col-md-8"></td>
                            <td class="col-md-2"><span aria-hidden="true">&times;</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection

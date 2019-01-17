<?php

namespace App\Http\Controllers\Premium;

use App\Http\Requests\TokenRequest;
use App\Token;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Token $token
     * @return Response
     */
    public function index(Token $token)
    {
        $this->authorize('view',Token::class);

        return view('token.index',[
            'tokens' => $token->liste()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('view',Token::class);

        return view('token.create',[
            'company' => auth()->user()->member->company
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TokenRequest|Request $request
     * @param Token $token
     * @return Response
     */
    public function store(TokenRequest $request,Token $token)
    {
        $this->authorize('view',Token::class);

        $token->onCreate($request->company,$request->range,$request->category);

        session()->flash('status',__('token.store'));

        return redirect()->route('token.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Token  $token
     * @return Response
     */
    public function destroy(Token $token)
    {
        $this->authorize('delete',$token);

        $token->onDelete();

        session()->flash('status', __('token.delete_success'));

        return redirect()->route('token.index');
    }
}

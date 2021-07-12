<?php

namespace App\Http\Controllers\System\Panel\Register\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\System\Panel\Register\Plan\Plan;

class PlanController extends Controller
{
    private $repository;

    public function __construct( Plan $plan )
    {
        $this->repository = $plan;

    } // __construct

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->latest()->paginate(); // Recupera, ordena e pagina

        return view(

            'pages.system.panel.register.plan.index',
            [
                'plans' => $plans
            ]

        ); // retorna a view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'pages.system.panel.register.plan.create' ); // Retorna a view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data           = $request->all(); // Recupera todos os dados do formulário
        $data[ 'url' ]  = Str::kebab( $request->name ); // Recupera o "name" e converte em "url"

        $this->repository->create( $data ); // Cadastra

        return redirect()->route( 'plan.index' ); // Retorna e redireciona
    }

    /**plan
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $url )
    {
        $plan = $this->repository->where( 'url', $url )->first(); // Recupera o primeiro registro pela "url"

        if ( !$plan )
            return redirect()->back(); // Verifica se não encontrou o registro pela "url" e retorna para a página de origem

        return view(

            'pages.system.panel.register.plan.show',
            [
                'plan' => $plan
            ]

        ); // retorna a view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $url )
    {
        $plan = $this->repository->where( 'url', $url )->first(); // Recupera o primeiro registro pela "url"

        if ( !$plan )
            return redirect()->back(); // Verifica se não encontrou o registro pela "url" e retorna para a página de origem

        $plan->delete(); // Deleta

        return redirect()->route( 'plan.index' );
    }

} // PlanController

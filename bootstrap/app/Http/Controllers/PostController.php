<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Muestra la vista principal.
        A partir del modelo Posts se obtienen los registros guardados y se asignan
        a la variable $posts. Se retorna la vista dashboard.post.posts, junto con
        los datos que contenga la variable $posts, llamada tambien posts en la vista*/
        $posts = Posts::orderBy('created_at', 'asc')->paginate(3);
        return view('dashboard.post.posts', [
            'posts' => $posts
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*Muestra un formulario para crear un recurso. Retorna la vista
        dashboard.post.create*/

        return view('dashboard.post.create', [
            'post' => new Posts()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //Es el encargado de hacer las incersiones en la BD
        //return "post store";
        //var_dump($request);
        //dd($request);
        /*$validated = $request->validate([
            'title' => 'required | min:5 | max:500',
            'url_clean' => 'required',
            'content' => 'min:1 | max:500'
        ]);*/
        //$validated = $request->validated();

        /*Los datos del formulario proveniente de la vista dashboard.post.create 
        se reciven como $request de tipo StorePostRequest que contiene las reglas
        de validacion del formulario. En el modelo Posts se crea un registro en 
        la base de datos despues de ser validado, se retorna la ruta anterior con
        el metodo back(), pero mandando una llamada a la sesion status con el valor
        Post created successfully para que muestre un mensaje de creacion exitoso
        en la vista dashboard.post.create*/
        Posts::create($request->validated());
        return back()->with('status', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Muestra un recurso esecifico por su id, sin opcion de editar
        //No se utiliza en los cruds regularmente, mas para API rest
        return "Show: ". $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        //Muestra un recurso especifico por su id, con opcion de editar
            
        return view('dashboard.post.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Posts $post)
    {
        //Actualiza la info en la BD
        //Posts::find($id)->update($request->validated());
        //Posts::where('id', $id)->update($request->validated()); No se recomienda, hace dos queries
        $post->update($request->validated());
        return back()->with('status', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        //Elimina datos de la base de datos, en especifico por el id
        //dd($post);
        $post->delete();
        return back()->with('status', 'Post deleted successfully');
    }
}

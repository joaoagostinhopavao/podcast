<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $podcasts = Podcast::all();
        return view('podcasts.index', compact('podcasts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('podcasts.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        // At the beginning of your store method
        logger('Store method started');

        $request->validate([
            'reference_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096', // Se estiver fazendo upload de imagem
            'video' => 'file|mimes:mp4,ogg,webm,mov|max:20480', // Se estiver fazendo upload de vídeo
            'image_url' => 'nullable|url', // Se estiver inserindo URL de imagem
            'video_url' => 'nullable|url', // Se estiver inserindo URL de vídeo
        ], [
            'reference_id.required' => 'O campo de ID de referência é obrigatório.',
            'title.required' => 'O campo de título é obrigatório.',
            'description.required' => 'O campo de descrição é obrigatório.',
            'image.mimes' => 'A imagem deve ser dos tipos: jpeg, png, jpg, gif ou svg.',
            'video.mimes' => 'O vídeo deve ser dos tipos: mp4, ogg ou webm.',
            'image.max' => 'A imagem não deve exceder 2 MB.',
            'video.max' => 'O vídeo não deve exceder 20 MB.',
            'image_url.url' => 'A URL da imagem deve ser válida.',
            'video_url.url' => 'A URL do vídeo deve ser válida.',
        ]);
    logger('Passou a validação');
        // Lógica para lidar com upload de imagem, se fornecida
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
        } else {
            $imagePath = null;
        }
        logger('upload da imagem completo');
        // Lógica para lidar com upload de vídeo, se fornecido
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        } elseif ($request->filled('video_url')) {
            $videoPath = $request->input('video_url');
        } else {
            $videoPath = null;
        }
        logger('video path: '.$videoPath);
        // Criação de um novo podcast
        Podcast::create([
            'reference_id' => $request->input('reference_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'video' => $videoPath,
        ]);
        logger('Store method finished');
        return redirect()->route('podcasts.index')->with('success', 'Podcast criado com sucesso.');
    }





    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        return view('podcasts.show', ['podcast' => $podcast]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Podcast $podcast)
    {
        return view('podcasts.edit', compact('podcast'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Podcast $podcast)
    {
        logger('Update method started...');
    try{
        $request->validate([
            'reference_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096', // Se estiver a fazer upload de imagem
            'video' => 'file|mimes:mp4,ogg,webm,mov|max:20480', // Se estiver a fazer upload de vídeo
            'image_url' => 'nullable|url', // Se estiver a inserir URL de imagem
            'video_url' => 'nullable|url', // Se estiver a indserir URL de vídeo
        ], [
            'reference_id.required' => 'O campo de ID de referência é obrigatório.',
            'title.required' => 'O campo de título é obrigatório.',
            'description.required' => 'O campo de descrição é obrigatório.',
            'image.mimes' => 'A imagem deve ser dos tipos: jpeg, png, jpg, gif ou svg.',
            'video.mimes' => 'O vídeo deve ser dos tipos: mp4, ogg ou webm.',
            'image.max' => 'A imagem não deve exceder 2 MB.',
            'video.max' => 'O vídeo não deve exceder 20 MB.',
            'image_url.url' => 'A URL da imagem deve ser válida.',
            'video_url.url' => 'A URL do vídeo deve ser válida.',
        ]);
    } catch(\Exception $e) {
        logger('Update method error: '.$e->getMessage());
    }
        logger('Update passou a validação');

    try {
        /* Lógica para lidar com upload de imagem, se fornecida

        */
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            logger('Image uploaded successfully: '.$imagePath);
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
            logger('Image url provided: '.$imagePath);
        } else {
            $imagePath = $podcast->image;
            logger('Using existing image: '.$imagePath);
        }
        logger('Update upload da imagem completo');


        /* Lógica para lidar com upload de vídeo, se fornecido

        */
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            logger('Video uploaded successfully: '.$videoPath);
        } elseif ($request->filled('video_url')) {
            $videoPath = $request->input('video_url');
            logger('Video URL provided: '.$videoPath);
        } else {
            $videoPath = $podcast->video;
            logger('Using existing video: '.$videoPath);
        }
        logger('Update video path: ' . $videoPath);

        // Criação de um novo podcast
        $podcast->update([
            'reference_id' => $request->input('reference_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'video' => $videoPath,
        ]);
        logger('Update method finished');
    } catch(\Exception $e){
        logger('Update method error: '.$e->getMessage());
    }
        return redirect()->route('podcasts.index')->with('success', 'Podcast atualizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();

        return redirect()->route('podcasts.index')->with('success', 'Podcast deleted successfully.');
    }

}

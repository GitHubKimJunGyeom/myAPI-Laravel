<?php

namespace App\Contracts\Services\LogAndList;

interface PathNotesServiceInterface
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
}

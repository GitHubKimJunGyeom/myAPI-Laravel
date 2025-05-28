<?php

namespace App\Contracts\Services\LogAndList;

use Illuminate\Database\Eloquent\Collection;

interface PathNotesServiceInterface
{
    public function index():Collection;
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
}

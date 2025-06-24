<div class="space-y-4">
    <div>
        <label>Nome</label>
        <input type="text" name="name" value="{{ old('name', $place->name ?? '') }}"
               class="w-full border p-2">
    </div>
    <div>
        <label>Descrição</label>
        <textarea name="description" class="w-full border p-2">{{ old('description', $place->description ?? '') }}</textarea>
    </div>
    <div>
        <label>Endereço</label>
        <input type="text" name="address" value="{{ old('address', $place->address ?? '') }}"
               class="w-full border p-2">
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Latitude</label>
            <input type="text" name="latitude" value="{{ old('latitude', $place->latitude ?? '') }}"
                   class="w-full border p-2">
        </div>
        <div>
            <label>Longitude</label>
            <input type="text" name="longitude" value="{{ old('longitude', $place->longitude ?? '') }}"
                   class="w-full border p-2">
        </div>
    </div>
    <div>
        <label>Imagens</label>
        <input type="file" name="images[]" multiple class="w-full">
    </div>
</div>
